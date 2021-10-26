@extends('layouts.main')

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
                        <h5 class="content-detail-title">Add User</h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/users';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                All Users
                            </button>
                            <button onclick="window.location.href = '/register_contractor';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add Contractor
                            </button>
                            <button onclick="window.location.href = '/register_team';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add Team
                            </button>
                            <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Back
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        <form action="/register" method="POST">
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
                                <input placeholder="Full Names" name="name" type="text" class="form-control input-field form-control-m">
                            </div>
                            <br />
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-mail"></i>
                                    </span>
                                </div>
                                <input placeholder="Email" name="email" type="text" class="form-control input-field form-control-m">
                            </div>
                            <br />
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-phone"></i>
                                    </span>
                                </div>
                                <input placeholder="Cell Number" name="phone" type="number" class="form-control input-field form-control-m">
                            </div>
                            <br>
                        </div>
                        <hr />

                        <!-- HIDDEN INPUT FOR ROLE -->
                        <input type="hidden" name="role_id" value="1">
                        <button class="mt-1 btn btn-primary btn-app">Submit</button>
                    </form>
                    </div>
            </div>
        </div>
</div>
@endsection