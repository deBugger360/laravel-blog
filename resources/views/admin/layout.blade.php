<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials._head')
</head>
{{-- don't display class if it's the login page --}}
<body class=" {{ request()->is('admin/login') ? '' : 'has-sidebar has-fixed-sidebar-and-header' }}">

<!-- Header -->
{{-- don't display header if it's the login page --}}
@if(!request()->is('admin/login'))
    @include('admin.partials._header')
@endif

<main class="main">
    <!-- Sidebar Nav -->
    @if(!request()->is('admin/login'))
        @include('admin.partials._sidebar')
    @endif

    <div class="content">
      
        @yield('content')

    </div>
</main>

@yield('scripts')

</body>
</html>