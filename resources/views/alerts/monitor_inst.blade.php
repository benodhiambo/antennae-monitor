@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="./assets/datatables/datatables.min.css" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="./assets/css/datatables.css" />
@endpush

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>ALERTS - <small>MONITORS</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">MONITORS</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />
                    
                    <div class="row">
                            <div class="col-md-12 site-cell-info">
                                <table id="monitors_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Cell ID</th>
                                            <th>QR Number</th>
                                            <th>IMSI</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($instData as $install)
                                            @foreach ($alertData as $alert)
                                                <tr>
                                                    <td><a href="/cell/{{ $alert->cell_id }}#alerts">{{ $install->cell_id }}</a></td>
                                                    <td>{{ $install->qr_number }}</td>
                                                    <td>{{ $install->imsi }}</td>
                                                    <td>{{ $install->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cell ID</th>
                                            <th>QR Number</th>
                                            <th>IMSI</th>
                                            <th>Created At</th>
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
    <script src="./assets/scripts/monitor_inst.js"></script>
@endpush