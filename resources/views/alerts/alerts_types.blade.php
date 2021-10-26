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

                    <h5 class="content-detail-title">Alerts Types</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/alerts/status';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Status
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
                            <ul class="nav nav-tabs nav-tabs-m" id="alertsTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active nav-link-m" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                        aria-controls="all" aria-selected="true">
                                        All Alerts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="heading-tab" data-toggle="tab" href="#heading" role="tab"
                                        aria-controls="heading" aria-selected="false">
                                        Heading</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="pitch-tab" data-toggle="tab" href="#pitch" role="tab"
                                        aria-controls="pitch" aria-selected="true">
                                        Pitch
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="roll-tab" data-toggle="tab" href="#roll" role="tab"
                                        aria-controls="roll" aria-selected="true">
                                        Roll
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="vl-tab" data-toggle="tab" href="#vl" role="tab"
                                        aria-controls="vl" aria-selected="true">
                                        Low Voltage
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="vd-tab" data-toggle="tab" href="#vd" role="tab"
                                        aria-controls="vd" aria-selected="true">
                                        Voltage Drop
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="comm-tab" data-toggle="tab" href="#comm" role="tab"
                                        aria-controls="comm" aria-selected="false">
                                        No Communication
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-m" id="">
                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
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
                                                <tr>
                                                    <td>{{$alert->created_at}}</td>
                                                    <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                    <td> {{ $alert->alert_type }} </td>
                                                    <td> {{ $alert->value }} </td>
                                                    <td> {{ $alert->threshold }} </td>
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
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
                                                <th>Alert Type</th>
                                                <th>Value</th>
                                                <th>Threshold</th>
                                                <th>Alert Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="heading" role="tabpanel" aria-labelledby="heading-tab">
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
                                                @if ($alert->alert_type == 'Heading')
                                                    <tr>
                                                        <td>{{$alert->created_at}}</td>
                                                        <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                        <td> {{ $alert->alert_type }} </td>
                                                        <td> {{ $alert->value }} </td>
                                                        <td> {{ $alert->threshold }} </td>
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
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
                                                <th>Alert Type</th>
                                                <th>Value</th>
                                                <th>Threshold</th>
                                                <th>Alert Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pitch" role="tabpanel" aria-labelledby="pitch-tab">
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
                                                @if ($alert->alert_type == 'Pitch')
                                                    <tr>
                                                        <td>{{$alert->created_at}}</td>
                                                        <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                        <td> {{ $alert->alert_type }} </td>
                                                        <td> {{ $alert->value }} </td>
                                                        <td> {{ $alert->threshold }} </td>
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
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
                                                <th>Alert Type</th>
                                                <th>Value</th>
                                                <th>Threshold</th>
                                                <th>Alert Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="roll" role="tabpanel" aria-labelledby="roll-tab">
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
                                                @if ($alert->alert_type == 'Roll')
                                                    <tr>
                                                        <td>{{$alert->created_at}}</td>
                                                        <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                        <td> {{ $alert->alert_type }} </td>
                                                        <td> {{ $alert->value }} </td>
                                                        <td> {{ $alert->threshold }} </td>
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
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
                                                <th>Alert Type</th>
                                                <th>Value</th>
                                                <th>Threshold</th>
                                                <th>Alert Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="vl" role="tabpanel" aria-labelledby="vl-tab">
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
                                                @if ($alert->alert_type == 'Low Voltage')
                                                    <tr>
                                                        <td>{{$alert->created_at}}</td>
                                                        <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                        <td> {{ $alert->alert_type }} </td>
                                                        <td> {{ $alert->value }} </td>
                                                        <td> {{ $alert->threshold }} </td>
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
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
                                                <th>Alert Type</th>
                                                <th>Value</th>
                                                <th>Threshold</th>
                                                <th>Alert Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="vd" role="tabpanel" aria-labelledby="vd-tab">
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
                                                @if ($alert->alert_type == 'Voltage Drop')
                                                    <tr>
                                                        <td>{{$alert->created_at}}</td>
                                                        <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                        <td> {{ $alert->alert_type }} </td>
                                                        <td> {{ $alert->value }} </td>
                                                        <td> {{ $alert->threshold }} </td>
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
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
                                                <th>Alert Type</th>
                                                <th>Value</th>
                                                <th>Threshold</th>
                                                <th>Alert Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="comm" role="tabpanel" aria-labelledby="comm-tab">
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
                                                @if ($alert->alert_type == 'No Communication')
                                                    <tr>
                                                        <td>{{$alert->created_at}}</td>
                                                        <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                        <td> {{ $alert->alert_type }} </td>
                                                        <td> {{ $alert->value }} </td>
                                                        <td> {{ $alert->threshold }} </td>
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
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Time</th>
                                                <th>Cell ID</th>
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
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/alerts_types.js') }}"></script>
@endpush