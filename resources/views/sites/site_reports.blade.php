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
                <h3>SITES - <small>Site Reports</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">reports</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-tabs-m" id="alertsTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="install-tab" data-toggle="tab" href="#install" role="tab"
                                        aria-controls="install" aria-selected="false">
                                        Installation Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="test-tab" data-toggle="tab" href="#test" role="tab"
                                        aria-controls="test" aria-selected="false">
                                        Test Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-m" id="accept-tab" data-toggle="tab" href="#accept" role="tab"
                                        aria-controls="accept" aria-selected="false">
                                        Acceptance Reports</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-m" id="">
                                <div class="tab-pane fade show active" id="install" role="tabpanel" aria-labelledby="install-tab">
                                    <table id="install_reports_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Site ID</th>
                                                <th>QR Number</th>
                                                <th>Installation Report</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Last Modified</th>
                                                <th>Report Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($installData as $install)
                                            <tr>
                                                <td><a href="/site/{{ $install->site_id }}">{{ $install->site_id }}</a></td>
                                                <td>{{ $install->qr_number }}</td>
                                                <td>
                                                    <a href="/{{$install->id}}/edit_report_status">
                                                        {{ $install->reportName }}
                                                    </a>
                                                </td>
                                                <td>{{ $install->user_name }}</td>
                                                <td>{{ $install->status }}</td>
                                                <td>{{ $install->updated_at }}</td>
                                                <td>
                                                    <a href="{{asset('storage/InstallationReport/'.$install->installation_report)}}" target="_blank">
                                                        View 
                                                    </a>
                                                    &nbsp;|&nbsp;
                                                    <a href="{{asset('storage/InstallationReport/'.$install->installation_report)}}" download="{{$install->installation_report}} ">
                                                        Download 
                                                    </a> |
                                                    @if (empty($install->accept_report_id))
                                                        <a href="/site_reports/{{$install->id}}/upload_acceptance_form/">
                                                            Upload Acceptance Form
                                                        </a> 
                                                    @else
                                                        <a href="/site_reports/{{$install->id}}/upload_acceptance_form/">
                                                            Update Acceptance Details
                                                        </a> 
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Site ID</th>
                                                <th>QR Number</th>
                                                <th>Installation Report</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Last Modified</th>
                                                <th>Report Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="test" role="tabpanel" aria-labelledby="test-tab">
                                    <table id="test_reports_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>QR Number</th>
                                                <th>Test Report</th>
                                                <th>Report Action</th>
                                                <th>User</th>
                                                <th>Last Modified</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($testData as $test)
                                            <?php 
                                                
                                            ?>
                                            <tr>
                                                <td><a href="#">{{ $test->qr_number }}</a></td>
                                                <td>{{ $test->test_report }}</td>
                                                <td>
                                                    <a href="{{asset('storage/testReport/'.$test->test_report)}}" target="_blank">
                                                        View
                                                    </a> |
                                                    <a href="{{asset('storage/testReport/'.$test->test_report)}}" download>
                                                        Download
                                                    </a> 
                                                </td>
                                                <td>{{ $test->user_name }}</td>
                                                <td>{{ $test->updated_at }}</td>
                                                <td>{{ $test->status }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>QR Number</th>
                                                <th>Test Report</th>
                                                <th>Report Action</th>
                                                <th>User</th>
                                                <th>Last Modified</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="accept" role="tabpanel" aria-labelledby="accept-tab">
                                    <table id="accept_reports_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Installation Report</th>
                                                <th>Acceptance Form</th>
                                                <th>Acceptance Status</th>
                                                <th>Comments</th>
                                                <th>Report Action</th>
                                                <th>Last Modified</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($acceptanceData as $accept)
                                            <tr>
                                                <td>
                                                    <a href="/{{$accept->installation_report_id}}/edit_report_status">
                                                        {{ $accept->reportName }}
                                                    </a>
                                                </td>
                                                <td>{{ $accept->acceptance_form }}</td>
                                                <td><a href="#">{{ $accept->status }}</a></td>
                                                <td>{{ $accept->comment }}</td>
                                                <td>
                                                    <a href="{{asset('storage/AcceptanceForms/'.$accept->acceptance_form)}}" target="_blank">
                                                        View
                                                    </a> |
                                                    <a href="{{asset('storage/AcceptanceForms/'.$accept->acceptance_form)}}" download>
                                                        Download
                                                    </a> |
                                                    <a href="/site_reports/{{$accept->installation_report_id}}/upload_acceptance_form/">
                                                        Update Acceptance Details
                                                    </a> 
                                                </td>
                                                <td>{{ $accept->updated_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Installation Report</th>
                                                <th>Acceptance Form</th>
                                                <th>Acceptance Status</th>
                                                <th>Comments</th>
                                                <th>Report Action</th>
                                                <th>Last Modified</th>
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
    <script src="{{ asset('assets/scripts/site_reports.js') }}"></script>
@endpush