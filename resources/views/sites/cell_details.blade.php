@extends('layouts.main')

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
                            // Make Cell name readable
                            $name_arr = explode("-", $cellData[0]->cell_name);
                            $remove_id = array_splice($name_arr, 1);
                            $raw_name = implode("-", $remove_id);
                            $cell_name = str_replace('_', ' ', $raw_name);
                        ?>
                        Cell Name:<strong class="ec-cell-name"> {{ $cell_name }}</strong>
                        
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
                                <ul class="nav nav-tabs nav-tabs-m" id="cellsTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="alerts-tab" data-toggle="tab" href="#alerts" role="tab"
                                            aria-controls="alerts" aria-selected="false">
                                            Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="threshold-tab" data-toggle="tab" href="#threshold" role="tab"
                                            aria-controls="threshold" aria-selected="true">
                                            Thresholds
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="battery-tab" data-toggle="tab" href="#battery" role="tab"
                                            aria-controls="battery" aria-selected="true">
                                            Battery
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                    <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Alert Type</th>
                                                                <th>Value</th>
                                                                <th>Threshold</th>
                                                                <th>Alert Status</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cellData as $cell)
                                                                @foreach ($cellAlerts as $alert)
                                                                    @if ($cell->cell_id == $alert->cell_id)
                                                                    <?php 
                                                                        
                                                                    ?>
                                                                    <tr>
                                                                        <td>{{$alert->alert_type}}</td>
                                                                        <td>{{$alert->value}}</td>
                                                                        <td>
                                                                            @if ($alert->alert_type == 'Heading')
                                                                                {{ $cell->heading }}
                                                                            @elseif ($alert->alert_type == 'Pitch')
                                                                                {{ $cell->pitch }}
                                                                            @elseif ($alert->alert_type == 'Roll')
                                                                                {{ $cell->pitch }}
                                                                            @elseif ($alert->alert_type == 'Low Voltage')
                                                                                3.2 Volts
                                                                            @elseif ($alert->alert_type == 'Voltage Drop' )
                                                                                N/A
                                                                            @elseif ($alert->alert_type == 'No Communication' )
                                                                                N/A                                                        
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($alert->status == 'Closed')
                                                                                {{ $alert->status }}
                                                                            @else
                                                                                <a href="/alerts/{{$alert->id}}/update_status">
                                                                                    {{ $alert->status }}
                                                                                </a>                                                 
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$alert->created_at}}</td>
                                                                    </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Alert Type</th>
                                                                <th>Value</th>
                                                                <th>Threshold</th>
                                                                <th>Alert Status</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="threshold" role="tabpanel" aria-labelledby="threshold-tab">
                                            <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-12 site-cell-info">
                                                                <?php
                                                                $metric = array('Heading', 
                                                                                'Pitch', 
                                                                                'Roll', 
                                                                                'Low Voltage', 
                                                                                'Voltage Drop',
                                                                                'No Communication' 
                                                                            ); 
                                                            ?>
                                                            <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Metric</th>
                                                                        <th>Threshold</th>
                                                                        <th>Date Created</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($metric as $mtr)
                                                                        @foreach ($cellData as $cell)
                                                                            <tr>
                                                                                <td>{{$mtr}}</td>
                                                                                <td>
                                                                                    @if ($mtr == 'Heading')
                                                                                        {{ $cell->heading }}
                                                                                    @elseif ($mtr == 'Pitch')
                                                                                        {{ $cell->pitch }}
                                                                                    @elseif ($mtr == 'Roll')
                                                                                        {{ $cell->pitch }}
                                                                                    @elseif ($mtr == 'Low Voltage')
                                                                                        3.2 Volts
                                                                                    @elseif ($mtr == 'Voltage Drop')
                                                                                        N/A
                                                                                    @elseif ($mtr == 'No Communication')
                                                                                        N/A                                                        
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{$cell->created_at}}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Metric</th>
                                                                        <th>Threshold</th>
                                                                        <th>Date Created</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="tab-pane fade" id="battery" role="tabpanel" aria-labelledby="battery-tab">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-7 col-lg-7 cell_line_graph">
                                                        <h6>Cell ID: {{$cell->cell_id}} - Battery Levels</h6>
                                                        <script>
                                                            var lc_volt = {!! json_encode($batteryVoltage, JSON_HEX_TAG) !!};
                                                        </script>
                                                        <div class="mb-3 card">
                                                            <canvas id="voltageLineGraph" height="100"></canvas>
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
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/edit_cell.js') }}"></script>
@endpush