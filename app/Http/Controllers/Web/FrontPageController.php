<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request\Request as RequestData;
use App\Base\Constants\Auth\Role;
use Illuminate\Support\Facades\Storage;
use App\Models\Cms\FrontPage;
use App\Models\User;
use App\Models\Country;
use App\Base\Constants\Setting\Settings;
use App\Jobs\Notifications\Auth\Registration\ContactusNotification;
use DB;
use Auth;
use Session;
use App\Models\Request\RequestBill as  RequestBillData;


class FrontPageController extends Controller
{

    public function index()
    {
        $host_name = request()->getHost();

        $conditional_host = explode('.',$host_name);

        if($conditional_host[0] =='tagxi-super-bidding-docs'){

        return redirect('user-manual');

        }


        if($conditional_host[0] =='tagxi-super-server'){

        return view('admin.login');

        }
        if($conditional_host[0] =='tagxi-super-bidding'){

            $user = User::belongsToRole('super-admin')->first();

            auth('web')->login($user, true);

            return redirect('dashboard');
        // return view('admin.login');


        }
        if($conditional_host[0] =='tagxi-super-bidding-dispatcher'){

        $user = User::belongsToRole('dispatcher')->first();

        auth('web')->login($user, true);

        return redirect('dispatch/home');

        }

        if($conditional_host[0] =='super-bidding'){

        return redirect('dispatch/home');

        }

        if($conditional_host[0] =='tagxi-super-bidding-delivery-dispatcher'){

        $user = User::belongsToRole('dispatcher')->first();

        auth('web')->login($user, true);

        return redirect('delivery-dispatch/dashboard');

        }
/*taxi*/
        if($conditional_host[0] =='tagxi-docs'){

        return redirect('user-manual');

        }

        if($conditional_host[0] =='tagxi-server'){

            $user = User::belongsToRole('super-admin')->first();

            auth('web')->login($user, true);

            return redirect('dashboard');

        // return view('admin.login');


        }
        if($conditional_host[0] =='tagxi-web-booking'){


        return redirect('web-booking');

        }

        if($conditional_host[0] =='tagxi-dispatch'){

        $user = User::belongsToRole('dispatcher')->first();

        auth('web')->login($user, true);

        return redirect('dispatch/home');

        }
/*delivery*/
        if($conditional_host[0] =='delivery-docs'||$conditional_host[0] =='tagxi-delivery-docs'){

            return redirect('user-manual');

        }

        if($conditional_host[0] =='tagxi-delivery'||$conditional_host[0] =='delivery'){

            $user = User::belongsToRole('super-admin')->first();

            auth('web')->login($user, true);

            return redirect('dashboard');

        // return view('admin.login');
            


        }

        if($conditional_host[0] =='tagxi-delivery-dispatch'||$conditional_host[0] =='delivery-dispatch'){

        $user = User::belongsToRole('dispatcher')->first();

        auth('web')->login($user, true);

        return redirect('dispatch/home');

        }
/*super-app*/
        if($conditional_host[0] =='tagxi-super-docs'){

        return redirect('user-manual');

        }

        if($conditional_host[0] =='tagxi-super-server'){

            $user = User::belongsToRole('super-admin')->first();

            auth('web')->login($user, true);

            return redirect('dashboard');

        }

        if($conditional_host[0] =='admin'){

            $user = User::belongsToRole('super-admin')->first();

            auth('web')->login($user, true);

            return redirect('dashboard');

        }

        if($conditional_host[0] =='tagxi-super-dispatcher'){

        $user = User::belongsToRole('dispatcher')->first();

        auth('web')->login($user, true);

        return redirect('dispatch/home');

        }
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        //return view('admin.layouts.web_header',compact('data','p'));
        return view ('webfront.index',compact('data','p'));
    }
    public function country_code(Request $request)
    {
        $check_data_exist = Country::where('code',$request->countryCode)->first();
        if($check_data_exist)
        {
            $flag = $check_data_exist->flag;
             return response()->json(['status'=>'success','flag'=>$check_data_exist,'image'=>$flag]);
        }
        else{
            $flag = "IN.png";
            return response()->json(['status'=>'error','flag'=>$flag]);
        }

    }
    public function driverp()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.driver',compact('data','p'));
    }
    public function howdrive()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.howdriving',compact('data','p'));
    }
    public function driverrequirement()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.driverreq',compact('data','p'));
    }
    public function safetypage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.safety',compact('data','p'));
    }
    public function serviceareaspage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $serv=explode(',',$data->serviceimage);
        $main_menu = 'cms';
        $sub_menu = 'cms_frontpage';
        return view ('webfront.serviceareas',compact('data','p','serv','main_menu','sub_menu'));

    }
    public function complaincepage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.compliance',compact('data','p'));
    }
    public function contactuspage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.contactus',compact('data','p'));
    }
    public function contactussendmailadd(Request $request)
    {
           if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }
            //$user=User::get();
            $firstname=$request->first_name;
            $lastname=$request->last_name;
            $emailaddress=$request->emailaddress;
            $mobile=$request->mobile;
            $message=$request->message;
            $data=[
               'name'=>$firstname." ".$lastname,
               'email'=>$emailaddress,
               'mobile'=>$mobile,
               'message'=>$message
            ];
            // dd($data);
            //$user = $this->user->create($emailbody);
            $this->dispatch(new ContactusNotification($data));
         return redirect()->back()->with("success",$message);

    }
    public function privacypage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.privacy',compact('data','p'));
    }
    public function termspage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.terms',compact('data','p'));
    }
    public function dmvpage()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        return view ('webfront.dmv',compact('data','p'));
    }

    public function safetypagecms()
    {

        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_safetypage';
        return view ('admin.cms.safetypage_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function safetypagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }


         $userId = 1;
         if($request->hasFile('safety'))
          {
          $safety = $request->file('safety');
          $path1 = Storage::put($this->uploadPath(), $safety);
          $p1=explode('//',$path1);
          $safety=$p1[1];
          $safetytext=$request->input('descriptionsafetytext');
          $data=[
           'safety'=>$safety,
           'safetytext'=>$safetytext
          ];
          }
         else
          {
           /* $request->validate([
            'safety' => 'required|mimes:png,jpeg,jpg',
            'descriptionsafetytext'=> 'required',
            ],
            [
           'safety.required' => 'Safety Image Is Required',
           'descriptionsafetytext.required' => 'Safety Text Is Required',
            ]);*/
          //$safety = $request->file('safety');
          //$path1 = Storage::put($this->uploadPath(), $safety);
          //$p1=explode('//',$path1);
          //$safety=$p1[1];
          //dd($safety);
          $safetytext=$request->input('descriptionsafetytext');
          $data=[
           //'safety'=>$safety,
           'safetytext'=>$safetytext
          ];
          }
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

    }

    public function playstorepagecms()
    {
        $data=FrontPage::first();
        //dd($data);
        $main_menu = 'cms';
        $sub_menu = 'cms_playstorepage';
        return view ('admin.cms.playstore_cms',compact('data','main_menu','sub_menu'));
    }

    public function playstorepagecmsadd(Request $request)
    {

         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }
         $userId=1;
         $driverioslink=$request->input('driverioslink');
         $driverandroidlink=$request->input('driverandroidlink');
         $userioslink=$request->input('userioslink');
         $userandroidlink=$request->input('userandroidlink');
         $data=[
           'driverioslink'=>$driverioslink,
           'driverandroidlink'=>$driverandroidlink,
           'userioslink'=>$userioslink,
           'userandroidlink'=>$userandroidlink
          ];
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);
    }

    public function footerpagecms()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_footerpage';
        return view ('admin.cms.footer_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function footerpagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

          $userId=1;
          $data=FrontPage::first();
          $footerlogo=$data->footerlogo;
          if($request->hasFile('footerlogo'))
          {
          $footerlogo = $request->file('footerlogo');
          $path1 = Storage::put($this->uploadPath(), $footerlogo);
          $p1=explode('//',$path1);
          $footerlogo=$p1[1];
          }
          //$footerlogo=$request->input('footerlogo');
          $descriptionfootertext=$request->input('descriptionfootertext');
          $descriptionfootercopytext=$request->input('descriptionfootercopytext');
          $footerinstagramlink=$request->input('footerinstagramlink');
          $footerfacebooklink=$request->input('footerfacebooklink');
         $data=[
           'footerinstagramlink'=>$footerinstagramlink,
           'footerfacebooklink'=>$footerfacebooklink,
           'footerlogo'=>$footerlogo,
           'footertextsub'=>$descriptionfootertext,
           'footercopytextsub'=>$descriptionfootercopytext
          ];
          //dd($data);
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

    }

   public function drreqpagecms()
    {

        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_drreqpage';
        return view ('admin.cms.driverreqpage_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function drreqpagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

         $userId = 1;
         $back=FrontPage::first();
         $frimage=$back->frimage;
         $srimage=$back->srimage;
         $trimage=$back->trimage;
         if($request->hasFile('frimage'))
          {
          $frimage = $request->file('frimage');
          $path1 = Storage::put($this->uploadPath(), $frimage);
          $p1=explode('//',$path1);
          $frimage=$p1[1];
          }

          $frtext=$request->input('frtext');

         if($request->hasFile('srimage'))
          {
          $srimage = $request->file('srimage');
          $path1 = Storage::put($this->fuploadPath(), $srimage);
          $p1=explode('//',$path1);
          $srimage=$p1[1];
          }
          $srtext=$request->input('srtext');

         if($request->hasFile('trimage'))
          {
          $trimage = $request->file('trimage');
          $path1 = Storage::put($this->uploadPath(), $trimage);
          $p1=explode('//',$path1);
          $trimage=$p1[1];
          }
          $trtext=$request->input('trtext');

          $data=[
           'frimage'=>$frimage,
           'frtext'=>$frtext,
           'srimage'=>$srimage,
           'srtext'=>$srtext,
           'trimage'=>$trimage,
           'trtext'=>$trtext
          ];
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);
    }

   public function contactpagecms()
    {

        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_contactpage';
        return view ('admin.cms.contactpage_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function contactpagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

         $userId = 1;
         $back=FrontPage::first();
         $contactbanner=$back->contactbanner;
         if($request->hasFile('contactbanner'))
          {
          $contactbanner = $request->file('contactbanner');
          $path1 = Storage::put($this->uploadPath(), $contactbanner);
          $p1=explode('//',$path1);
          $contactbanner=$p1[1];
          }

          $contacttext=$request->input('contacttext');
          $contactmap=$request->input('contactmap');

          $data=[
           'contactbanner'=>$contactbanner,
           'contacttext'=>$contacttext,
           'contactmap'=>$contactmap
          ];
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

         //return redirect()->back()->with(compact('main_menu','sub_menu'));
    }

   public function howdriverpagecms()
    {

        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_howdriverpage';
        return view ('admin.cms.howdriverpage_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function howdriverpagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

         $userId = 1;
         $back=FrontPage::first();
            $howbannerimage=$back->howbannerimage;
            $hfrcimage1=$back->hfrcimage1;
             $hsrcimage1=$back->hsrcimage1;
             $htrcimage1=$back->htrcimage1;
             $hforcimage1=$back->hforcimage1;
             $hfircimage1=$back->hfircimage1;
             $hsircimage1=$back->hsircimage1;
             $hsercimage1=$back->hsercimage1;
         if($request->hasFile('howbannerimage'))
          {
          $howbannerimage = $request->file('howbannerimage');
          $path1 = Storage::put($this->uploadPath(), $howbannerimage);
          $p1=explode('//',$path1);
          $howbannerimage=$p1[1];
          }
          //dd($howbannerimage);
          $hfrht1=$request->input('hfrht1');
          if($request->hasFile('hfrcimage1'))
          {
          $hfrcimage1 = $request->file('hfrcimage1');
          $path1 = Storage::put($this->uploadPath(), $hfrcimage1);
          $p1=explode('//',$path1);
          $hfrcimage1=$p1;
          }
          $hfrht2=$request->input('hfrht2');


          $hsrht1=$request->input('hsrht1');
          if($request->hasFile('hsrcimage1'))
          {
          $hsrcimage1 = $request->file('hsrcimage1');
          $path1 = Storage::put($this->uploadPath(), $hsrcimage1);
          $p1=explode('//',$path1);
          $hsrcimage1=$p1[1];
          }
          $hsrht2=$request->input('hsrht2');

          $htrht1=$request->input('htrht1');
          if($request->hasFile('htrcimage1'))
          {
          $htrcimage1 = $request->file('htrcimage1');
          $path1 = Storage::put($this->uploadPath(), $htrcimage1);
          $p1=explode('//',$path1);
          $htrcimage1=$p1[1];
          }
          $htrht2=$request->input('htrht2');

          $hforht1=$request->input('hforht1');
          if($request->hasFile('hforcimage1'))
          {
          $hforcimage1 = $request->file('hforcimage1');
          $path1 = Storage::put($this->uploadPath(), $hforcimage1);
          $p1=explode('//',$path1);
          $hforcimage1=$p1[1];
          }
          $hforht2=$request->input('hforht2');

          $hfirht1=$request->input('hfirht1');
          if($request->hasFile('hfircimage1'))
          {
          $hfircimage1 = $request->file('hfircimage1');
          $path1 = Storage::put($this->uploadPath(), $hfircimage1);
          $p1=explode('//',$path1);
          $hfircimage1=$p1[1];
          }
          $hfirht2=$request->input('hfirht2');

          $hsirht1=$request->input('hsirht1');
          if($request->hasFile('hsircimage1'))
          {
          $hsircimage1 = $request->file('hsircimage1');
          $path1 = Storage::put($this->uploadPath(), $hsircimage1);
          $p1=explode('//',$path1);
          $hsircimage1=$p1[1];
          }
          $hsirht2=$request->input('hsirht2');

          $hserht1=$request->input('hserht1');
          if($request->hasFile('hsercimage1'))
          {
          $hsercimage1 = $request->file('hsercimage1');
          $path1 = Storage::put($this->uploadPath(), $hsercimage1);
          $p1=explode('//',$path1);
          $hsercimage1=$p1[1];
          }
          $hserht2=$request->input('hserht2');

          $data=[
           'howbannerimage'=>$howbannerimage,
           'hfrht1'=>$hfrht1,
           'hfrcimage1'=>$hfrcimage1,
           'hfrht2'=>$hfrht2,
           'hsrht1'=>$hsrht1,
           'hsrcimage1'=>$hsrcimage1,
           'hsrht2'=>$hsrht2,
           'htrht1'=>$htrht1,
           'htrcimage1'=>$htrcimage1,
           'htrht2'=>$htrht2,
           'hforht1'=>$hforht1,
           'hforcimage1'=>$hforcimage1,
           'hforht2'=>$hforht2,
           'hfirht1'=>$hfirht1,
           'hfircimage1'=>$hfircimage1,
           'hfirht2'=>$hfirht2,
           'hsirht1'=>$hsirht1,
           'hsircimage1'=>$hsircimage1,
           'hsirht2'=>$hsirht2,
           'hserht1'=>$hserht1,
           'hsercimage1'=>$hsercimage1,
           'hserht2'=>$hserht2
          ];
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

         //return redirect()->back()->with(compact('main_menu','sub_menu'));

    }

   public function applydriverpagecms()
    {

        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_applydriverpage';
        return view ('admin.cms.applydrivepage_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function applydriverpagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

         $userId = 1;
         $back=FrontPage::first();
            $afrimage=$back->afrimage;
            $asrimage1=$back->asrimage1;
            $asrimage2=$back->asrimage2;
            $asrimage3=$back->asrimage3;
            $atrtimage1=$back->atrtimage1;
            $atrtimage2=$back->atrtimage2;
            $atrtimage3=$back->atrtimage3;
            $afrbimage=$back->afrbimage;
            $afrlimage=$back->afrlimage;
         if($request->hasFile('afrimage'))
          {
          $afrimage = $request->file('afrimage');
          $path1 = Storage::put($this->uploadPath(), $afrimage);
          $p1=explode('//',$path1);
          $afrimage=$p1[1];
          }

          $afrhtext=$request->input('afrhtext');
          $afrstext=$request->input('afrstext');
          $asrtext=$request->input('asrtext');

         if($request->hasFile('asrimage1'))
          {
          $asrimage1 = $request->file('asrimage1');
          $path1 = Storage::put($this->uploadPath(), $asrimage1);
          $p1=explode('//',$path1);
          $asrimage1=$p1[1];
          }

          $asrhtext1=$request->input('asrhtext1');
          $asrstext1=$request->input('asrstext1');


         if($request->hasFile('asrimage2'))
          {
          $asrimage2 = $request->file('asrimage2');
          $path1 = Storage::put($this->uploadPath(), $asrimage2);
          $p1=explode('//',$path1);
          $asrimage2=$p1[1];
          }

          $asrhtext2=$request->input('asrhtext2');
          $asrstext2=$request->input('asrstext2');

         if($request->hasFile('asrimage3'))
          {
          $asrimage3 = $request->file('asrimage3');
          $path1 = Storage::put($this->uploadPath(), $asrimage3);
          $p1=explode('//',$path1);
          $asrimage3=$p1[1];
          }

          $asrhtext3=$request->input('asrhtext3');
          $asrstext3=$request->input('asrstext3');

          $atrhtext=$request->input('atrhtext');
          $atrthtext1=$request->input('atrthtext1');

         if($request->hasFile('atrtimage1'))
          {
          $atrtimage1 = $request->file('atrtimage1');
          $path1 = Storage::put($this->uploadPath(), $atrtimage1);
          $p1=explode('//',$path1);
          $atrtimage1=$p1[1];
          }
          $atrtstext1=$request->input('atrtstext1');

          $atrthtext2=$request->input('atrthtext2');
          if($request->hasFile('atrtimage2'))
          {
          $atrtimage2 = $request->file('atrtimage2');
          $path1 = Storage::put($this->uploadPath(), $atrtimage2);
          $p1=explode('//',$path1);
          $atrtimage2=$p1[1];
          }
          $atrtstext2=$request->input('atrtstext2');

          $atrthtext3=$request->input('atrthtext3');
          if($request->hasFile('atrtimage3'))
          {
          $atrtimage3 = $request->file('atrtimage3');
          $path1 = Storage::put($this->uploadPath(), $atrtimage3);
          $p1=explode('//',$path1);
          $atrtimage3=$p1[1];
          }
          $atrtstext3=$request->input('atrtstext3');

          if($request->hasFile('afrbimage'))
          {
          $afrbimage = $request->file('afrbimage');
          $path1 = Storage::put($this->uploadPath(), $afrbimage);
          $p1=explode('//',$path1);
          $afrbimage=$p1[1];
          }

          if($request->hasFile('afrlimage'))
          {
          $afrlimage = $request->file('afrlimage');
          $path1 = Storage::put($this->uploadPath(), $afrlimage);
          $p1=explode('//',$path1);
          $afrlimage=$p1[1];
          }
          $afrheadtext=$request->input('afrheadtext');
          $afrstext1=$request->input('afrstext1');
          $afrstext2=$request->input('afrstext2');
          $afrstext3=$request->input('afrstext3');
          $afrstext4=$request->input('afrstext4');



          $data=[
           'afrimage'=>$afrimage,
           'afrhtext'=>$afrhtext,
           'afrstext'=>$afrstext,
           'asrtext'=>$asrtext,
           'asrimage1'=>$asrimage1,
           'asrhtext1'=>$asrhtext1,

           'asrhtext1'=>$asrhtext1,
           'asrstext1'=>$asrstext1,
           'asrimage2'=>$asrimage2,
           'asrhtext2'=>$asrhtext2,
           'asrstext2'=>$asrstext2,
           'asrimage3'=>$asrimage3,

           'asrhtext3'=>$asrhtext3,
           'asrstext3'=>$asrstext3,
           'atrhtext'=>$atrhtext,
           'atrthtext1'=>$atrthtext1,
           'atrtimage1'=>$atrtimage1,
           'atrtstext1'=>$atrtstext1,

           'atrthtext2'=>$atrthtext2,
           'atrtimage2'=>$atrtimage2,
           'atrtstext2'=>$atrtstext2,
           'atrthtext3'=>$atrthtext3,
           'atrtimage3'=>$atrtimage3,
           'atrtstext3'=>$atrtstext3,
           'afrbimage'=>$afrbimage,
           'afrlimage'=>$afrlimage,
           'afrheadtext'=>$afrheadtext,
           'afrstext1'=>$afrstext1,
           'afrstext2'=>$afrstext2,
           'afrstext3'=>$afrstext3,
           'afrstext4'=>$afrstext4
          ];
         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

         //return redirect()->back()->with(compact('main_menu','sub_menu'));

    }


   public function privacypagecms()
    {

        $data=FrontPage::first();
        $main_menu = 'cms';
        $sub_menu = 'cms_privacypage';
        return view ('admin.cms.privacypage_cms',compact('data','main_menu','sub_menu'));
    }

    public function privacypagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

         $userId = 1;
        $request->validate([
            'privacy' => 'required',
            ],
            [
           'privacy.required' => 'Privacy Text Is Required',
            ]);
          $privacytext=$request->input('privacy');
          $data=[
           'privacy'=>$privacytext
          ];

         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

         //return redirect()->back()->with(compact('main_menu','sub_menu'));

    }

   public function dmvpagecms()
   {

        $data=FrontPage::first();
        $main_menu = 'cms';
        $sub_menu = 'cms_dmvpage';
        return view ('admin.cms.dmvpage_cms',compact('data','main_menu','sub_menu'));
    }

    public function dmvpagecmsadd(Request $request)
    {

         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

        $userId = 1;
        $request->validate([
            'dmv' => 'required',
            ],
            [
           'dmv.required' => 'DMV Text Is Required',
            ]);
          $dmvtext=$request->input('dmv');
          $data=[
           'dmv'=>$dmvtext
          ];

         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_dmvpage';

         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);
         //return redirect()->back()->with(compact('main_menu','sub_menu'));

    }

   public function termspagecms()
   {

        $data=FrontPage::first();
        $main_menu = 'cms';
        $sub_menu = 'cms_termspage';
        return view ('admin.cms.termspage_cms',compact('data','main_menu','sub_menu'));
    }

    public function termspagecmsadd(Request $request)
    {

         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

        $userId = 1;
        $request->validate([
            'terms' => 'required',
            ],
            [
           'terms.required' => 'Terms Text Is Required',
            ]);
          $termstext=$request->input('terms');
          $data=[
           'terms'=>$termstext
          ];

         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);
         //return redirect()->back()->with(compact('main_menu','sub_menu'));

    }


    public function complaincepagecms()
   {

        $data=FrontPage::first();
        $main_menu = 'cms';
        $sub_menu = 'cms_complaincepage';
        return view ('admin.cms.complaincepage_cms',compact('data','main_menu','sub_menu'));
    }

    public function complaincepagecmsadd(Request $request)
    {

         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

        $userId = 1;
        $request->validate([
            'complaince' => 'required',
            ],
            [
           'complaince.required' => 'Complaince Text Is Required',
            ]);
          $complaincetext=$request->input('complaince');
          $data=[
           'complaince'=>$complaincetext
          ];

         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

    }

    public function colorthemepagecms()
   {

        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_colorthemepage';
        return view ('admin.cms.colortheme_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function colorthemepagecmsadd(Request $request)
    {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }

          $userId = 1;
          $mrcolor=$request->input('mrcolor');
          $mtcolor=$request->input('mtcolor');
          $mthcolor=$request->input('mhcolor');
          $frbgcolor=$request->input('frbgcolor');
          $hdriverdownloadcolor=$request->input('hdriverdownloadcolor');
          $hownumberbgcolor=$request->input('hownumberbgcolor');
          $footerbgcolor=$request->input('footerbgcolor');
          $data=[
           'menucolor'=>$mrcolor,
           'menutextcolor'=>$mtcolor,
           'menutexthover'=>$mthcolor,
           'firstrowbgcolor'=>$frbgcolor,
           'hdriverdownloadcolor'=>$hdriverdownloadcolor,
           'hownumberbgcolor'=>$hownumberbgcolor,
           'footerbgcolor'=>$footerbgcolor
          ];

         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

    }

    public function servicepagecms()
    {

        $data=FrontPage::first();
        //dd($data);
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $serv=explode(',',$data->serviceimage);
        //dd($serv);
        $main_menu = 'cms';
        $sub_menu = 'cms_servicepage';
        return view ('admin.cms.serviceareas_cms',compact('data','p','serv','main_menu','sub_menu'));
    }

    public function servicepagecmsadd(Request $request)
    {
        if (env('APP_FOR') == 'demo') {
            $message = trans('succes_messages.you_are_not_authorised');
            return redirect()->back()->with('warning', $message);
        }
    
        $data = FrontPage::first();
        $userId = 1;
    
        $request->validate([
            'serviceheadtext' => 'required',
            'servicesubtext' => 'required',
            'serviceimage.*' => 'sometimes|mimes:png,jpeg,jpg',
        ], [
            'serviceheadtext.required' => 'Service Head Text Is Required',
            'servicesubtext.required' => 'Service Sub Text Is Required',
            'serviceimage.*.mimes' => 'The image must be a file of type: png, jpeg, jpg.',
        ]);
    
        // Handle existing images
        $existingImages = $data->serviceimage ? explode(',', $data->serviceimage) : [];
        $newImages = [];
    
        if ($request->hasFile('serviceimage')) {
            foreach ($request->file('serviceimage') as $file) {
                $path = Storage::put($this->uploadPath(), $file);
                $newImages[] = basename($path);
            }
        }
    
        // Handle image removals
        $removeImages = $request->input('remove_images', []);
        $existingImages = array_diff($existingImages, $removeImages);
    
        // Merge new images with existing images
        $finalImages = array_merge($existingImages, $newImages);
        $finalImages = implode(',', $finalImages);
    
        $data = [
            'serviceimage' => $finalImages,
            'serviceheadtext' => $request->input('serviceheadtext'),
            'servicesubtext' => $request->input('servicesubtext')
        ];
    
        FrontPage::where('userid', $userId)->update($data);
    
        $message = "Service Data Stored Successfully";
        return redirect()->back()->with('success', $message);
    }
    public function frontpage()
    {

        $data=FrontPage::first();
        //foreach($data as $var){ echo $var->faviconfile; }
        //dd("hi");
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_frontpage';
        $message="Datas Stored Successfully";
        //return redirect()->back()->with('success', $message)
          //                        ->with('p');
        return view ('admin.cms.frontpage_cms',compact('data','p','main_menu','sub_menu'));
    }


    public function frontpageadd(Request $request)
   {
         if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }


         $userId = 1;
         $check=DB::table('landingpagecms')->first();
         if(!$check)
          {
        /* $request->validate([
            'favicon' => 'required|mimes:png,jpeg,jpg',
            'bannerimage' => 'required|mimes:png,jpeg,jpg',
            'tabviewimage1' => 'required|mimes:png,jpeg,jpg',
            'tabviewimage2' => 'required|mimes:png,jpeg,jpg',
            'tabviewimage3' => 'required|mimes:png,jpeg,jpg',
            'tabviewimage4' => 'required|mimes:png,jpeg,jpg',
            'tabviewimage5' => 'required|mimes:png,jpeg,jpg',
            'tabviewimage6' => 'required|mimes:png,jpeg,jpg',
        ],
        [
           'favicon.required' => 'FavIcon Is Required',
           'bannerimage.required' => 'Banner Image Is Required',
           'tabviewimage1.required' => 'Tab Image 1 Is Required',
           'tabviewimage2.required' => 'Tab Image 2 Is Required',
           'tabviewimage3.required' => 'Tab Image 3 Is Required',
           'tabviewimage4.required' => 'Tab Image 4 Is Required',
           'tabviewimage5.required' => 'Tab Image 5 Is Required',
           'tabviewimage6.required' => 'Tab Image 6 Is Required',
        ]);*/

          $filePath = 'uploadwebfrontfiles';

          $tabfaviconfile = $request->file('tabfavicon');
          $path1 = Storage::put($this->uploadPath(), $tabfaviconfile);
          $p1a=explode('//',$path1);

          $faviconfile = $request->file('faviconfile');
          $path1 = Storage::put($this->uploadPath(), $faviconfile);
          $p1=explode('//',$path1);

          $bannerimagefile = $request->file('bannerimage');
          //$filename2 = time().'_'.$bannerimagefile->getClientOriginalName();
          $path2 = Storage::put($this->uploadPath(), $request->file('bannerimage'));
          $p2=explode('//',$path2);

          $description=$request->input('description');

          $path2a = Storage::put($this->uploadPath(), $request->file('playstoreicon1'));
          $p2a=explode('//',$path2a);
          $playstoreiconlink1=$request->input('playstoreiconlink1');

          $path2b = Storage::put($this->uploadPath(), $request->file('playstoreicon2'));
          $p2b=explode('//',$path2b);
          $playstoreiconlink2=$request->input('playstoreiconlink2');


          $tabviewimage1=$request->file('tabviewimage1');
          $path3 = Storage::put($this->uploadPath(), $tabviewimage1);
          $p3=explode('//',$path3);
          $descriptiontabhead1=$request->input('descriptiontabhead1');
          $descriptiontabsub1=$request->input('descriptiontabsub1');

          $tabviewimage2=$request->file('tabviewimage2');
          $path4 = Storage::put($this->uploadPath(), $tabviewimage2);
          $p4=explode('//',$path4);
          $descriptiontabhead2=$request->input('descriptiontabhead2');
          $descriptiontabsub2=$request->input('descriptiontabsub2');

          $tabviewimage3=$request->file('tabviewimage3');
          $path5 = Storage::put($this->uploadPath(), $tabviewimage3);
          $p5=explode('//',$path5);
          $descriptiontabhead3=$request->input('descriptiontabhead3');
          $descriptiontabsub3=$request->input('descriptiontabsub3');

          $tabviewimage4=$request->file('tabviewimage4');
          $path6 = Storage::put($this->uploadPath(), $tabviewimage4);
          $p6=explode('//',$path6);
          $descriptionsecondtab1=$request->input('descriptionsecondtab');

          $tabviewimage5=$request->file('tabviewimage5');
          $path7 = Storage::put($this->uploadPath(), $tabviewimage5);
          $p7=explode('//',$path7);
          $descriptionsecondtab2=$request->input('descriptionsecondtab2');

          $tabviewimage6=$request->file('tabviewimage6');
          $path8 = Storage::put($this->uploadPath(), $tabviewimage6);
          $p8=explode('//',$path8);
          $descriptionsecondtab3=$request->input('descriptionsecondtab3');

         $data=[
            'userid'=>$userId,
            'tabfaviconfile'=>$p1a[1],
            'faviconfile'=>$p1[1],
            'bannerimage'=>$p2[1],
            'description'=>$description,
            'playstoreicon1'=>$p2a[1],
            'playstoreicon2'=>$p2b[1],
            'firstrowimage1'=>$p3[1],
            'firstrowheadtext1'=>$descriptiontabhead1,
            'firstrowsubtext1'=>$descriptiontabsub1,
            'firstrowimage2'=>$p4[1],
            'firstrowheadtext2'=>$descriptiontabhead2,
            'firstrowsubtext2'=>$descriptiontabsub2,
            'firstrowimage3'=>$p5[1],
            'firstrowheadtext3'=>$descriptiontabhead3,
            'firstrowsubtext3'=>$descriptiontabsub3,
            'secondrowimage1'=>$p6[1],
            'secondrowheadtext1'=>$descriptionsecondtab1,
            'secondrowimage2'=>$p7[1],
            'secondrowheadtext2'=>$descriptionsecondtab2,
            'secondrowimage3'=>$p8[1],
            'secondrowheadtext3'=>$descriptionsecondtab3r
          ];
          //dd($data);
         FrontPage::insert($data);
         }
         else
         {
            $tabfaviconfile=$check->tabfaviconfile;
            $faviconfile=$check->faviconfile;
            $bannerimage=$check->bannerimage;
            $playstoreicon1=$check->playstoreicon1;
            $playstoreicon2=$check->playstoreicon2;
            $tabviewimage1=$check->firstrowimage1;
            $tabviewimage2=$check->firstrowimage2;
            $tabviewimage3=$check->firstrowimage3;
            $tabviewimage4=$check->secondrowimage1;
            $tabviewimage5=$check->secondrowimage2;
            $tabviewimage6=$check->secondrowimage3;

         // $p1="";
          if($request->hasFile('tabfavicon'))
          {
          $tabfaviconfile = $request->file('tabfavicon');
          $path1 = Storage::put($this->uploadPath(), $tabfaviconfile);
          $p1=explode('//',$path1);
          $tabfaviconfile=$p1[1];
          }

          if($request->hasFile('faviconfile'))
          {
          $faviconfile = $request->file('faviconfile');
          $path1 = Storage::put($this->uploadPath(), $faviconfile);
          $p1=explode('//',$path1);
          $faviconfile=$p1[1];
          }
          if($request->hasFile('bannerimage'))
          {
          $bannerimage = $request->file('bannerimage');
          $path2 = Storage::put($this->uploadPath(), $bannerimage);
          $p2=explode('//',$path2);
          $bannerimage=$p2[1];
          }
          if($request->hasFile('playstoreicon1'))
          {
          $playstoreicon1 = $request->file('playstoreicon1');
          $path1 = Storage::put($this->uploadPath(), $playstoreicon1);
          $p1=explode('//',$path1);
          $playstoreicon1=$p1[1];
          }
          if($request->hasFile('playstoreicon2'))
          {
          $playstoreicon2 = $request->file('playstoreicon2');
          $path1 = Storage::put($this->uploadPath(), $playstoreicon2);
          $p1=explode('//',$path1);
          $playstoreicon2=$p1[1];
          }

          if($request->hasFile('tabviewimage1'))
          {
          $tabviewimage1 = $request->file('tabviewimage1');
          $path1 = Storage::put($this->uploadPath(), $tabviewimage1);
          $p1=explode('//',$path1);
          $tabviewimage1=$p1[1];
          }
          if($request->hasFile('tabviewimage2'))
          {
          $tabviewimage2 = $request->file('tabviewimage2');
          $path1 = Storage::put($this->uploadPath(), $tabviewimage2);
          $p1=explode('//',$path1);
          $tabviewimage2=$p1[1];
          }
          if($request->hasFile('tabviewimage3'))
          {
          $tabviewimage3 = $request->file('tabviewimage3');
          $path1 = Storage::put($this->uploadPath(), $tabviewimage3);
          $p1=explode('//',$path1);
          $tabviewimage3=$p1[1];
          }
          if($request->hasFile('tabviewimage4'))
          {
          $tabviewimage4 = $request->file('tabviewimage4');
          $path1 = Storage::put($this->uploadPath(), $tabviewimage4);
          $p1=explode('//',$path1);
          $tabviewimage4=$p1[1];
          }
          if($request->hasFile('tabviewimage5'))
          {
          $tabviewimage5 = $request->file('tabviewimage5');
          $path1 = Storage::put($this->uploadPath(), $tabviewimage5);
          $p1=explode('//',$path1);
          $tabviewimage5=$p1[1];
          }
          if($request->hasFile('tabviewimage6'))
          {
          $tabviewimage6 = $request->file('tabviewimage6');
          $path1 = Storage::put($this->uploadPath(), $tabviewimage6);
          $p1=explode('//',$path1);
          $tabviewimage6=$p1[1];
          }

           $description=$request->input('description');
           $playstorelink1=$request->input('playstoreiconlink1');
           $playstorelink2=$request->input('playstoreiconlink2');
           $descriptiontabhead1=$request->input('descriptiontabhead1');
           $descriptiontabsub1=$request->input('descriptiontabsub1');
           $descriptiontabhead2=$request->input('descriptiontabhead2');
           $descriptiontabsub2=$request->input('descriptiontabsub2');
           $descriptiontabhead3=$request->input('descriptiontabhead3');
           $descriptiontabsub3=$request->input('descriptiontabsub3');
           $descriptionsecondtab1=$request->input('descriptionsecondtab1');
           $descriptionsecondtab2=$request->input('descriptionsecondtab2');
           $descriptionsecondtab3=$request->input('descriptionsecondtab3');

           $data=[
            'userid'=>$userId,
            'tabfaviconfile' => $tabfaviconfile,
            'faviconfile' => $faviconfile,
            'bannerimage'=>$bannerimage,
            'description'=>$description,
            'playstoreicon1'=>$playstoreicon1,
            'playstoreicon2'=>$playstoreicon2,
            'playstoreicon2'=>$playstoreicon2,
            'firstrowimage1'=>$tabviewimage1,
            'firstrowheadtext1'=>$descriptiontabhead1,
            'firstrowsubtext1'=>$descriptiontabsub1,
            'firstrowimage2'=>$tabviewimage2,
            'firstrowheadtext2'=>$descriptiontabhead2,
            'firstrowsubtext2'=>$descriptiontabsub2,
            'firstrowimage3'=>$tabviewimage3,
            'firstrowheadtext3'=>$descriptiontabhead3,
            'firstrowsubtext3'=>$descriptiontabsub3,
            'secondrowimage1'=>$tabviewimage4,
            'secondrowheadtext1'=>$descriptionsecondtab1,
            'secondrowimage2'=>$tabviewimage5,
            'secondrowheadtext2'=>$descriptionsecondtab2,
            'secondrowimage3'=>$tabviewimage6,
            'secondrowheadtext3'=>$descriptionsecondtab3,
           ];
           //FrontPage::insert($data);
           FrontPage::where('userid', $userId)->update($data);
         }
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with('success', $message);
    }
    public function uploadPath()
    {
        return config('base.cms.upload.web-picture.path');
    }
     public function web_booking()
    {
        $modules = get_settings('enable_modules_for_applications');
        $show_rental_ride_feature = get_settings('show_rental_ride_feature');
        $user_name = 'User';

        if(auth('web')->user())
        {


            $user_name = auth('web')->user()->name;
        }


          // Session::flush();
          return view('web_booking',compact('user_name','modules','show_rental_ride_feature'));
    }
    public function new_booking()
    {
        echo "test";
    }
    public function Saveuser(Request $request)
    {

        if($request->mobile)
        {
            $check_user_exist = User::where('mobile',$request->mobile)->first();
            $country_id =  Country::where('dial_code', $request->input('dial_code'))->pluck('id')->first();
            if($check_user_exist)
            {
                $user = $check_user_exist;
            }
            else{
                $user = User::create([
                'name'=>$request->name,
                'mobile' => $request->mobile,
                'country' => $country_id
            ]);
            }

            // Create Empty Wallet to the user
            $user->userWallet()->create(['amount_added'=>0]);

            $user->attachRole(Role::USER);

            auth('web')->login($user, true);
            Session::put('user_id', $user->id);
            Session::put('mobile', $request->mobile);
            Session::put('dial_code', $request->dial_code);

            return response()->json(["status"=>"success","message"=>"user added successfully"]);
        }
        else{
             return response()->json(["status"=>"error","message"=>"something went wrong"]);
        }
    }







    public function webbookingcms()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_footerpage';
        return view ('admin.cms.web_booking_cms',compact('data','p','main_menu','sub_menu'));
    }

















    public function webbookingcmsadd(Request $request)
    {
        $userId = 1;
        $data = FrontPage::first();

        // Update web_booking_logo if a new file is uploaded
        $web_booking_logo = $data->web_booking_logo;
        if ($request->hasFile('web_booking_logo')) {
            $web_booking_logo = $request->file('web_booking_logo');
            $path1 =  Storage::put($this->uploadPath(), $web_booking_logo);
            $p1=explode('//',$path1);
            $web_booking_logo=$p1[1];


        }

        // Update web_booking_taxi if a new file is uploaded
        $web_booking_taxi = $data->web_booking_taxi;
        if ($request->hasFile('web_booking_taxi')) {
            $web_booking_taxi = $request->file('web_booking_taxi');
            $path2 = Storage::put($this->uploadPath(), $web_booking_taxi);
            $p2 = explode('//', $path2);
            $web_booking_taxi = $p2[1];
        }

        $web_booking_rental = $data->web_booking_rental;
        if ($request->hasFile('web_booking_rental')) {
            $web_booking_rental = $request->file('web_booking_rental');
            $path3 = Storage::put($this->uploadPath(), $web_booking_rental);
            $p3 = explode('//', $path3);
            $web_booking_rental = $p3[1];
        }

        $web_booking_delivery = $data->web_booking_delivery;
        if ($request->hasFile('web_booking_delivery')) {
            $web_booking_delivery = $request->file('web_booking_delivery');
            $path4 = Storage::put($this->uploadPath(), $web_booking_delivery);
            $p4 = explode('//', $path4);
            $web_booking_delivery = $p4[1];
        }

        $web_booking_history = $data->web_booking_history;
        if ($request->hasFile('web_booking_history')) {
            $web_booking_history = $request->file('web_booking_history');
            $path5 = Storage::put($this->uploadPath(), $web_booking_history);
            $p5 = explode('//', $path5);
            $web_booking_history = $p5[1];
        }


        $web_booking_track = $data->web_booking_track;
        if ($request->hasFile('web_booking_track')) {
            $web_booking_track = $request->file('web_booking_track');
            $path5 = Storage::put($this->uploadPath(), $web_booking_track);
            $p5 = explode('//', $path5);
            $web_booking_track = $p5[1];
        }
        // Update the data array with all image columns
        $dataToUpdate = [

            'web_booking_logo' => $web_booking_logo,
            'web_booking_taxi' => $web_booking_taxi,
            'web_booking_rental' => $web_booking_rental,
            'web_booking_delivery' => $web_booking_delivery,
            'web_booking_history' => $web_booking_history,
            'web_booking_track'=>$web_booking_track,
        ];

        // Update the FrontPage record
        FrontPage::where('userid', $userId)->update($dataToUpdate);

        // Redirect back with success message
        $main_menu = 'cms';
        $sub_menu = 'cms_frontpage';
        $message = "Data Stored Successfully";
        return redirect()->back()->with("success", $message);
    }
    public function payment()
    {
        $enable_brain_tree = false;
        if (get_settings(Settings::ENABLE_BRAIN_TREE) == 1) {

            $enable_brain_tree = true;
        }

        $enable_mercadopago = false;

        if (get_settings(Settings::ENABLE_MERCADOPAGO) == 1) {

            $enable_mercadopago = true;
        }


        $enable_khalti = false;

        if (get_settings(Settings::ENABLE_KHALTI_PAY) == 1) {

            $enable_khalti = true;
        }

        $enable_stripe = false;

        if (get_settings(Settings::STRIPE_ENVIRONMENT) == 'test') {

            $stripe_environment = 'test';

        } else {

            $stripe_environment = 'production';

        }
        if (get_settings(Settings::ENABLE_STRIPE) == 1) {

            $enable_stripe = true;
        }

        $enable_paystack = false;

        if (get_settings(Settings::ENABLE_PAYSTACK) == 1) {

            $enable_paystack = true;
        }

        $enable_flutter_wave = false;

        if (get_settings(Settings::ENABLE_FLUTTER_WAVE) == 1) {

            $enable_flutter_wave = true;
        }

        $enable_cashfree = false;

        if (get_settings(Settings::ENABLE_CASH_FREE) == 1) {

            $enable_cashfree = true;
        }

        $enable_razor_pay = false;

        if (get_settings(Settings::ENABLE_RAZOR_PAY) == 1) {

            $enable_razor_pay = true;
        }

        $enable_paymob = false;

        if (get_settings(Settings::ENABLE_PAYMOB) == 1) {

            $enable_paymob = true;
        }
        $enable_paypal = false;

        if (get_settings(Settings::ENABLE_PAYPAL) == 1) {

            $enable_paypal = true;
        }


        $enable_razor = false;

        if (get_settings(Settings::ENABLE_RAZOR_PAY) == 1) {

            $enable_razor = true;
        }



        return response()->json(['success' => true,
            'message' => 'active_payment_gateways',
            'braintree_tree' => $enable_brain_tree,
            'mercadopago' => $enable_mercadopago,
            'stripe' => $enable_stripe,
            'razor_pay' => $enable_razor_pay,
            'paystack' => $enable_paystack,
            'khalti_pay' => $enable_khalti,
            'cash_free' => $enable_cashfree,
            'flutter_wave' => $enable_flutter_wave,
            'paymob' => $enable_paymob,
            'paypal' => $enable_paypal,
            'razor' => $enable_razor,
        ]);

    }

    public function totalaccount(Request $request)
    {

        $totalvalues = RequestBillData::where('request_id', $request->id)->firstOrFail();
        return response()->json(['datavalue' => $totalvalues], 200);
    }









    public function invoicecms()
    {
        $data=FrontPage::first();
        $p=Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(),''));
        $main_menu = 'cms';
        $sub_menu = 'cms_footerpage';
        return view ('admin.cms.invoice_cms',compact('data','p','main_menu','sub_menu'));
    }

    public function invoicecmsadd(Request $request)
    {
        if (env('APP_FOR')=='demo') {
            $message = trans('succes_messages.you_are_not_authorised');

            return redirect()->back()->with('warning', $message);
           }


         $userId = 1;
         $logo=FrontPage::first();
         $invoice_logo=$logo->invoice_logo;
         if($request->hasFile('invoice_logo'))
          {
          $invoice_logo = $request->file('invoice_logo');
          $path1 = Storage::put($this->uploadPath(), $invoice_logo);
          $p1=explode('//',$path1);
          $invoice_logo=$p1[1];
          }

          $terms_and_conditions_link=$request->input('terms_and_conditions_link');
          $privacy_policy_link=$request->input('privacy_policy_link');
          $invoice_email=$request->input('invoice_email');

          $data=[
           'invoice_logo'=>$invoice_logo,
           'privacy_policy_link'=>$privacy_policy_link,
           'terms_and_conditions_link'=>$terms_and_conditions_link,
           'invoice_email'=>$invoice_email,
          ];

         FrontPage::where('userid', $userId)->update($data);
         $main_menu = 'cms';
         $sub_menu = 'cms_frontpage';
         $message="Datas Stored Successfully";
         return redirect()->back()->with("success",$message);

         //return redirect()->back()->with(compact('main_menu','sub_menu'));
    }


}
