@extends('layouts.main')

@section('content-detail')
<div class="row scroll-area-x">
        <div class="col-md-12 col-lg-12 scrollbar-container">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <a href="/alerts/status#new/" class="dash-card">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-heading-m">PENDING ALERTS</div>
                                        <div class="widget-subheading">ALERTS NOT VIEWED</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white">
                                            <span>
                                                {{ count($pending) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="/alerts/status#optim/" class="dash-card">
                            <div class="card mb-3 widget-content bg-asteroid">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-heading-m">CELLS</div>
                                        <div class="widget-subheading">CELLS BEING OPTIMIZED</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white">
                                            <span>
                                                {{ count($optimizations) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="/site_reports#install/" class="dash-card">
                            <div class="card mb-3 widget-content bg-slick-carbon">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-heading-m">NEW REPORTS</div>
                                        <div class="widget-subheading">INSTALLATION REPORTS</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white">
                                            <span>
                                                {{ count($new_install) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-5">
                            <div class="mb-3 p-1 card">
                                    {{-- PASS VARIABLES TO JAVASCRIPT --}}
                                    <script>
                                        var pc_data = {!! json_encode($pc_data, JSON_HEX_TAG) !!};
                                    </script>
                                <canvas id="dash-pie-chart" height="350"></canvas>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-7">
                            <div class="mb-3 p-2 card">
                                {{-- PASS VARIABLES TO JAVASCRIPT --}}
                                <script>
                                    var bc_data = {!! json_encode($bc_data, JSON_HEX_TAG) !!};
                                </script>
                                <canvas id="dash-bar-chart-horizontal" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <script>
                                var lc_azim = {!! json_encode($lc_azim, JSON_HEX_TAG) !!};
                                var lc_tilt = {!! json_encode($lc_tilt, JSON_HEX_TAG) !!};
                                var lc_roll = {!! json_encode($lc_roll, JSON_HEX_TAG) !!};
                                var lc_volt_low = {!! json_encode($lc_volt_low, JSON_HEX_TAG) !!};
                                var lc_volt_drop = {!! json_encode($lc_volt_drop, JSON_HEX_TAG) !!};
                                var lc_comm = {!! json_encode($lc_comm, JSON_HEX_TAG) !!};
                            </script>
                            <div class="mb-3 card">
                                <canvas id="dash-line-chart" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">
                                                <h5 class="c_head">Closed Alerts</h5>
                                            </div>
                                            <div class="widget-subheading">
                                                <h5 class="c_sub">(This Year)</h5>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success">
                                                <h5 class="c_data">{{ count($closed) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">
                                                <h5 class="c_head">Installations</h5>
                                            </div>
                                            <div class="widget-subheading">
                                                <h5 class="c_sub">(This Year)</h5>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning">
                                                <h5 class="c_data">{{ $years_install[0]->install_count }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">CURRENT CELLS IN OPTIMIZATION
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Cell ID</th>
                                            <th>Cell Name</th>
                                            <th class="text-center">Alerts</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($optimizations as $opt)
                                                <?php $alert_count = array(); ?>
                                                @foreach ($cells as $cell)
                                                    @if ($opt->cell_id == $cell->cell_id)
                                                        <?php 
                                                            array_push($alert_count, $opt->id);

                                                            $name_arr = explode("-", $cell->cell_name);
                                                            $remove_id = array_splice($name_arr, 1);
                                                            $raw_name = implode("-", $remove_id);
                                                            $cell_name = str_replace('_', ' ', $raw_name);
                                                        ?>
                                                    @endif
                                                @endforeach
                                                    <tr>
                                                        <td class="text-center text-muted"> 
                                                            <a href="/cell/{{ $opt->cell_id }}">
                                                                {{ $opt->cell_id }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading">{{ $cell_name }} </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ count($alert_count) }} 
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="badge badge-warning"><a href="#" onmouseover="this.style.text-decoration=none">Optimization In Progress</a></div>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</button>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-block text-center card-footer">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                    <button class="btn-wide btn btn-success">Save</button>
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
    <script src="{{ asset('assets/scripts/dash.js') }}"></script>
@endpush