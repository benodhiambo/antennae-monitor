@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="./assets/datatables/datatables.min.css" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="./assets/css/datatables.css" />
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
                <h3>ALERTS <small></small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">all Alerts</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/alerts/types';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Types
                        </button>
                        <button onclick="window.location.href = '/alerts/status';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Status
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    
                    <div class="row">
                            <div class="col-md-12 site-cell-info">
                                <table id="alerts_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Cell Name</th>
                                            <th>Alert Type</th>
                                            <th>Value</th>
                                            <th>Threshold</th>
                                            <th>Alert Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alertData as $alert)
                                            @foreach ($cellData as $cell)
                                                @if ($alert->cell_id == $cell->cell_id)
                                                    <?php
                                                        $name_arr = explode("-", $cell->cell_name);
                                                        $remove_id = array_splice($name_arr, 1);
                                                        $raw_name = implode("-", $remove_id);
                                                        $cell_name = str_replace('_', ' ', $raw_name);
                                                    ?>
                                                    <tr>
                                                        <td>{{ $alert->created_at }} </td>
                                                        <td><a href="/cell/{{ $alert->cell_id}}#alerts">{{ $cell_name }}</a></td>
                                                        <td>{{ $alert->alert_type }}</td>
                                                        <td>{{ $alert->value }}</td>
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
                                                            @elseif ($alert->alert_type == 'No Communication')
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Time</th>
                                            <th>Cell Name</th>
                                            <th>Alert Type</th>
                                            <th>Value</th>
                                            <th>Threshold</th>
                                            <th>Alert Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="./assets/datatables/datatables.min.js"></script>
@endpush

@push('page-scripts')
    <script src="./assets/scripts/alertlist.js"></script>
@endpush