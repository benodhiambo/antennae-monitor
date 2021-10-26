<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>{{ config('app.name') }}</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<meta name="description" content="App Dashboard">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="msapplication-tap-highlight" content="no">

<!-- 
    *PAGE SPECIFIC STYLES
-->
<!-- FRAMEWORK CSS FOR PAGE -->
@stack('pre-template-styles')
<link href="{{ asset('assets/css/template.css') }}" rel="stylesheet">
@stack('post-template-styles')

<!-- CUSTOM PAGE CSS -->
@stack('pre-app-styles')
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
@stack('post-app-styles')

<!--  HEADER SCRIPTS -->
@stack('header-scripts')

