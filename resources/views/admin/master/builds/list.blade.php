@extends('admin.layouts.app')

@section('title', 'Company page')

@section('content')
<!-- Page Title -->
                     <section class="content-header">
                      <h1>
                        {{$page}}
                      </h1>
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('builds/projects') }}"><i class="fa fa-dashboard"></i> {{$project_name}}</a></li>
                         <li class="breadcrumb-item"><a href="{{ url('builds/flavours',request()->project_id) }}"><i class="fa fa-dashboard"></i> {{$flavour_name}}</a></li>

                        <li class="breadcrumb-item"><a href="{{ url('builds/environments',['project_id'=>request()->project_id,'flavour_id'=>request()->flavour_id]) }}"><i class="fa fa-dashboard"></i> {{$environment}}</a></li>
                        <li class="breadcrumb-item active">{{$page}}</li>
                      </ol>
                    </section>
<!-- </div> -->
<!-- container -->

<!-- </div> -->
<!-- content -->
<section class="col-12" style="padding-top:25px;">
<div class="col-md-11 mx-auto apk-download-main-div mb-1 ">
    <ul class="top-search">
        <li>
        <div class="form-group mb-0">
            <input type="text" name="search" style="width:250px;" class="form-control" placeholder="Enter Build number">
            <button class="btn  btn-outline btn-sm" style="border-radius:0px;" type="submit">
            <img src="../../assets/img/search.svg" width="20px" alt="">
            </button>
        </div>
        </li>
        <li>
        <a href="{{url('builds?team=android',['project_id'=>request()->project_id,'flavour_id'=>request()->flavour_id,'environment'=>request()->environment])}}">
            <button class="btn btn-danger btn-outline btn-sm {{$android_active}}" type="button">
<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.12 512.12" style="enable-background:new 0 0 512.12 512.12;" xml:space="preserve">
<g>
	<path  d="M74.727,170.787c-17.673,0-32,14.327-32,32V352.12c0,17.673,14.327,32,32,32s32-14.327,32-32
		V202.787C106.727,185.114,92.4,170.787,74.727,170.787z"/>
	<path  d="M437.393,170.787c-17.673,0-32,14.327-32,32V352.12c0,17.673,14.327,32,32,32s32-14.327,32-32
		V202.787C469.393,185.114,455.067,170.787,437.393,170.787z"/>
	<path  d="M373.393,170.787H138.727c-5.891,0-10.667,4.776-10.667,10.667V352.12
		c-0.005,25.348,17.831,47.197,42.667,52.267v75.733c0,17.673,14.327,32,32,32s32-14.327,32-32v-74.667h42.667v74.667
		c0,17.673,14.327,32,32,32s32-14.327,32-32v-75.733c24.836-5.07,42.672-26.919,42.667-52.267V181.454
		C384.06,175.563,379.284,170.787,373.393,170.787z"/>
	<path  d="M333.607,44.323l26.005-25.984c4.237-4.093,4.354-10.845,0.262-15.083
		c-4.093-4.237-10.845-4.354-15.083-0.262c-0.089,0.086-0.176,0.173-0.262,0.262L314.236,33.55
		c-37.102-16.117-79.229-16.117-116.331,0L167.612,3.235c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82
		l25.984,26.005c-31.677,20.96-50.649,56.481-50.453,94.464c0,5.891,4.776,10.667,10.667,10.667h234.667
		c5.891,0,10.667-4.776,10.667-10.667C384.256,100.804,365.284,65.283,333.607,44.323z"/>
</g>
<g>
	<circle style="fill:#FAFAFA;" cx="202.727" cy="96.12" r="10.667"/>
	<circle style="fill:#FAFAFA;" cx="309.393" cy="96.12" r="10.667"/>
</g>

