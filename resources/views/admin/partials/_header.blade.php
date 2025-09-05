<header class="header bg-body">
    <nav class="navbar flex-nowrap p-0">
        <div class="navbar-brand-wrapper d-flex align-items-center col-auto">
            <!-- Logo For Mobile View -->
            <a class="navbar-brand navbar-brand-mobile" href="/dashboard">
                <img class="img-fluid w-100" src="{{ asset('admin/img/logo-mini.png') }}" alt="Graindashboard">
            </a>
            <!-- End Logo For Mobile View -->

            <!-- Logo For Desktop View -->
            <a class="navbar-brand navbar-brand-desktop" href="/">
                <img class="side-nav-show-on-closed" src="{{ asset('admin/img/logo-mini.png') }}" alt="Graindashboard" style="width: auto; height: 33px;">
                <img class="side-nav-hide-on-closed" src="{{ asset('admin/img/logo.png') }}" alt="Graindashboard" style="width: auto; height: 33px;">
            </a>
            <!-- End Logo For Desktop View -->
        </div>

        <div class="header-content col px-md-3">
            <div class="d-flex align-items-center">
                <!-- Side Nav Toggle -->
                <a  class="js-side-nav header-invoker d-flex mr-md-2" href="#"
                    data-close-invoker="#sidebarClose"
                    data-target="#sidebar"
                    data-target-wrapper="body">
                    <i class="gd-align-left"></i>
                </a>
                <!-- End Side Nav Toggle -->

                <!-- User Avatar -->
                <div class="dropdown mx-3 ml-auto dropdown ml-2">
                    <a id="profileMenuInvoker" class="header-complex-invoker" href="#" aria-controls="profileMenu" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#profileMenu" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                        {{-- check if user is logged in --}}
                        @if (auth()->check())
                            {{-- get the avatar image of user if exists --}}
                            @if (auth()->user()->user_avatar)
                                <img class="avatar rounded-circle mr-md-2" src="{{ asset('storage/' . auth()->user()->user_avatar) }}" alt="{{ auth()->user()->name }}">
                            @else
                                <span class="mr-md-2 avatar-placeholder">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            @endif
                            <span class="d-none d-md-block">{{ auth()->user()->name }}</span>
                            <i class="gd-angle-down d-none d-md-block ml-2"></i>
                        @else
                        <span class="mr-md-2 avatar-placeholder">J</span>
                        <span class="d-none d-md-block">John Doe</span>
                        <i class="gd-angle-down d-none d-md-block ml-2"></i>
                    </a>
                    @endif

                    <ul id="profileMenu" class="unfold unfold-user unfold-light unfold-top unfold-centered position-absolute pt-2 pb-1 mt-4 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="profileMenuInvoker" style="animation-duration: 300ms;">
                        <li class="unfold-item">
                            <a class="unfold-link d-flex align-items-center text-nowrap" href="/admin/users/{{ auth()->user()->id }}/edit">
                    <span class="unfold-item-icon mr-3">
                      <i class="gd-user"></i>
                    </span>
                                My Profile
                            </a>
                        </li>
                        <li class="unfold-item unfold-item-has-divider">
                            <form method="POST" action="/admin/logout" class="w-100">
                                    @csrf   
                                    <button type="submit" class="unfold-link mr-5 d-flex align-items-center text-nowrap bg-transparent border-0 w-100">
                                    <span class="unfold-item-icon mr-3">
                                        <i class="gd-power-off"></i>
                                    </span>
                                    Sign Out
                                </button>
                                
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- End User Avatar -->
            </div>
        </div>
    </nav>
</header>