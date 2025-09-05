<!-- # site header -->
<header id="masthead" class="s-header">

    <div class="s-header__branding">
        <p class="site-title">
            <a href="/" rel="home">Scribe & Share</a>
        </p>
    </div>

    <div class="row s-header__navigation">

        <nav class="s-header__nav-wrap">

            <h3 class="s-header__nav-heading">Navigate to</h3>

            <ul class="s-header__nav">
                <li class="{{ Request::is('/') ? 'current-menu-item' : '' }}"><a href="/" title="">Home</a></li>
                <li class="has-children">
                    <a href="javascript:void(0)" title="categories">Categories</a>
                    <ul class="sub-menu">
                         @foreach ($categories as $category)
                            <li><a href="/content?category={{ $category }}">{{ $category }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{ Request::is('about') ? 'current-menu-item' : '' }}"><a href="/about" title="">About</a></li>
                <li class="{{ Request::is('contact') ? 'current-menu-item' : '' }}"><a href="/contact" title="">Contact</a></li>
            </ul> <!-- end s-header__nav -->

        </nav> <!-- end s-header__nav-wrap -->

    </div> <!-- end s-header__navigation -->

    <!-- s-header__search -->
    @include('blog.partials._searchbar')

    <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
    <a class="s-header__search-trigger" href="#">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 19.25L15.5 15.5M4.75 11C4.75 7.54822 7.54822 4.75 11 4.75C14.4518 4.75 17.25 7.54822 17.25 11C17.25 14.4518 14.4518 17.25 11 17.25C7.54822 17.25 4.75 14.4518 4.75 11Z"></path>
        </svg>
    </a>

</header> <!-- end s-header -->