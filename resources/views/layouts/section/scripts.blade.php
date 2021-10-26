<!-- PAGE SPECIFIC SCRIPTS -->
<!-- 
    FRAMEWORK SCRIPTS THAT CAN BE LOADED BEFORE TEMPLATE JS 
-->
@stack('app-scripts')

<!-- TEMPLATE SCRIPTS -->
<script type="text/javascript" src="{{ asset('assets/scripts/template.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/csrf.js') }}"></script>

<!-- CUSTOM PAGE SCRIPTS -->
@stack('page-scripts')