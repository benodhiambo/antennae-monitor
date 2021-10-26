@extends('layouts.main')

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
                        <h5 class="content-detail-title">
                            Update Role - {{ $roleData[0]->role_name }} 
                        </h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/roles';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                All Roles
                            </button>
                            <button onclick="window.location.href = '/users';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Users
                            </button>
                            <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Back
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        <form action="/{{$roleData[0]->id}}/edit_role" method="POST">
                            @csrf
                        <div>
                            @if ($errors->any())
                                <h6><span class="text-danger">{{ $errors }}</span></h6>
                            @endif

                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-user"></i>
                                    </span>
                                </div>
                                <input placeholder="Role Name" 
                                       name="role_name" 
                                       class="form-control input-field form-control-m"
                                       pattern=".{3,100}" 
                                       type="text" 
                                       value="{{$roleData[0]->role_name}}"     
                                       required 
                                       title="3 characters minimum" />
                            </div>
                            <br />
                        </div>
                        <hr />

                        <input type="hidden" name="role_id" value="{{ $roleData[0]->id }}">
                        <button class="mt-1 btn btn-primary btn-app">Update</button>
                        <input class="btn btn-primary" type="reset" value="Clear Form">
                    </form>
                    </div>
            </div>
        </div>
</div>
@endsection