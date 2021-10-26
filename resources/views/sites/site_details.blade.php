@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/leaflet/leaflet.css') }}" />
@endpush

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
                        
                        <?php 
                            $site_name = str_replace('_', ' ', str_replace($siteData[0]->site_id.'-', '', $siteData[0]->site_name));
                        ?>
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
                                <ul class="nav nav-tabs nav-tabs-m" id="sitesTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="cells-tab" data-toggle="tab" href="#cells" role="tab"
                                            aria-controls="cells" aria-selected="false">
                                            Cells
                                            (<?php echo count($cellData); ?>)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="alerts-tab" data-toggle="tab" href="#alerts" role="tab"
                                            aria-controls="alerts" aria-selected="false">
                                            Alerts
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="map-tab" data-toggle="tab" href="#map" role="tab"
                                            aria-controls="map" aria-selected="false">
                                            Location/Map
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="cells" role="tabpanel" aria-labelledby="cells-tab">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                        <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Cell Name</th>
                                                                        <th>Status</th>
                                                                        <th>Technology</th>
                                                                        <th>Date Created</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($siteData as $site)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($site->site_id == $cell->site_id)
                                                                                <?php 
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}"> {{ $cell_name }} </a></td>
                                                                                    <td>{{ $cell->status }}</td>
                                                                                    <td> {{ $cell->technology }} </td>
                                                                                    <td> {{ $cell->created_at }} </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Cell Name</th>
                                                                        <th>Alerts</th>
                                                                        <th>Technology</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                    <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Cell Name</th>
                                                                <th>All Alerts</th>
                                                                <th>Technology</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siteData as $site)
                                                                @foreach ($cellData as $cell)
                                                                    @if ($site->site_id == $cell->site_id)
                                                                        <?php 
                                                                            $name_arr = explode("-", $cell->cell_name);
                                                                            $remove_id = array_splice($name_arr, 1);
                                                                            $raw_name = implode("-", $remove_id);
                                                                            $cell_name = str_replace('_', ' ', $raw_name);
                                                                        ?>
                                                                        <tr>
                                                                            <td><a href="/cell/{{ $cell->cell_id }}"> {{ $cell_name }} </a></td>
                                                                            <td>
                                                                                <a href="/cell/{{ $cell->cell_id }}#alerts">
                                                                                    <?php $alertCount = array(); ?>
                                                                                    @foreach ($alertData as $alert)
                                                                                        @if ($cell->cell_id == $alert->cell_id)
                                                                                            <?php array_push($alertCount, $alert->cell_id); ?>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    {{ count($alertCount) }}
                                                                                    <?php unset($alertCount); ?>
                                                                                </a>
                                                                            </td>
                                                                            <td> {{ $cell->technology }} </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Cell Name</th>
                                                                <th>Alerts</th>
                                                                <th>Technology</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="map" name="map" role="tabpanel" aria-labelledby="map-tab">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <script>
                                                                    var lat = {!! $siteData[0]->lat !!};
                                                                    var long = {!! $siteData[0]->long !!};
                                                                </script>
                                                                <div class="col-md-3">
                                                                    <strong class="map-header">Site ID:</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong class="map-cood">Coordinates</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <strong class="map-header-site-id">{{$siteData[0]->site_id}}</strong>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong class="map-lat">Latitude:</strong>
                                                                    <strong class="map-lat-val"> {{$siteData[0]->lat}}&#176; </strong>
                                                                    &emsp;
                                                                    <strong class="map-long">Longitude:</strong>
                                                                    <strong class="map-long-val"> {{$siteData[0]->long}}&#176; </strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        
                                                    </div>
                                                    <hr class="map-divider" />
                                                    <div id="mapid" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/edit_site.js') }}"></script>
@endpush