@extends('admin.layouts.app')

@section('content')
<style>
    .profile-user-wid {
        width: 15%;
    }
</style>
<div class="row p-0 m-0">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">@lang('view_pages.driver_profile')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('company/drivers') }}">@lang('view_pages.manage_driver')</a>
                    </li>
                    <li class="breadcrumb-item active">@lang('view_pages.driver_profile')</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-12">
        <div class="col-md-12 float-left">
            <div class="card">
                <div class="row p-3">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ $item->user->profile_picture ?? url('taxi/assets/img/profile.svg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ $item->name }}</h5>
                        {{-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">
                        
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ $item->requestDetail()->whereIsCompleted(true)->count() }}</h5>
                                    <p class="text-muted mb-0">{{ trans('view_pages.completed_trip') }}</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ $item->requestDetail()->whereIsCancelled(true)->count() }}</h5>
                                    <p class="text-muted mb-0">{{ trans('view_pages.cancelled_trip') }}</p>
                                </div>
                            </div>
                            {{-- <div class="mt-4">
                                <a href="#" class="btn btn-primary waves-effect waves-light btn-sm">@lang('view_pages.view_profile') <i class="mdi mdi-arrow-right ml-1"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row p-0 m-0">
    <div class="col-12">
        <div class="col-md-12 float-left">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('view_pages.personal_info')</h4>

                    {{-- <p class="text-muted mb-4">Hi I'm Cynthia Price,has been the industry's standard dummy text To an English person, it will seem like simplified English, as a skeptical Cambridge.</p> --}}
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                               
                                <tr>
                                    <th scope="row">@lang('view_pages.owner_name') :</th>
                                    <td>{{ $item->owner ? $item->owner->name : '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.name') :</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.surname') :</th>
                                    <td>{{ $item->surname ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.username') :</th>
                                    <td>{{ $item->user->username }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.mobile') :</th>
                                    <td>{{ $item->mobile }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.email') :</th>
                                    <td>{{ $item->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.address') :</th>
                                    <td>{{ $item->address ?? '-' }}</td>
                                </tr>
                               
                                <tr>
                                    <th scope="row">@lang('view_pages.state') :</th>
                                    <td>{{ $item->state ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">@lang('view_pages.postal_code') :</th>
                                    <td>{{ $item->postal_code ?? '-' }}</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection