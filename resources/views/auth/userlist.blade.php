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
                <h3>SYSTEM - <small>User Management</small></h3>
            </div>

            <hr class="page-title-hr" />
            <div class="main-card mb-3 card">
                 <div class="card-body card-body-m">
                        <h5 class="content-detail-title">User List</h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/users/add';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add User
                            </button>
                            <button onclick="window.location.href = '/contractors';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Contractors
                            </button>
                            <button onclick="window.location.href = '/teams';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Teams
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        
                        <table id="userlist_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><a href="/{{ $user->id }}/profile"> {{ $user->name}} </a> </td>
                                        @foreach ($roles as $role)
                                            @if ($user->role_id == $role->id)
                                                <td> {{ $role->role_name}} </td>
                                            @endif
                                        @endforeach
                                        <td> {{ $user->phone}} </td>
                                        <td> {{ $user->email}} </td>
                                        <td>
                                            <?php 
                                                if ($user->status == 1) {
                                                    echo 'Active';
                                                } else {
                                                    echo 'Disabled';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
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