
@php

$app_for = config('app.app_for');

if(str_contains((string)request()->path(),'translations')){
  $main_menu = 'settings';
  $sub_menu = 'translations';
}
@endphp
<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">
      @if(auth()->user()->can('access-dashboard'))
      <li class="{{'dashboard' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/dashboard')}}">
          <i class="fa fa-tachometer"></i> <span>@lang('pages_names.dashboard')</span>
        </a>
      </li>
      @endif

       @if(auth()->user()->can('view-settings'))
      <li class="treeview {{ 'settings' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-cogs"></i>
          <span> @lang('pages_names.settings') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @if(auth()->user()->can('view-roles'))
          <li class="{{ 'roles' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/roles')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.roles')</a>
          </li>
          @endif
          @if(auth()->user()->can('view-system-settings'))
          <li class="{{ 'system_settings' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/system/settings')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.system_settings')</a>
          </li>
          @endif
          @if(auth()->user()->can('map-settings'))
          <li class="{{ 'translations' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/system/settings/map')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.map_settings')</a>
          </li>
          @endif
          @if(auth()->user()->can('sms-settings'))
          <li class="{{ 'translations' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/system/settings/sms_gateway')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.sms_settings')</a>
          </li>
          @endif
          @if(auth()->user()->can('view-translations'))
          <li class="{{ 'translations' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/translations')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.translations')</a>
          </li>
          @endif

          @if(auth()->user()->can('onboarding-screen'))
          <li class="{{ 'onboarding' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/system/settings/onboarding')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.onboarding_screen')</a>
          </li>
          @endif  
          @if(auth()->user()->can('invoicecms'))
          <li class="{{ 'cms_invoice' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/invoicecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.invoice_cms')</a>
          </li>
          @endif
          @if(auth()->user()->can('manage-country'))
          <li class="{{ 'country' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/country')}}"><i class="fa fa-circle-thin"></i>@lang('view_pages.country')</a>
          </li>
          @endif

