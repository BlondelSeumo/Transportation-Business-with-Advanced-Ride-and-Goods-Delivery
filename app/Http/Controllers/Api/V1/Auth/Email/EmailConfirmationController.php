<?php

namespace App\Http\Controllers\Api\V1\Auth\Email;

use App\Models\User;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\Email\ConfirmEmailRequest;
use App\Http\Requests\Auth\Email\ResendConfirmationEmailRequest;

/**
 * @group Email-Confirmation
 *
 * APIs for Email-Confirmation
 */
class EmailConfirmationController extends ApiController
{
    /**
     * The user model instance.
     *
     * @var User
     */
    protected $user;

    /**
     * EmailConfirmationController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Confirm user's email using the confirmation token.
     *
     * @param ConfirmEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @bodyParam token string required token of the email
     * @bodyParam email string required email of the user entered
     * @response {"success":true,"message":"success"}
     */
    public function confirm(ConfirmEmailRequest $request)
    {
        $token = $request->input('token');
        $email = $request->input('email');

        $user = $this->resolveUserFromEmail($email);

        if (!$user || !hash_check($token, $user->email_confirmation_token)) {
            return $this->respondFailed('Invalid confirmation token.');
        }

        $user->forceFill([
            'email_confirmed' => true,
            'email_confirmation_token' => null,
        ])->save();

        return $this->respondSuccess();
    }

    /**
     * Resend user's email address confirmation email.
     *
     * @param ResendConfirmationEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @bodyParam email email required email of the user entered
     * @response {"success":true,"message":"success"}
     */
    public function resend(ResendConfirmationEmailRequest $request)
    {
        $email = $request->input('email');

        $user = $this->resolveUserFromEmail($email);

        if (!$user) {
            $this->throwCustomValidationException("We can't find a user with that email address.", 'email');
        }

        if (!$user->isActive()) {
            $this->throwAccountDisabledException('email');
        }

        if ($user->email_confirmed) {
            $this->throwCustomValidationException('Your email has already been confirmed.', 'email');
        }

        if (!($token = $user->email_confirmation_token)) {
            $token = str_random(40);

            $user->forceFill([
                'email_confirmation_token' => bcrypt($token)
            ])->save();
        }

        // [WIP] Create generic email confirmation notification.
        //$this->dispatch(new EmailConfirmationNotification($user, $token));

        return $this->respondSuccess();
    }

    /**
     * Resolve the user from their email.
     *
     * @param string $email
     * @return User|null
     */
    protected function resolveUserFromEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }
}
