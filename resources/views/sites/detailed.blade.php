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

                    <h5 class="content-detail-title">detailed installation data</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-12">
                            <table id="detailed_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Antenna Monitor ID</th>
                                        <th>IMSI</th>
                                        <th>Test Cert</th>
                                        <th>Technician</th>
                                        <th>Company</th>
                                        <th>Team</th>
                                        <th>Date Collected</th>
                                        <th>Installation Date</th>
                                        <th>Site ID</th>
                                        <th>Site Name</th>
                                        <th>Technology</th>
                                        <th>Cell ID</th>
                                        <th>Cell Name</th>
                                        <th>Sector No.</th>
                                        <th>Installation Photo</th>
                                        <th>Installation Cert</th>
                                        <th>Status</th>
                                        <th>Acceptance Cert</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($summaryData as $sum)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $sum->qr_number }}</td>
                                            <td>{{ $sum->imsi }}</td>
                                            <td><a href="{{asset('storage/testReport/'.$sum->test_report)}}">{{ $sum->test_report_name }}</a></td>
                                            <td>{{ $sum->user_name }}</td>
                                            <td>{{ $sum->contractor_name }}</td>
                                            <td>{{ $sum->team_name }}</td>
                                            <td>{{ $sum->date_collected }}</td>
                                            <td>{{ $sum->date_installed }}</td>
                                            <td>{{ $sum->site_id }}</td>
                                            <td><a href="/site/{{ $sum->site_id }}#cells"> {{$sum->site_name}} </a></td>
                                            <td>{{ $sum->technology }}</td>
                                            <td>{{ $sum->cell_id }}</td>
                                            <td><a href="/cell/{{ $sum->cell_id}}#alerts">{{ $sum->cell_name }}</a></td>
                                            <td>{{ $sum->sector_id }}</td>
                                            <td><a href="{{asset('storage/installationImages/'.$sum->image)}}">{{$sum->image_name}}</a></td>
                                            <td><a href="{{asset('storage/InstallationReport/'.$sum->installation_report)}}" target="_blank">{{ $sum->installation_report_name }}</a></td>
                                            <td>{{ $sum->acceptance_status }}</td>
                                            <td><a href="#">{{ $sum->acceptance_form }}</a></td>
                                            <td>{{ $sum->acceptance_comment }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Antenna Monitor ID</th>
                                        <th>IMSI</th>
                                        <th>Test Cert</th>
                                        <th>Technician</th>
                                        <th>Company</th>
                                        <th>Team</th>
                                        <th>Date Collected</th>
                                        <th>Installation Date</th>
                                        <th>Site ID</th>
                                        <th>Site Name</th>
                                        <th>Technology</th>
                                        <th>Cell ID</th>
                                        <th>Cell Name</th>
                                        <th>Sector No.</th>
                                        <th>Installation Photo</th>
                                        <th>Installation Cert</th>
                                        <th>Status</th>
                                        <th>Acceptance Cert</th>
                                        <th>Comment</th>
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
    <script src="{{ asset('assets/scripts/detailed.js') }}"></script>
@endpush