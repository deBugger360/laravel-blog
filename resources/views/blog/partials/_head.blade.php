<!--- basic page needs -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<script>
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');
</script>

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('theme/css/vendor.css') }}">
<link rel="stylesheet" href="{{ asset('theme/css/styles.css') }}">

<!-- favicons -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('theme/images/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('theme/images/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/images/favicons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('theme/images/favicons/site.webmanifest') }}">