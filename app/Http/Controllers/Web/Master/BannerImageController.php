<?php

namespace App\Http\Controllers\Web\Master;

use App\Models\Master\BannerImage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;

class BannerImageController extends BaseController
{
     protected $bannerImage;


    /**
     * BannerImageController constructor.
     *
     * @param \App\Models\Admin\CarMake $car_make
     */
    public function __construct(BannerImage $bannerImage,ImageUploaderContract $imageUploader)
    {
        $this->bannerImage = $bannerImage;
        $this->imageUploader = $imageUploader;

    }
    public function index()
    {
         $page = trans('pages_names.view_banner_image');

        $main_menu = 'master';
        $sub_menu = 'banner_image';

        return view('admin.master.banner_image.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = $this->bannerImage->query();//->active()
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.master.banner_image._banner', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $page = trans('pages_names.add_banner_image');

        $main_menu = 'master';
        $sub_menu = 'banner_image';

        return view('admin.master.banner_image.create', compact('page', 'main_menu', 'sub_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect('banner_image')->with('warning', $message);
        }

        Validator::make($request->all(), [
            'image' => 'required',
        ])->validate();

        $created_params['active'] = 1;
       
        if ($uploadedFile = $this->getValidatedUpload('image', $request)) 
        {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveBannerImage();
        }
       

        $this->bannerImage->create($created_params);

        $message = trans('succes_messages.banner_image_added_succesfully');

        return redirect('banner_image')->with('success', $message);
    }

     public function getById(BannerImage $bannerImage)
    {
        $page = trans('pages_names.edit_banner_image');

        $main_menu = 'master';
        $sub_menu = 'banner_image';
        $item = $bannerImage;

        return view('admin.master.banner_image.update', compact('item', 'page', 'main_menu', 'sub_menu'));
    }

    public function update(Request $request, BannerImage $bannerImage)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect('banner_image')->with('warning', $message);
        }
        // Validator::make($request->all(), [
        //     'image' => 'required',
        // ])->validate();

        $updated_params = $request->all();

        if ($uploadedFile = $this->getValidatedUpload('image', $request)) 
        {
            $updated_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveBannerImage();
        }


        
        $bannerImage->update($updated_params);
        $message = trans('succes_messages.banner_image_updated_succesfully');
        return redirect('banner_image')->with('success', $message);
    }

     public function toggleStatus(BannerImage $bannerImage)
    {

        $status = $bannerImage->isActive() ? false: true;
        $bannerImage->update(['active' => $status]);

        $message = trans('succes_messages.banner_image_status_changed_succesfully');
        return redirect('banner_image')->with('success', $message);
    }

    public function delete(BannerImage $bannerImage)
    {
        
        $bannerImage->delete();

        $message = trans('succes_messages.banner_image_deleted_succesfully');


        return $message;   
    }

    
}
