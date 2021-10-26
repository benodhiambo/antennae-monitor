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
                <h3>SITES DETAILS</h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">INSTALLATION SUMMARY per region</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-12">
                            <table id="summary_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Region</th>
                                        <th>No.Of Sites</th>
                                        <th>Installed</th>
                                        <th>Acceptance Schedule</th>
                                        <th>Accepted</th>
                                        <th>Rejected</th>
                                        <th>Total Visited Sites</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siteCount as $region)
                                        <tr>
                                            <th> {{ $region['name']}}</th>
                                            <th> {{ $region['scoped'] }} </th>
                                            <th> {{ $region['installed'] }} </th>
                                            <th> {{ $region['scheduled'] }} </th>
                                            <th> {{ $region['accepted'] }} </th>
                                            <th> {{ $region['rejected'] }} </th>
                                            <th>Total Visited Sites</th>
                                        </tr> 
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Region</th>
                                        <th>No.Of Sites</th>
                                        <th>Installed</th>
                                        <th>Acceptance Schedule</th>
                                        <th>Accepted</th>
                                        <th>Rejected</th>
                                        <th>Total Visited Sites</th>
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
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/summary.js') }}"></script>
@endpush