<!--     @if(auth()->user()->can('view-email-templates'))
          <li class="{{ 'mail_templates' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/mail_templates')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.mail_templates')</a>
          </li>
          @endif   -->
        </ul>
      </li>
      @endif

     @if(auth()->user()->can('master-data'))
      <li class="treeview {{ 'master' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-code-fork"></i>
          <span> @lang('pages_names.master') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

          <ul class="treeview-menu">
          @if(auth()->user()->can('manage-driver-needed-document'))
          <li class="{{ 'needed_document' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/needed_doc')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.needed_doc')</a>
          </li>
          @endif
          @if(auth()->user()->can('manage-owner-needed-document'))
          <li class="{{ 'owner_needed_document' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/owner_needed_doc')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.owner_needed_doc')</a>
          </li>
          @endif
          @if(auth()->user()->can('manage-fleet-needed-document'))
          <li class="{{ 'fleet_needed_document' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/fleet_needed_doc')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.fleet_needed_doc')</a>
          </li>
          @endif
          @if(auth()->user()->can('manage-goods-types')  && ($app_for !== 'taxi'))
                <li class="{{ 'goods_type' == $sub_menu ? 'active' : '' }}">
                    <a href="{{url('/goods-types')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.goods_types')</a>
                </li>
          @endif
          @if(auth()->user()->can('package-type'))
          <li class="{{ 'package_type' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/package_type')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.package_type')</a>
          </li>
          @endif
          @if(auth()->user()->can('banner-image'))
          <li class="{{ 'banner_image' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/banner_image')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.banner_image')</a>
          </li>
          @endif

        </ul>
      </li>
      @endif

      @if(auth()->user()->can('service_location'))
      <li class="{{'service_location' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/service_location')}}">
          <i class="fa fa-map-marker"></i> <span>@lang('pages_names.service_location')</span>
        </a>
      </li>
      @endif

      @php
        $areas = App\Models\Admin\ServiceLocation::companyKey()->active(true)->get();
      @endphp

        @if(auth()->user()->can('manage-owner'))
        <li class="treeview {{ 'manage_owners' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-code-fork"></i>
          <span> @lang('pages_names.owners') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
         <ul class="treeview-menu">
         @foreach ($areas as $item)
          <li class="{{ $sub_menu == $item->name ? 'active' : '' }}" data-id="{{ $item->id }}">
            <a href="{{url('/owners/by_area',$item->id)}}"><i class="fa fa-circle-thin"></i>{{ ucfirst($item->name) }}</a>
          </li>
           @endforeach
         </ul>

            </li>

            @endif


             @if(auth()->user()->can('manage-fleet'))
            <li class="{{ $main_menu == 'manage_fleet' ? 'active' : ''}}">
                <a href="{{ route('viewFleet') }}">
                    <i class="fa fa-bus"></i>
                    <span> {{ trans('pages_names.manage_fleet') }} </span>
                </a>
            </li>
            @endif

      @if(auth()->user()->can('admin'))
      <li class="{{'admin' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/admins')}}">
          <i class="fa fa-user-circle-o"></i> <span>@lang('pages_names.admins')</span>
        </a>
      </li>
      @endif
         @if(auth()->user()->can('view-requests') && ($app_for !== 'delivery'))
        <li class="treeview {{ 'trip-request' == $main_menu ? 'active menu-open' : '' }}">
          <a href="javascript: void(0);">
            <i class="fa fa-map"></i>
            <span> @lang('pages_names.request') </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
         @if(auth()->user()->can('view-rides'))

            <li class="{{'request' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/requests')}}">
                <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.rides')</span>
              </a>
            </li>
          @endif
         @if(auth()->user()->can('scheduled-rides'))
            <li class="{{'scheduled-rides' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/scheduled-rides')}}">
                <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.scheduled_rides')</span>
              </a>
            </li>
          @endif
          @if(auth()->user()->can('out-station-rides'))
          <li class="{{'out-station-rides' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/out-station-rides')}}">
              <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.out_station_rides')</span>
            </a>
          </li>
        @endif


         @if(auth()->user()->can('cancellation-rides'))
            <li class="{{'cancellation-rides' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/cancellation-rides')}}">
                <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.cancellation_rides')</span>
              </a>
            </li>
          @endif

          </ul>
        </li>
         @endif

         @if(auth()->user()->can('view-delivery-requests') && ($app_for !== 'taxi'))
        <li class="treeview {{ 'delivery-trip-request' == $main_menu ? 'active menu-open' : '' }}">
          <a href="javascript: void(0);">
            <i class="fa fa-map"></i>
            <span> @lang('pages_names.delivery_request') </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
         @if(auth()->user()->can('view-delivery-rides'))

            <li class="{{'delivery-request' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/delivery-requests')}}">
                <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.rides')</span>
              </a>
            </li>
          @endif
         @if(auth()->user()->can('scheduled-delivery-rides'))
            <li class="{{'scheduled-rides' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/scheduled-delivery-rides')}}">
                <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.scheduled_rides')</span>
              </a>
            </li>
          @endif

         @if(auth()->user()->can('cancellation-delivery-rides'))
            <li class="{{'cancellation-rides' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/cancellation-delivery-rides')}}">
                <i class="fa fa-circle-thin"></i> <span>@lang('pages_names.cancellation_rides')</span>
              </a>
            </li>
          @endif

          </ul>
        </li>
         @endif

      @if(auth()->user()->can('view-types'))
      <li class="{{'types' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/types')}}">
          <i class="fa fa-taxi "></i> <span>@lang('pages_names.types')</span>
        </a>
      </li>
      @endif

        @if(auth()->user()->can('map-menu'))
        <li class="treeview {{ 'map' == $main_menu ? 'active menu-open' : '' }}">
          <a href="javascript: void(0);">
            <i class="fa fa-map"></i>
            <span> @lang('pages_names.map') </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(auth()->user()->can('view-zone'))
            <li class="{{ 'zone' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/zone')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.zone')</a>
            </li>
            @endif
            @if(auth()->user()->can('list-airports'))
            <li class="{{ 'airport' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/airport')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.airport')</a>
            </li>
            @endif

          </ul>
        </li>
      @endif
      @php
        $zones = App\Models\Admin\Zone::companyKey()->active(true)->get();
      @endphp

        @if(auth()->user()->can('vehicle-fare'))
     <li class="treeview {{ 'vehicle-fare' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-money"></i>
          <span> @lang('pages_names.set_price') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
         <ul class="treeview-menu">
         @foreach ($zones as $item)
          <li class="{{ $sub_menu == $item->name ? 'active' : '' }}" data-id="{{ $item->id }}">
            <a href="{{url('/vehicle_fare/by_zone',$item->id)}}"><i class="fa fa-circle-thin"></i>{{ ucfirst($item->name) }}</a>
          </li>
           @endforeach
         </ul>
       </li>
      @endif
     @if(auth()->user()->can('drivers-menu'))
              @if (auth()->user()->hasRole('owner'))
                  @php
                      $route = 'company/drivers';
                  @endphp
              @else
                  @php
                      $route = 'drivers';
                  @endphp
      @endif


        <li class="treeview {{ 'drivers' == $main_menu ? 'active menu-open' : '' }}">
          <a href="javascript: void(0);">
            <i class="fa fa-users"></i>
            <span> @lang('pages_names.drivers') </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
           @if (auth()->user()->hasRole('owner'))
              @if(auth()->user()->can('view-drivers'))
              <li class="{{ 'driver_details' == $sub_menu ? 'active' : '' }}">
                <a href="{{url($route)}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.drivers')</a>
              </li>
              @endif

           @else

           @if(auth()->user()->can('view-drivers'))
            <li class="{{ 'driver_details' == $sub_menu ? 'active' : '' }}">
              <a href="{{url($route)}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.approved_drivers')</a>
            </li>
            @endif

            @endif

            @if(auth()->user()->can('view-approval-pending-drivers'))
            <li class="{{ 'driver_approval_pending' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/drivers/waiting-for-approval')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.pending_approvals')</a>
            </li>
            @endif
            @if(auth()->user()->can('drivers'))
            <li class="{{ 'deleted_drivers' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/drivers/deleted_drivers')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.deleted_drivers')</a>
            </li>
            @endif
            @if(auth()->user()->can('view-driver-ratings'))
            <li class="{{ 'driver_ratings' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/driver-ratings')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.driver_ratings')</a>
            </li>
            @endif
            @if(auth()->user()->can('view-driver-withdrawal-requests'))
            <li class="{{ 'withdrawal_requests' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/withdrawal-requests-lists')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.withdrawal_requests')</a>
            </li>
            @endif
            @if(auth()->user()->can('view-negative-balance-drivers'))
            <li class="{{ 'negative_balance_drivers' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('withdrawal-requests-lists/negative_balance_drivers')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.negative_balance_drivers')</a>
            </li>
            @endif
          </ul>

        </li>
        @endif
       @if(auth()->user()->can('fleet-drivers-menu'))
              @if (auth()->user()->hasRole('owner'))
                  @php
                      $route = 'company/drivers';
                  @endphp
              @else
                  @php
                      $route = 'fleet-drivers';
                  @endphp
              @endif


        <li class="treeview {{ 'fleet-drivers' == $main_menu ? 'active menu-open' : '' }}">
          <a href="javascript: void(0);">
            <i class="fa fa-users"></i>
            <span> @lang('pages_names.fleet_drivers') </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            @if(auth()->user()->can('view-approved-fleet-drivers'))
            <li class="{{ 'driver_details' == $sub_menu ? 'active' : '' }}">
              <a href="{{url($route)}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.approved_fleet_drivers')</a>
            </li>
            @endif

            @if(auth()->user()->can('fleet-drivers-waiting-for-approval'))
            <li class="{{ 'driver_approval_pending' == $sub_menu ? 'active' : '' }}">
              <a href="{{url('/fleet-drivers/waiting-for-approval')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.pending_approvals')</a>
            </li>
            @endif
          </ul>

        </li>
      @endif
      @if(auth()->user()->can('user-menu'))
      <li class="treeview {{ 'users' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-user"></i>
          <span> @lang('pages_names.users') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @if(auth()->user()->can('view-users'))
          <li class="{{ 'user_details' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/users')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.user_details')</a>
          </li>
          @endif
          @if(auth()->user()->can('view-delete-users'))
          <li class="{{ 'user_details' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/users/deleted')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.deleted_users')</a>
          </li>
          @endif
        </ul>
      </li>
      @endif

      @if(auth()->user()->can('view-sos'))
      <li class="{{'emergency_number' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/sos')}}">
          <i class="fa fa-heartbeat"></i> <span>@lang('pages_names.emergency_number')</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('chat'))
      <li class="{{'chat_module' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/chat')}}">
          <i class="fa fa-question-circle"></i> <span>@lang('pages_names.live_chat')</span>
        </a>
      </li>
        @endif

      @if(auth()->user()->can('manage-promo'))
      <li class="{{'manage-promo' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/promo')}}">
          <i class="fa fa-gift"></i> <span>@lang('pages_names.promo_codes')</span>
        </a>
      </li>
      @endif

      @if(auth()->user()->can('notifications'))
      <li class="treeview {{ 'notifications' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-paper-plane"></i>
          <span> @lang('pages_names.notifications') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @if(auth()->user()->can('view-notifications'))
          <li class="{{ 'push_notification' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/notifications/push')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.push_notification')</a>
          </li>
          @endif
        </ul>
      </li>
      @endif

      @if(auth()->user()->can('cancellation-reason'))
      <li class="{{'cancellation-reason' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/cancellation')}}">
          <i class="fa fa-ban"></i> <span>@lang('pages_names.cancellation')</span>
        </a>
      </li>
      @endif

      @if(auth()->user()->can('complaints'))
      <li class="treeview {{ 'complaints' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-list-alt"></i>
          <span> @lang('pages_names.complaints') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @if(auth()->user()->can('complaint-title'))
          <li class="{{ 'complaint-title' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/title')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.complaint_title')</a>
          </li>
          @endif

          @if(auth()->user()->can('user-complaint'))
          <li class="treeview {{ 'user-complaint' == $sub_menu ? 'active' : '' }}">
             <a href="javascript: void(0);">
                <i class="fa fa-circle-thin"></i>
                <span> @lang('pages_names.user_complaints') </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
             <ul class="treeview-menu">
               <li class="{{ 'user-general-complaint' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/users/general')}}">@lang('pages_names.general_complaints')</a></li>

               <li class="{{ 'user-request-complaint' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/users/request')}}">@lang('pages_names.request_complaints')</a></li>
             </ul>
          </li>
          @endif

          @if(auth()->user()->can('driver-complaint'))
          <li class="treeview {{ 'driver-complaint' == $sub_menu ? 'active' : '' }}">
             <a href="javascript: void(0);">
                <i class="fa fa-circle-thin"></i>
                <span> @lang('pages_names.driver_complaints') </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>

            <ul class="treeview-menu">
               <li class="{{ 'driver-general-complaint' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/drivers/general')}}">@lang('pages_names.general_complaints')</a></li>

               <li class="{{ 'driver-request-complaint' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/drivers/request')}}">@lang('pages_names.request_complaints')</a></li>
             </ul>
          </li>
          @endif

          @if(auth()->user()->can('owner-complaint'))
          <li class="treeview {{ 'owner-complaint' == $sub_menu ? 'active' : '' }}">
             <a href="javascript: void(0);">
                <i class="fa fa-circle-thin"></i>
                <span> @lang('pages_names.owner_complaints') </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
             <ul class="treeview-menu">
               <li class="{{ 'owner-general-complaint' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/owner/general')}}">@lang('pages_names.general_complaints')</a></li>

               <li class="{{ 'owner-request-complaint' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/complaint/owner/request')}}">@lang('pages_names.request_complaints')</a></li>
             </ul>
          </li>
          @endif


        </ul>
      </li>
      @endif


      @if(auth()->user()->can('reports'))
      <li class="treeview {{ 'reports' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-file-pdf-o"></i>
          <span> @lang('pages_names.reports') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @if(auth()->user()->can('user-report'))
          <li class="{{ 'user_report' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/reports/user')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.user_report')</a>
          </li>
          @endif

          @if(auth()->user()->can('driver-report'))
          <li class="{{ 'driver_report' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/reports/driver')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.driver_report')</a>
          </li>
          @endif
          @if(auth()->user()->can('driver-duties-report'))
         <!--  <li class="{{ 'driver_duties_report' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/reports/driver-duties')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.driver_duties_report')</a>
          </li> -->
          @endif

          @if(auth()->user()->can('owner-report'))
          <li class="{{ 'owner_report' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/reports/owner')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.owner_report')</a>
          </li>
          @endif

          @if(auth()->user()->can('finance-report'))
          <li class="{{ 'finance_report' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/reports/travel')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.finance_report')</a>
          </li>
          @endif
        </ul>
      </li>
      @endif

      @if(auth()->user()->can('manage-map'))
      <li class="treeview {{ 'manage-map' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-globe"></i>
          <span> @lang('pages_names.manage-map') </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @if(auth()->user()->can('heat-map'))
          <li class="{{ 'heat_map' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('map/heatmap')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.heat_map')</a>
          </li>
          @endif

          @if(auth()->user()->can('map-view'))
          <li class="{{ 'map' == $sub_menu ? 'active' : '' }}">
            <a href="{{route('mapView')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.map_view')</a>
          </li>

         {{--  <li class="{{ 'map-mapbox' == $sub_menu ? 'active' : '' }}">
            <a href="{{route('mapViewMapbox')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.map_view_mapbox')</a>
          </li> --}}
          @endif
        </ul>
      </li>
      @endif

      @if(auth()->user()->can('manage-faq'))
      <li class="{{'faq' == $main_menu ? 'active' : '' }}">
        <a href="{{url('/faq')}}">
          <i class="fa fa-question-circle"></i> <span>@lang('pages_names.faq')</span>
        </a>
      </li>
      @endif

      {{--  --}}
      {{-- @if(auth()->user()->can(''))
      <li class="{{ 'invoice2' == $main_menu ? 'active' : '' }}">
          <a href="{{ route('invoice2') }}">
              <i class="fa fa-file-invoice"></i>
              <span>Invoice</span>
          </a>
      </li>
  @endif --}}


      @if(auth()->user()->can('cms'))
      <li class="treeview {{ 'cms' == $main_menu ? 'active menu-open' : '' }}">
        <a href="javascript: void(0);">
          <i class="fa fa-file-pdf-o"></i>
          <span> CMS </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            {{-- <li class="{{ 'cms_webbooking' == $sub_menu ? 'active' : '' }}">
                <a href="{{url('/cms/webbookingcms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.web_booking_cms')</a>
              </li> --}}
          <li class="{{ 'cms_frontpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/frontpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.home_page_cms')</a>
          </li>
          <li class="{{ 'cms_safetypage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/safetypagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.safety_page_cms')</a>
          </li>
          <li class="{{ 'cms_servicepage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/servicepage')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.services_page_cms')</a>
          </li>
          <li class="{{ 'cms_privacypage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/privacypagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.privacy_page_cms')</a>
          </li>
          <li class="{{ 'cms_dmvpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/dmvpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.dmv_page_cms')</a>
          </li>
          <li class="{{ 'cms_complaincepage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/complaincepagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.complaince_page_cms')</a>
          </li>
          <li class="{{ 'cms_termspage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/termspagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.terms_page_cms')</a>
          </li>
          <li class="{{ 'cms_drreqpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/drreqpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.driver_req_page_cms')</a>
          </li>
          <li class="{{ 'cms_applydriverpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/applydriverpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.apply_to_drive')</a>
          </li>
          <li class="{{ 'cms_howdriverpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/howdriverpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.how_it_works_page_cms')</a>
          </li>
          <li class="{{ 'cms_contactpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/contactpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.contact_us_page_cms')</a>
          </li>
          <li class="{{ 'cms_playstorepage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/playstorepagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.playstore_link_page_cms')</a>
          </li>
          <li class="{{ 'cms_footerpage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/footerpagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.footer_page_cms')</a>
          </li>
          <li class="{{ 'cms_colorthemepage' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/colorthemepagecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.color_theme_page_cms')</a>
          </li>
          <li class="{{ 'cms_invoice' == $sub_menu ? 'active' : '' }}">
            <a href="{{url('/cms/invoicecms')}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.invoice_cms')</a>
          </li>

        </ul>
      </li>
      @endif
     </ul>
  </section>
</aside>