</svg>

            </button>
        </a>
        </li>
        <li>
        <a href="{{url('builds?team=ios',['project_id'=>request()->project_id,'flavour_id'=>request()->flavour_id,'environment'=>request()->environment])}}">
            <button class="btn btn-warning btn-outline btn-sm {{$ios_active}}" type="button">
          <svg id="Layer_1" enable-background="new 0 0 256 256"  viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path d="m227 252h-198c-13.807 0-25-11.193-25-25v-198c0-13.807 11.193-25 25-25h198c13.807 0 25 11.193 25 25v198c0 13.807-11.193 25-25 25z" fill="#526faa"/><path d="m227 4h-10c13.807 0 25 11.193 25 25v198c0 13.807-11.193 25-25 25h10c13.807 0 25-11.193 25-25v-198c0-13.807-11.193-25-25-25z" fill="#34518c"/><path d="m14 227v-198c0-13.807 11.193-25 25-25h-10c-13.807 0-25 11.193-25 25v198c0 13.807 11.193 25 25 25h10c-13.807 0-25-11.193-25-25z" fill="#708dc8"/><path d="m227 254h-198c-14.888 0-27-12.112-27-27v-198c0-14.888 12.112-27 27-27h198c14.888 0 27 12.112 27 27v198c0 14.888-12.112 27-27 27zm-198-248c-12.683 0-23 10.318-23 23v198c0 12.682 10.317 23 23 23h198c12.683 0 23-10.318 23-23v-198c0-12.682-10.317-23-23-23z" fill="#690589"/><path d="m14 74c-1.104 0-2-.896-2-2v-12c0-1.104.896-2 2-2s2 .896 2 2v12c0 1.104-.896 2-2 2z" fill="#690589"/><path d="m135.672 41.77c-9.054 9.054-12.012 21.87-8.937 33.412 11.543 3.075 24.359.118 33.413-8.936s12.012-21.87 8.936-33.413c-11.542-3.075-24.358-.118-33.412 8.937z" fill="#f4efed"/><path d="m202.842 166.911c-20.94 0-37.915-16.975-37.915-37.915 0-16.484 10.539-30.472 25.232-35.694-14.376-12.976-33.047-10.873-45.779-7.048-9.346 2.808-19.253 2.808-28.599 0-17.443-5.241-46.044-7.285-59.457 28.313-13.915 36.926 5.991 74.447 23.842 97.541 9.81 12.691 27.645 15.911 41.46 7.761l4.447-2.623c2.473-1.459 5.543-1.459 8.016 0l4.447 2.623c13.815 8.15 31.65 4.93 41.46-7.761 9.221-11.93 18.979-27.714 24.352-45.273-.504.02-.998.076-1.506.076z" fill="#f4efed"/><g fill="#690589"><path d="m135.644 78.347c-3.146 0-6.312-.403-9.423-1.232-.692-.185-1.233-.725-1.418-1.418-3.359-12.608.264-26.151 9.455-35.341 9.192-9.191 22.737-12.812 35.341-9.456.692.185 1.233.725 1.418 1.418 3.359 12.608-.264 26.151-9.454 35.342-6.924 6.923-16.318 10.687-25.919 10.687zm-7.257-4.816c10.903 2.488 22.437-.789 30.348-8.699 7.909-7.91 11.188-19.442 8.698-30.347-10.906-2.49-22.437.791-30.347 8.699-7.91 7.91-11.189 19.441-8.699 30.347z"/><path d="m154.887 226.339c-5.932 0-11.934-1.542-17.367-4.748l-4.447-2.624c-1.844-1.089-4.139-1.089-5.982 0l-4.447 2.624c-14.75 8.701-33.691 5.15-44.059-8.261-15.47-20.013-39.174-59.548-24.131-99.469 14.172-37.613 44.868-34.644 61.904-29.523 8.98 2.698 18.47 2.697 27.448 0 13.488-4.053 32.711-6.045 47.693 7.478.523.472.759 1.184.622 1.875-.138.691-.628 1.258-1.292 1.494-14.297 5.082-23.902 18.669-23.902 33.81 0 19.804 16.111 35.915 35.915 35.915.264 0 .521-.019.78-.037.215-.015.43-.029.646-.038.632-.025 1.267.264 1.663.777s.519 1.187.328 1.806c-5.85 19.122-16.65 35.521-24.682 45.912-6.547 8.472-16.516 13.009-26.69 13.009zm-57.849-141.102c-22.258 0-33.341 15.436-38.843 30.035-14.357 38.104 8.594 76.26 23.553 95.613 9.138 11.819 25.848 14.942 38.861 7.262l4.447-2.624c3.1-1.828 6.949-1.828 10.049 0l4.447 2.624c13.019 7.68 29.726 4.557 38.861-7.262 7.452-9.643 17.348-24.578 23.175-41.994-21.432-.664-38.662-18.305-38.662-39.896 0-15.678 9.263-29.856 23.375-36.289-13.217-9.959-29.599-8.067-41.346-4.538-9.729 2.923-20.018 2.924-29.749 0-6.76-2.03-12.79-2.931-18.168-2.931z"/></g></svg>
            </button>
        </a>
        </li>
    </ul>
</div>
    @if(count($results)<1)
 <p id="no_data" class="lead no-data text-center">
     <img src="../../../assets/img/dark-data.svg" style="width:250px;margin-top:25px;" alt="">
     <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
 </p>
    @else
    @foreach($results as $key => $result)
    <div class="col-md-11 mx-auto apk-download-main-div">
        <div class="apk-download col-12">
            <div class="col-6 col-md-6 float-left apk-download-left">
                <p><b class="apk-name"> {{$result->build_number}}</b> <span><b class="version-apk">Version:</b> v{{$result->version}}</span> <span><b class="version-apk">Platform:</b> {{$result->team}}</span></p>
                <p>{{$result->short_additional_comments}}</p>
            </div>
            <div class="col-6 col-md-6 float-left apk-download-right">
            <p><span><b class="version-apk mobile-div">Date:</b> {{$result->created_at}}</span> <span><b class="version-apk mobile-div">File Size:</b> {{$result->file_size}}</span></p>
               <a href="{{ $result->download_link}}">Download</a>
               <a data-toggle="modal" style="cursor:pointer;" data-target="#myModal{{$result->id}}" class="mr-0"><img src="../../../assets/img/eye.svg" width="20px" alt=""></a>
               @if(access()->hasRole('super-admin'))
               <a href="{{ url('builds/app/delete',$result->id) }}" class="mr-0 sweet-delete"><img src="../../assets/img/delete.svg" width="20px" alt=""></a>
               @endif
            </div>
        </div>
    </div>

    <!-- The Modal -->
  <div class="modal" id="myModal{{$result->id}}">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title apk-name">{{$result->build_number}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body apk-download">
          <p> <span class="model-apk">Version:</span> {{$result->version}}</p>
          <p> <span class="model-apk">Platform:</span> {{$result->version}}</p>
          <p><span class="model-apk">Uploaded By:</span> {{$result->uploaded_by}}</p>
          <p><span class="model-apk">Uploaded On:</span> {{$result->created_at}}</p>
          <p><span class="model-apk">File size: </span>{{$result->file_size}}</p>
         <span class="model-apk"> <a style="color:#3d94de" href="{{ $result->download_link}}">Download</a></span>
          <p><span class="model-apk">Description: </span></p>
          {{$result->additional_comments}}
        </div>

      </div>
    </div>
  </div>
    @endforeach
    @endif
<div class="text-right">
    <span  style="float:right">
    {{$results->links()}}
    </span>
    </div>
</section>





@endsection
