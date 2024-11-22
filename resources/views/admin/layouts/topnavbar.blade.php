 <!-- Toastr css -->


 <!-- Top Bar Start -->

 <style>
    :root{
    --top_nav: {{ $navs -> value }};
    --side_menu: {{ $side -> value }};
    --side_menu_txt: {{ $side_txt -> value }};
}
.skin-blue .main-header .navbar {
    background-color:var(--top_nav);
}
.skin-blue .main-header .logo {
    background-color: var(--top_nav);
    color: #ffffff;
    border-bottom: 0 solid transparent;
}

.skin-blue-light .sidebar a {
    color: var(--side_menu_txt);
}

.skin-blue-light .sidebar a:hover {
    text-decoration: none;
}

.skin-blue-light .sidebar-menu .treeview-menu>li>a {
    color: var(--side_menu_txt);
}

.skin-blue .main-header .logo:hover {
    background-color: var(--top_nav);
}
.skin-blue .sidebar {
    border-color: var(--top_nav);
}
.skin-blue .sidebar-menu>li:hover>a {
    color: var(--top_nav);
    background-color: transparent;
}
.skin-blue .sidebar-menu>li.active>a,
.skin-blue .sidebar-menu>li.menu-open>a {
    color: #ffffff;
    background: var(--top_nav);
}
.skin-blue .sidebar-menu>li.active>a {
    border-left-color: var(--top_nav);
}
.skin-blue.layout-top-nav .main-header>.logo {
    background-color: var(--top_nav);
    color: #ffffff;
    border-bottom: 0 solid transparent;
}

.skin-blue.layout-top-nav .main-header>.logo:hover {
    background-color: var(--top_nav);
}

.skin-blue .btn-blue {
    background-color: var(--top_nav);
    color: #fff;
    border: 1px solid var(--top_nav);
}

.skin-blue .btn-blue:hover {
    background-color: #fff;
    color: var(--top_nav);
    color: var(--top_nav);
    color: var(--top_nav);
}

.horizontal-menu .skin-blue.layout-top-nav .sidebar-menu>li.active>a {
    background: var(--top_nav);
    color: #fff;
}

.skin-blue .main-header .messages-menu .dropdown-toggle i::after,
.skin-blue .main-header .notifications-menu .dropdown-toggle i::after,
.skin-blue .main-header .tasks-menu .dropdown-toggle i::after {
    border-color: var(--top_nav);
}


/*---Skin: Blue light---*/


/*---light sidebar---*/

.skin-blue-light .main-header .navbar {
    background-color: var(--top_nav);
}
@media (max-width: 767px) {
    .skin-blue-light .main-header .navbar .dropdown-menu li.divider {
        background-color: rgba(255, 255, 255, 0.1);
    }
    .skin-blue-light .main-header .navbar .dropdown-menu li a:hover {
        background: var(--top_nav);
    }
}
.skin-blue-light .sidebar {
    border-color: var(--top_nav);
}
.skin-blue-light .sidebar-menu>li.active>a {
    border-left-color: var(--top_nav);
}
.skin-blue-light.layout-top-nav .main-header>.logo {
    background-color:var(--top_nav);
    color: #ffffff;
    border-bottom: 0 solid transparent;
}

.skin-blue-light.layout-top-nav .main-header>.logo:hover {
    background-color:var(--top_nav);
}

.skin-blue-light .btn-blue {
    background-color:var(--top_nav);
    color: #fff;
    border: 1px solidvar(--top_nav);
}

.skin-blue-light .btn-blue:hover {
    background-color: #fff;
    color:var(--top_nav);
    color:var(--top_nav);
    color:var(--top_nav);
}

.horizontal-menu .skin-blue-light.layout-top-nav .sidebar-menu>li.active>a {
    background:var(--top_nav);
    color: #fff;
}

