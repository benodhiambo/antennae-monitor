@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
@endpush

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>ALERTS <small></small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">Alerts - Update Status</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/alerts/types';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Types
                        </button>
                        <button onclick="window.location.href = '/alerts';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View All Alerts
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row uas-row c-e">
                                <?php
                                    $name_arr = explode("-", $cellData[0]->cell_name);
                                    $remove_id = array_splice($name_arr, 1);
                                    $raw_name = implode("-", $remove_id);
                                    $cell_name = str_replace('_', ' ', $raw_name);
                                ?>
                                <div class="col-md-6">
                                    <h6 class="uas-data">Cell Name: <strong style="text-transform: uppercase;">{{ $cell_name }}</strong></h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="uas-data">Cell Status: <strong style="text-transform: uppercase;">{{ $cellData[0]->status }}</strong></h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="uas-data">Cell ID: <strong style="text-transform: uppercase;"> {{ $cellData[0]->cell_id }}</strong></h6>
                                </div>
                            </div>
                            <div class="row uas-row h-o">
                                <div class="col-md-12">
                                    <h5 class="uas-header">ALERT DETAILS</h5>
                                </div>
                            </div>
                            <div class="row uas-row c-o">
                                <div class="col-md-6">
                                    <h6 class="uas-data">Alert Type: <strong style="text-transform: uppercase;">{{ $alertData[0]->alert_type }}</strong></h6>
                                </div>
                            </div>
                            <div class="row uas-row c-o">
                                <div class="col-md-3">
                                    <h6 class="uas-data">
                                        Alert Value: 
                                        <strong style="text-transform: uppercase;">
                                            {{ $alertData[0]->value }}
                                        </strong>
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="uas-data">
                                        Alert Threshold: 
                                        <strong style="text-transform: uppercase;">
                                            @if ($alertData[0]->alert_type == 'Heading')
                                                {{ $cellData[0]->heading }}
                                            @elseif ($alertData[0]->alert_type == 'Pitch')
                                                {{ $cellData[0]->pitch }}
                                            @elseif ($alertData[0]->alert_type == 'Roll')
                                                {{ $cellData[0]->roll }}
                                            @elseif ($alertData[0]->alert_type == 'Low Voltage')
                                                3.2 Volts
                                            @elseif ($alertData[0]->alert_type == 'Voltage Drop' )
                                                N/A
                                            @elseif ($alertData[0]->alert_type == 'No Communication')
                                                N/A                                                        
                                            @endif
                                        </strong>
                                    </h6>
                                </div>
                            </div>

                            <hr class="sd-cards-hr" />

                            <form action="/alerts/{{$alertData[0]->id}}/update_status" method="POST">
                                @csrf
                            <div class="row uas-row c-e c-e-m">
                                    <div class="input-group col-md-6">
                                        <div class="position-relative form-check" style="width: 100%;">
                                            Alert Status: {{ $alertData[0]->status }}
                                            <label class="form-check-label" style="width: 100%;">
                                                <select class="form-control" id="alert_status" name="status" autocomplete="off" style="width: 100%!;" required>
                                                    @if ($alertData[0]->status == 'Pending')
                                                        <option value="Pending" selected>Pending</option>
                                                        <option value="Optimization">Optimization</option>
                                                        <option value="Closed">Closed</option>
                                                    @elseif($alertData[0]->status == 'Optimization')
                                                        <option value="Pending">Pending</option>
                                                        <option value="Optimization" selected>Optimization</option>
                                                        <option value="Closed">Closed</option>
                                                    @elseif($alertData[0]->status == 'Closed')
                                                        <option value="Pending">Pending</option>
                                                        <option value="Optimization">Optimization</option>
                                                        <option value="Closed" selected>Closed</option>
                                                    @endif
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-group col-md-4">
                                        <button type ="submit" class="mt-1 btn btn-primary btn-app">
                                            Update Status
                                        </button>
                                    </div>
                            </div> 
                        </form>
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
    <script src="{{ asset('assets/scripts/alerts_status.js') }}"></script>
@endpush