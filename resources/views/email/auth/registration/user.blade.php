@extends('email.layout')

@section('content')
    <div class="content">
        <div class="content-header content-header--blue">
            Welcome to Future!
        </div>
        <div class="content-body">
            <p>Hi {{ $user->name }},</p>
            <p> @lang('view_pages.welcome_email').</p>

            <div class="text-center">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-default">
                    @lang('view_pages.login_to_your_account')
                </a>
            </div>

            <div class="hr-line"></div>

            <p>@lang('view_pages.commitment_text').</p>

            <ul>
                <li>@lang('view_pages.choice_of_genuine_and_verified_drivers')</li>
                <li>@lang('view_pages.schedule_rides')</li>
                <li>@lang('view_pages.no_hidden_charges')</li>
                <li>@lang('view_pages.secured_online_payment')</li>
                <li>@lang('view_pages.spend_extra_quality_time_with_your_family').</li>
            </ul>
        </div>
    </div>
@endsection
