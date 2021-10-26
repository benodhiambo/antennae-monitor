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
                <h3>SITES - <small>Acceptance</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">site name - <strong> {{$reportData[0]->site_name}} </strong> </h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/site_reports#accept';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Acceptance Reports
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-8 report-details">

                            <div class="row">
                                <div class="col-md-3 head-detail">
                                    <p>Site ID</p>
                                </div>
                                <div class="col-md-9">
                                    <strong>
                                        {{$reportData[0]->site_id}}
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 head-detail">
                                    <p>Acceptance Report</p>
                                </div>
                                <div class="col-md-9">
                                    <a href="{{asset('storage/AcceptanceForms/'.$reportData[0]->acceptance_report_name)}}" target="_blank">
                                        <strong>
                                            {{ $reportData[0]->reportName }}
                                        </strong>
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 head-detail">
                                    <p>Report Status</p>
                                </div>
                                <div class="col-md-9">
                                    @if ($reportData[0]->status === 'Pending')
                                        <strong class="">
                                            {{$reportData[0]->status}}
                                        </strong>
                                    @elseif ($reportData[0]->status === 'Accepted')
                                        <strong class="text-success">
                                            {{$reportData[0]->status}}
                                        </strong>
                                    @else
                                        <strong class="text-danger">
                                            {{$reportData[0]->status}}
                                        </strong>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 head-detail">
                                    <p>Last Modified</p>
                                </div>
                                <div class="col-md-9">
                                    <strong>
                                        {{$reportData[0]->updated_at}}
                                    </strong>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 head-detail">
                                    <p>Last Modified</p>
                                </div>
                                <div class="col-md-9">
                                    <strong>
                                        {{$reportData[0]->updated_at}}
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 head-detail">
                                    <p>Change Status</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <form action="/{{$reportData[0]->id}}/update_accept_status" method="POST" style="width: 100%;">
                                            {{ csrf_field() }}
                                            <div class="col-md-5">
                                                <div class="position-relative form-check" style="width: 100%;">
                                                    <label class="form-check-label" style="width: 100%;">
                                                        <select id="report-status" class="form-control" name="status" style="width: 100% !important;">
                                                            @if ($reportData[0]->status === 'Pending')
                                                                <option value="Pending" class="Pending" selected>Pending</option>
                                                                <option value="Accepted" class="Accepted">Accepted</option>
                                                                <option value="Rejected" class="Rejected">Rejected</option>
                                                            @elseif ($reportData[0]->status === 'Accepted')
                                                                <option value="Pending" class="Pending">Pending</option>
                                                                <option value="Accepted" class="Accepted" selected>Accepted</option>
                                                                <option value="Rejected" class="Rejected">Rejected</option>
                                                            @else
                                                                <option value="Pending" class="Pending">Pending</option>
                                                                <option value="Accepted" class="Accepted">Accepted</option>
                                                                <option value="Rejected" class="Rejected" selected>Rejected</option>
                                                            @endif
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <button type="submit" id="submitDetails" class="mt-1 btn btn-primary btn-app">Update Status</button>
                                                <button type="reset" id="resetDetails" class="mt-1 btn btn-success btn-app">Reset</button>
                                            </div>
                                        </form>
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
    <script src="{{ asset('assets/scripts/site_reports.js') }}"></script>
@endpush