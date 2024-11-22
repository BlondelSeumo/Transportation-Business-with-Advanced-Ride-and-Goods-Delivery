<?php

namespace App\Http\Controllers\Api\V1\Request;

use App\Models\Request\RequestRating;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Request\TripRatingRequest;
use Kreait\Firebase\Contract\Database;
use Exception;

/**
 * @group Ratings
 *
 * APIs for User & Driver-trip ratig api
 */
class RatingsController extends BaseController
{
    /**
    * Rate The Request B/W User & Driver
    * @bodyParam request_id uuid required id of request
    * @bodyParam rating float required rating of the request
    * @bodyParam comment string optional comment of the request
    * @response {
    "success": true,
    "message": "rated_successfully"
    }
    */

    protected $request_model;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function rateRequest(TripRatingRequest $request)
    {
        $user_rating = false;
        $driver_rating = false;
        if (access()->hasRole(RoleSlug::USER)) {
            $user_id = auth()->user()->id;
            $request_detail = auth()->user()->requestDetail()->where('id', $request->request_id)->first();
            if (!$request_detail) {
                throw new Exception('You are not allowed to review this request.');
            }
            if ($request_detail->user_rated) {
                throw new Exception('You have already reviewed this request.');
            }
            $driver_id = $request_detail->driver_id;
            $user_rating = true;
            $exist_user_rating = auth()->user()->rating;
        } else {
            $driver_id = auth()->user()->driver->id;
            $request_detail = auth()->user()->driver->requestDetail()->where('id', $request->request_id)->first();
            if (!$request_detail) {
                throw new Exception('You are not allowed to review this request.');
            }
            if ($request_detail->driver_rated) {
                throw new Exception('You have already reviewed this request.');
            }
            $user_id = $request_detail->user_id;
            $driver_rating = true;
            $exist_user_rating = auth()->user()->rating;
        }
        $request_rating_params = ['user_id'=>$user_id,'driver_id'=>$driver_id,'request_id'=>$request->request_id,'rating'=>$request->rating,'comment'=>$request->comment,'user_rating'=>$user_rating,'driver_rating'=>$driver_rating];
        // Store rating to the request rating table
        RequestRating::create($request_rating_params);
        // Update Rating with existing rating
        $user = auth()->user();
        $rating_total = ($user->rating_total+$request->rating);
        $no_of_ratings =($user->no_of_ratings+1);
        $calculated_rating = round($rating_total/$no_of_ratings, 2);

        $rating = $user->update(['rating'=>$calculated_rating,'rating_total'=>$rating_total,'no_of_ratings'=>$no_of_ratings]);
        // Update user rated & driver rated
        if ($user_rating) {
            $request_detail->update(['user_rated'=>$user_rating]);
        } else {
            $request_detail->update(['driver_rated'=>$driver_rating]);
        }

        if($request_detail->user_rated && $request_detail->driver_rated){
            $this->database->getReference('SOS/'.$request_detail->id)->remove();
            $this->database->getReference('requests/' . $request_detail->id)->remove();
        }
        return $this->respondSuccess(null, 'rated_successfully');
    }
}
