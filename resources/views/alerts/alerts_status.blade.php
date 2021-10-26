@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
@endpush

@push('header-scripts')
    <script type="text/javascript" src="{{ asset('assets/scripts/jquery/jquery-3.3.1.min.js') }}"></script>
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

                    <h5 class="content-detail-title">Alerts status</h5>

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
                                <ul class="nav nav-tabs nav-tabs-m" id="alertsTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-link-m" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                            aria-controls="all" aria-selected="true">
                                            All Alerts
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                                            aria-controls="pending" aria-selected="false">
                                            Pending Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="optim-tab" data-toggle="tab" href="#optim" role="tab"
                                            aria-controls="optim" aria-selected="true">
                                            Optimizations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="closed-tab" data-toggle="tab" href="#closed" role="tab"
                                            aria-controls="closed" aria-selected="false">
                                            Closed Alerts
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
                                                    <th>Cell Name</th>
                                                    <th>Alert Type</th>
                                                    <th>Value</th>
                                                    <th>Threshold</th>
                                                    <th>Alert Status</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                        <table id="pending_alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
                                                    @if ($alert->status == 'Pending')
                                                        <tr>
                                                            <td>{{$alert->created_at}}</td>
                                                            <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                            <td> {{ $alert->alert_type }} </td>
                                                            <td> {{ $alert->value }} </td>
                                                            <td> {{ $alert->threshold }} </td>
                                                            <td>
                                                                <a href="/alerts/{{$alert->id}}/update_status">
                                                                    {{ $alert->status }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
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
                                    <div class="tab-pane fade" id="optim" role="tabpanel" aria-labelledby="optim-tab">
                                        <table id="optim_alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
                                                    @if ($alert->status == 'Optimization')
                                                        <tr>
                                                            <td>{{$alert->created_at}}</td>
                                                            <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                            <td> {{ $alert->alert_type }} </td>
                                                            <td> {{ $alert->value }} </td>
                                                            <td> {{ $alert->threshold }} </td>
                                                            <td>
                                                                <a href="/alerts/{{$alert->id}}/update_status">
                                                                    {{ $alert->status }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
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
                                    <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                        <table id="closed_alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
                                                    @if ($alert->status == 'Closed')
                                                        <tr>
                                                            <td>{{$alert->created_at}}</td>
                                                            <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $alert->cell_name }}</a></td>
                                                            <td> {{ $alert->alert_type }} </td>
                                                            <td> {{ $alert->value }} </td>
                                                            <td> {{ $alert->threshold }} </td>
                                                            <td> {{ $alert->status }} </td>
                                                        </tr>
                                                    @endif
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
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/alerts_status.js') }}"></script>
@endpush