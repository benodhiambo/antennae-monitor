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
                <h3>SYSTEM - <small>Role Management</small></h3>
            </div>

            <hr class="page-title-hr" />
            <div class="main-card mb-3 card">
                 <div class="card-body card-body-m">
                        <h5 class="content-detail-title">Roles</h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/add_role';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add Role
                            </button>
                            <button onclick="window.location.href = '/users';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Users
                            </button>
                            <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Back
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        
                        <table id="roleslist_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td><a href="/{{$role->id}}/edit_role"> {{ $role->role_name}} </a></td>
                                        <td> {{ $role->created_at}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Date Created</th>
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
    <script src="{{ asset('assets/scripts/roleslist.js') }}"></script>
@endpush