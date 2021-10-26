<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.section.head')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        <!-- TOP NAV -->
        <div class="app-header header-shadow bg-night-sky header-text-light">
            @include('layouts.section.nav')
        </div>
        <!-- /TOP NAV -->        
        
        <!-- PAGE CONTENT -->
        <div class="app-main">
            @include('layouts.section.content')
        </div>
        <!-- /PAGE CONTENT -->

    </div>
    <!-- PAGE SCRIPTS -->
    @include('layouts.section.scripts')
</body>
</html>
