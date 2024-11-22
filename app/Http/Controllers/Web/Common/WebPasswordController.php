<?php

namespace App\Http\Controllers\Web\Common;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Common\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;

class WebPasswordController extends BaseController
{

    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The password broker instance.
     *
     * @var \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected $broker;

    /**
     * PasswordResetController constructor.
     *
     * @param \App\Models\User $user
     * @param \Illuminate\Contracts\Auth\PasswordBroker $broker
     */
    public function __construct(User $user, PasswordBroker $broker)
    {
        $this->user = $user;
        $this->broker = $broker;
    }

    /**
     * Redirect to unauthorized exception page
     */
    public function createPassword(Request $request)
    {
        return view('common.createPassword', compact('request'));
    }

    public function updatePassword(PasswordUpdateRequest $request, $token, $email)
    {
        $user = $this->resolveUserFromEmail($email);

        if (!$user || !$this->broker->tokenExists($user, $token)) {
            $this->throwCustomValidationException(
                'The password reset token is invalid or has expired.',
                'password'
            );
        }

        $password = $request->input('password');

        $user->forceFill(['password' => bcrypt($password)])->save();

        $message = trans('succes_messages.department_added_succesfully');

        return redirect('login')->with('success', $message);
    }

    /**
     * Resolve the user from their email.
     *
     * @param string $email
     * @return \App\Models\User|null
     */
    protected function resolveUserFromEmail($email)
    {
        return $this->user->doesNotBelongToRole($this->rolesUsingUsername())
            ->where('email', $email)
            ->first();
    }
}
