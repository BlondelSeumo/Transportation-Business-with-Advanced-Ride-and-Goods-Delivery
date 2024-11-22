<div class="card my-2">
    <div class="card-body  py-0 position-relative">
        <nav class="navbar navbar-light navbar-top navbar-expand-xl">
            <a class="navbar-brand me-1 me-sm-3" href="#">
                <div class="d-flex align-items-center"><img class="me-2"
                        src="{{ app_logo() ?? asset('assets/img/logo.png') }}" style="width: 26px;padding-right: 5px;" alt="" />
                        <span>
                            {{ app_name() ?? 'Tagxi' }}
                        </span>
                        
                    </div>
            </a>

            @if (request()->route()->getName() != 'dispatcherProfile')
                <button type="button" class="btn btn-primary btn-sm turned-button mx-4 booking_screen" data-bs-toggle="modal" data-id="book-later">
                   @lang('view_pages.book_later')
                </button>

                <button type="button" class="btn btn-primary btn-sm turned-button mr-auto booking_screen" data-id="book-now"
                    data-bs-toggle="modal">
                   @lang('view_pages.book_now')
                </button>

                {{-- <a href="{{url('dispatch/book-now')}}" class="btn btn-primary btn-sm">@lang('view_pages.book_now')</a> --}}
            
            <ul class="navbar-nav navbar-nav-icons flex-row align-items-center" style="margin-left: auto;">
                <li class="nav-item dropdown"><a class="nav-link pe-0" id="navbarDropdownUser" href="#"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-xl">
                            <img class="rounded-circle" src="{{ auth()->user()->profile_picture ?? asset('dispatcher/assets/img/team/3-thumb.png') }}" alt="" />
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                        <div class="bg-white dark__bg-1000 rounded-2 py-2">
                            <span class="dropdown-item fw-bold text-warning"><span
                                    class="fas fa-crown me-1"></span><span>{{ ucfirst(auth()->user()->name) }}</span></span>
                            <div class="dropdown-divider"></div>
    
                            {{-- <a class="dropdown-item" href="{{ url('dispatch/profile') }}">@lang('view_pages.profile')</a> --}}
                            
                            <a class="dropdown-item" href="{{ url('api/spa/logout') }}">@lang('view_pages.logout')</a>
                        </div>
                    </div>
                </li>
            </ul>
            @else
                <div class="pull-right" style="float: right">
                    <a href="{{ url('dispatch/dashboard') }}"  class="btn btn-danger btn-sm turned-button mr-auto">
                        @lang('view_pages.back')
                    </a>
                </div>
            @endif
        </nav>
    </div>
</div>