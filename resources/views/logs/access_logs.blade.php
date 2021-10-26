@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}"/>
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}"/>
@endpush

@section('content-detail')
    <div class="row scroll-area-x">
        <div class="col-md-12 col-lg-12 scrollbar-container">
            <div class="main-card mb-3 card main-card-m">
                <div class="page-title-heading page-title-heading-m">
                    <h3>System Logs</h3>
                </div>

                <hr class="page-title-hr"/>
                <div class="main-card mb-3 card">
                    <div class="card-body card-body-m">
                        <h5 class="content-detail-title">Access Logs</h5>


                        <hr class="page-subtitle-hr"/>

                        <table id="userlist_table"
                               class="display table table-striped table-border row-border table-hover table-sm nowrap"
                               style="width:100%">
                            <thead>
                            <tr>

                                <th>IP</th>
                                <th>Description</th>
                                <th>Result</th>
                                <th>UserID</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($accessLogs as $log)
                                <tr>
                                    @php
                                        if( !filter_var($log->ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) )
                                        {
                                        echo "<td>local machine </td>";
                                        }
                                        else
                                        {
                                        echo "<td>{{$log->ip}} </td>";
                                        }
                                    @endphp
                                    <td> {{ $log->description}} </td>
                                    <td> {{ $log->result}} </td>
                                    <td> {{ $log->user_id}} </td>
                                    <td> {{ $log->created_at}} </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>IP</th>
                                <th>Description</th>
                                <th>Result</th>
                                <th>UserID</th>
                                <th>Time</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @push('app-scripts')
            <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
        @endpush

        @push('page-scripts')
            <script src="{{ asset('assets/scripts/userlist.js') }}"></script>
    @endpush