.skin-blue-light .main-header .messages-menu .dropdown-toggle i::after,
.skin-blue-light .main-header .notifications-menu .dropdown-toggle i::after,
.skin-blue-light .main-header .tasks-menu .dropdown-toggle i::after {
    border-color:var(--top_nav);
}
h1{
  text-align:center;
  color:#FFF !important;
  /* margin-top:20%; */
  font:35px Lobster;
  text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);
}
</style>


 <header class="main-header">
     <!-- Logo -->
     <a href="#" class="logo" style="height:105px;">
         <!-- mini logo -->
         <b class="logo-mini" style="margin-top:20px;">
             <span class="light-logo" style="display: flex;align-items: end;"><img
                     src="{{ app_logo() ?? asset('assets/img/logo.png') }}" style="width: 70px;padding-right: 5px;"
                     alt="logo"></span>
                     <!-- <h1>{{ app_name() ?? 'Tagxi' }}</h1> -->
                     <!-- <h1>{{ app_name() ?? 'Tagxi' }}</h1> -->
     {{--        <span class="dark-logo" style="display: flex;align-items: end;"><img
                     src="{{ app_logo() ?? asset('assets/img/logo.png') }}" style="width: 26px;padding-right: 5px;"
                     alt="logo">{{ app_name() ?? 'Tagxi' }}</span>   --}}
         </b>
         <!-- logo-->
         <!--  <span class="logo-lg">
             <img src="{{ app_logo() ?? asset('assets/images/logo-light-text.png') }}" alt="logo" class="light-logo">
             <img src="{{ app_logo() ?? asset('assets/images/logo-dark-text.png') }}" alt="logo" class="dark-logo">
         </span> -->
     </a>
     <!-- Header Navbar -->
     <nav class="navbar navbar-static-top">
         <!-- Sidebar toggle button-->

         <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
             <span class="sr-only">@lang('view_pages.toggle_navigation')</span>
         </a>

         <div class="navbar-custom-menu">
             <ul class="nav navbar-nav">
                {{-- <li class="dropdown notifications-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="sosicon"> @lang('view_pages.sos_request')</span>

                    </a>
                    <ul class="dropdown-menu scale-up sosList">

                    </ul>
                </li> --}}
                 <li class="dropdown notifications-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                         <i class="mdi mdi-google-translate"></i>
                     </a>
                     <ul class="dropdown-menu scale-up">
                        @php
                             $translations = \DB::table('ltm_translations')->groupBy('locale')->get();
                        @endphp



                         @foreach ($translations as $k => $translation)
                             <a class="{{ $translation->locale == session()->get('applocale') ? 'hover-blue' : '' }} dropdown-item chooseLanguage"
                                 href="#" data-value="{{ $translation->locale  }}">
                                 <li class="header">
                                     {{ ucfirst($translation->locale ) }}
                                 </li>
                             </a>
                         @endforeach

                   <!--       @foreach (config('app.app_lang') as $k => $v)
                             <a class="{{ $k == session()->get('applocale') ? 'hover-blue' : '' }} dropdown-item chooseLanguage"
                                 href="#" data-value="{{ $k }}">
                                 <li class="header">
                                     {{ ucfirst($v) }}
                                 </li>
                             </a>
                         @endforeach -->
                     </ul>
                 </li>
                 <!-- User Account-->
                 <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                         <img src="{{ auth()->user()->profile_picture ?: asset('/assets/img/user-dummy.svg') }}"
                             class="user-image rounded-circle" alt="User Image">
                     </a>
                     <ul class="dropdown-menu scale-up">
                         <!-- User image -->
                         <li class="user-header d-flex">
                             <img src="{{ auth()->user()->profile_picture ?: asset('/assets/img/user-dummy.svg') }}"
                                 class="float-left rounded-circle" alt="User Image">

                             <p class="pt-1 pl-2">
                                 <span>{{ auth()->user()->name }}</span>
                                 <small class="mb-5">{{ auth()->user()->email }}</small>

                             </p>

                         </li>
                         <!-- Menu Body -->
                         <li class="user-body">
                             <div class="row no-gutters">
                                 <div class="col-12 text-left">
                                     <a href="{{ url('admins/profile', auth()->user()->id) }}"><i
                                             class="ion ion-person"></i> @lang('pages_names.my_profile')</a>
                                 </div>
                                 <div role="separator" class="divider col-12"></div>
                                 <div class="col-12 text-left">
                                     <a href="{{ url('api/spa/logout') }}" class="logout"><i
                                             class="fa fa-power-off"></i> @lang('pages_names.logout')</a>
                                 </div>
                             </div>
                             <!-- /.row -->
                         </li>
                     </ul>
                 </li>

             </ul>
         </div>
     </nav>
 </header>
 <!-- Top Bar End -->
 <!-- Control Sidebar -->

 <!-- /.control-sidebar -->

 <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
 <!-- <div class="control-sidebar-bg"></div> -->
