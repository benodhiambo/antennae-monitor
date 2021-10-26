<!-- PAGE CONTENT -->

    <!-- SIDEBAR -->
    <div class="app-sidebar sidebar-shadow">
            @include('layouts.section.sidebar')
    </div>
    <!-- /SIDEBAR -->
                    
                <!-- CONTENT SECTION -->
                <div class="app-main__outer scroll-area-x">
                    <div class="app-main__inner scrollbar-container">
    
                        <!-- CONTENT TITLE SECTION -->
                        <!-- <div class="app-page-title app-page-title-m"> -->
                            {{-- @include('layouts.section.content-title') --}}
                        {{-- </div> --}}
                        <!-- /CONTENT TITLE SECTION -->
                        
                        <!-- CONTENT DETAIL SECTION -->
                            @include('layouts.section.content-detail')
                        <!-- /CONTENT DETAIL SECTION -->
                        
                    </div>
    
                    <!-- CONTENT FOOTER SECTION -->
                    <div class="app-wrapper-footer">
                            @include('layouts.section.content-footer')
                    </div>
                    <!-- /CONTENT FOOTER SECTION -->  
                </div>
                <!-- /CONTENT SECTION -->

<!-- /PAGE CONTENT -->