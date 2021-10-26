
<!-- LOGO SECTION -->
<div class="app-header__logo">
    <div class="logo-src"></div>
    <div class="header__pane ml-auto">
        <div>
            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</div>
<!-- /LOGO SECTION -->
    
<!-- MOBILE MENU BUTTON -->
<div class="app-header__mobile-menu">
    <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
</div>
<!-- /MOBILE MENU BUTTON -->
    
<!-- PROFILE MENU BUTTON -->
<div class="app-header__menu">
    <span>
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
        </button>
    </span>
</div>
<!-- /PROFILE MENU BUTTON -->
    
    
    <!-- HEADER CONTENT -->
    <div class="app-header__content">

        <!-- SEARCH -->
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>
        </div>
        <!-- /SEARCH -->

        <!-- PROFILE SECTION -->
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">

                                <!-- AVATAR -->
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="{{ asset('assets/images/avatars/100.jpg') }}" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <!-- /AVATAR -->

                                <!-- /ACCOUNT DETAILS DROPDOWN  -->
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
{{--                                     
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <a href="/{{ Auth::user()->id }}/my_profile">
                                            Account Settings
                                        </a>
                                    </button>
                                     --}}
                                    <a class="dropdown-item" href="/{{ Auth::user()->id }}/profile">
                                        Account Profile
                                    </a>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                <!-- /ACCOUNT DETAILS DROPDOWN -->

                            </div>
                            <!-- /AVATAR AND USER ACCOUNT -->

                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">

                            <!-- USER NAMES -->
                            <div class="widget-heading widget-heading-app">
                                    {{ Auth::user()->name }}
                            </div>

                            <!-- USER ROLE -->
                            <div class="widget-subheading">
                                    {{ Auth::user()->roles_id ?? 'System Administrator' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        <!-- /PROFILE SECTION -->

    </div>
    <!-- /HEADER CONTENT -->
    