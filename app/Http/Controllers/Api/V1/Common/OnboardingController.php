<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Admin\Zone;
use App\Models\Admin\Onboarding;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceLocation;
use App\Models\Request\Request as RequestRequest;
use Carbon\Carbon;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use Illuminate\Support\Facades\Storage;
use App\Base\Services\ImageUploader\ImageUploaderContract;

class OnboardingController extends Controller
{


    protected $onboarding;


    protected $imageUploader;

    /**
     * OnboardingController constructor.
     *
     * @param \App\Models\Admin\onboarding $onboarding
     */
    public function __construct(Onboarding $onboarding, ImageUploaderContract $imageUploader,)
    {
        $this->onboarding = $onboarding;
        $this->imageUploader = $imageUploader;

    }



    public function index()
    {

        $page = trans('pages_names.view_onboarding');

        $main_menu = 'onboarding';
        $sub_menu = '';

        return view('admin.onboarding.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch()
    {
        $Onboarding = Onboarding::select('*')->get();
        $results=$Onboarding;
        return view('admin.onboarding._onboarding', compact('results'));
    }



    public function getById(Onboarding $onboarding)
    {

        $page = trans('pages_names.edit_onboarding');

        $main_menu = 'onboarding';
        $sub_menu = '';
        $item = $onboarding;
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view('admin.onboarding.update', compact('item', 'page', 'main_menu', 'sub_menu','p'));
    }

    public function uploadPath()
    {
        return config('base.onboarding.upload.path');
    }

    public function update(Request $request)
    {


         if (env('APP_FOR') == 'demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect('system/settings/onboarding')->with('warning', $message);
        }

        $id = $request->id;
        $data = Onboarding::findOrFail($id);
//dd($request->all());
        // Handle file upload
        $onboarding_image = $data->onboarding_image; // Default to existing image

        if ($request->hasFile('onboarding_image')) {
            $uploadedFile = $request->file('onboarding_image');
            $onboarding_image = $this->imageUploader->file($uploadedFile)->OnboardingImage();

        }

        // Prepare data to update
        $dataToUpdate = [
            'title' => $request->title,
            'onboarding_image' => $onboarding_image, // Updated image path
            'description' => $request->description,
        ];

        // Update the Onboarding record
        $data->update($dataToUpdate);

        // Redirect back with success message
        $message = "Data Stored Successfully";
        return redirect()->back()->with("success", $message);
    }





    public function update1(Request $request)
    {
         if (env('APP_FOR') == 'demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect('system/settings/onboarding')->with('warning', $message);
        }

        $userId = 1;
        $data = Onboarding::first();

        $image = $data->image;
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            // $path1 =  Storage::put($this->uploadPath(), $image);
            // $p1=explode('//',$path1);
            // $image=$p1[1];
        if ($uploadedFile = $this->getValidatedUpload('image', $request)) {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->OnboardingImage();
        }

        }


        $dataToUpdate = [

            'image' => $image,

        ];

        // Update the FrontPage record
        Onboarding::where('userid', $userId)->update($dataToUpdate);

        // Redirect back with success message
        $main_menu = 'cms';
        $sub_menu = 'cms_frontpage';
        $message = "Data Stored Successfully";
        return redirect()->back()->with("success", $message);
    }








}
