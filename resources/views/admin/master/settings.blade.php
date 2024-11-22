@extends('admin.layouts.app')


@section('title', 'Main page')

@section('content')

<style>
    @media (max-width:768px){
        .nav.nav-tabs{
            display: contents;
        }
        .nav-tabs .nav-link{
            border: none;
            border-radius: 0;
            background: #2a3042;
            color: white;
        }
        .nav-tabs .nav-item + .nav-item{
            margin-left:0;
        }
    }
</style>

<!-- Start Page content -->
<?php //$array = array("yes"=> 1,"no"=> 0);
//print_r(json_encode($array));die();
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">

                    <ul class="nav nav-tabs" style="padding: 1rem">

                        <?php $tab = 1; foreach ($settings as $setting_key => $setting_value) {?>
                        <li class="nav-item">
                            <a href="#{{$setting_key}}" data-toggle="tab" aria-expanded="false" class="nav-link <?php if ($tab==1) {
    echo "active";
}?>"> {{trans('view_pages.'.$setting_key)}}
                            </a>
                        </li>
                        <?php $tab++;} ?>

                    </ul>

                    <form action="{{url('system/settings')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="tab-content p-10">

                        <?php $tab = 1; 
                       
                        foreach ($settings as $setting_key => $setting_value) {?>

                        <div class="tab-pane show <?php if ($tab==1) {
    echo "active";
}?>" id="{{$setting_key}}">
                            <div class="row">

                                <?php $setting_value = $setting_value->groupBy('group_name');
                                // echo "<pre>";print_r($setting_value);die();
                                    foreach ($setting_value as $group_name => $group_value) { ?>

                                <?php if ($group_name != "" && $group_name != null) { ?>
                                <div class="col-md-12" >
                                    <h5>{{trans('view_pages.'.$group_name)}}</h5>

                                <?php }?>

                                    <?php $group_count=1;
                                          $group_total_count= count($group_value);
                                          foreach ($group_value as $setting_name) { ?>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">
                                            {{trans('view_pages.'.$setting_name['name'])}}
                                        </label>

                                        <?php
                      /*select box*/    if ($setting_name['field']=="select") { ?>
                                        <select name="<?=$setting_name['name'];?>" class="form-control" id="title">
                                            <?php
                                            foreach (json_decode($setting_name['option_value']) as $option_name => $option_value) {
                                                //print_r($item_value['option_value']);die();
                                                if ($setting_name['value'] == $option_value) {
                                                    $sel="selected";
                                                } else {
                                                    $sel="";
                                                } ?>
                                            <option style="text-align: left;" value="<?=$option_value; ?>" <?=$sel?> ><?php echo trans('view_pages.'.$option_name); ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                        <?php }
                      /*text box*/      elseif ($setting_name['field']=="text") { ?>
                                        <input name="<?=$setting_name['name'];?>" type="text" value='<?=$setting_name['value']?>' class="form-control" id="title">
                                        <?php }
                                          elseif ($setting_name['field']=="password") { ?>
                                       <input name="<?= $setting_name['name'] ?>" type="password" value="<?= env('APP_FOR') === 'demo' ? '**********' : $setting_name['value'] ?>" class="form-control" id="title">
                                        <?php }
                      /*image box*/     elseif ($setting_name['field']=="file") { ?>
                                        {{-- <div class="imageupload panel panel-default">
                                            <div class="file-tab panel-body"> --}}


                                                        <div class="form-group">
                                                            <div class="col-6 img_remove">
                                                                 <img id="blah" src="{{  $setting_name['name'] == 'logo' ? app_logo() : fav_icon() }}" alt="" style="max-width: 250px; max-height: 250px"  ><br> 
                                                                <?php if($setting_name['name'] == "firebasejson"){ ?>
                                                              <input type="file" id="{{ $setting_name['name'] }}" onchange="readURL(this)" name="{{ $setting_name['name'] }}" style="display:none" accept=".json" ><br> 
                                                              <button class="btn btn-primary btn-sm" type="button" onclick="$({{ $setting_name['name'] }}).click()" id="upload">@lang('view_pages.browse')</button> <span><a href="https://tagxi-docs.ondemandappz.com/user-manual/1.0/backend-setup#section-5" target="_blank" style="  text-decoration: underline;">How do i get the Firebase Json File?</a></span>
                                                                  <?php
                                                              }else{ ?>
                                                             
                                                                      <input type="file" id="{{ $setting_name['name'] }}" onchange="readURL(this)" name="{{ $setting_name['name'] }}" style="display:none"><br>
                                                                      <button class="btn btn-primary btn-sm" type="button" onclick="$({{ $setting_name['name'] }}).click()" id="upload">@lang('view_pages.browse')</button>
                                                                      <?php
                                                              } 
                                                                    ?>
                                                            
                                                               
                                                                
                                                                <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">@lang('view_pages.remove')</button><br>
                                                                <span class="text-danger">{{ $errors->first($setting_name['name']) }}</span>
                                                            </div>
                                                        </div>

                                            {{-- </div>
                                        </div> --}}
                                        <?php }
                      /*checkbox box*/  elseif ($setting_name['field']=="checkbox") { ?>

                                        <?php }
                      /*radio box */    elseif ($setting_name['field']=="radio") { ?>

                                        <?php }
                      /*text area  */   elseif ($setting_name['field']=="textarea") { ?>
                                        <textarea name="<?=$setting_name['name'];?>" class="form-control" id="title" maxlength="225" rows="3"><?=$setting_name['value']?></textarea>
                                        <?php } ?>

                                    </div>
                                </div>
                                <?php if ($group_name != "" && $group_name != null && $group_count == $group_total_count) {?>
                                    </div>
                                <?php }
                                 $group_count++; } ?>

                                <?php }?>
                                    <div class="col-md-12">
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-custom waves-effect waves-light" type="submit">
                                        {{trans('view_pages.save')}}
                                    </button>
                                </div>
                                </div>
                            </div>

                        </div>

                        <?php $tab++; } ?>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- container -->

</div>


@endsection
