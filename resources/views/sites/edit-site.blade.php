@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
@endpush

@section('content-title')
<div class="page-title-heading page-title-heading-m">
    <div>
        <h3>SITES</h3>
    </div>
</div>
@endsection

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>SITES - <small>Site Management</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">
                        @foreach ($siteData as $site)
                        <?php 
                            $site_name = str_replace('_', ' ', str_replace($site->site.'-', '', $site->site_name));
                        ?>
                        @endforeach
                        Site:<strong class="es-site-name"> {{ $site_name }}</strong>
                    </h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/sites';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Sites
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-tabs-m" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-link-m" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                                            aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="cells-tab" data-toggle="tab" href="#cells" role="tab"
                                            aria-controls="cells" aria-selected="false">
                                            Cells
                                            (<?php echo count($siteData); ?>)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="alerts-tab" data-toggle="tab" href="#alerts" role="tab"
                                            aria-controls="alerts" aria-selected="false">Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="location-tab" data-toggle="tab" href="#location" role="tab"
                                            aria-controls="location" aria-selected="true">Location/Map</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="reports-tab" data-toggle="tab" href="#reports" role="tab"
                                            aria-controls="reports" aria-selected="false">
                                            Reports
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                        <p>
                                            echo basic info
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="cells" role="tabpanel" aria-labelledby="cells-tab">
                                        <div class="row">
                                            <div class="col-md-12 site-cell-info">
                                                <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Cell ID</th>
                                                            <th>Cell Name</th>
                                                            <th>Status</th>
                                                            <th>Technology</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($siteData as $site)
                                                            <tr>
                                                                <td><a href="/cell/{{ $site->cell }}"> {{ $site->cell }} </a> </td>
                                                                <td> {{ $site->cell_name }} </td>
                                                                <td> {{ $site->status }} </td>
                                                                <td> {{ $site->technology }} </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Cell ID</th>
                                                            <th>Cell Name</th>
                                                            <th>Status</th>
                                                            <th>Technology</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>


                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                                        <p>
                                            echo some info
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                                        <p>echo location info</p>
                                    </div>
                                    <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                                        <p>
                                            echo reports info
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/edit_site.js') }}"></script>
@endpush