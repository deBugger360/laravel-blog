<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>

   @include('blog.partials._head')

</head>


<body id="top">

   @include('blog.partials._preloader')

    <!-- page wrap -->
    <div id="page" class="s-pagewrap {{ Request::is('/') ? 'ss-home' : '' }}">

        @include('blog.partials._header')

        <!-- # site-content -->
        <section id="content" class="s-content {{ Request::is('/') ? '' : 's-content--page' }} ">
         

          <!-- hero -->
          @yield('hero')

            <!--  masonry -->
          @yield('content')


        </section> 
        <!-- end s-content -->

        <!-- # site-footer --> 
        @include('blog.partials._footer')

        <!-- footer scripts -->
        @include('blog.partials._footerscripts')

    </div>

</body>
</html>