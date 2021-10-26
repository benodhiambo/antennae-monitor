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
                        <h5 class="content-detail-title">EDIT USER - {{$myDetails[0]->name}}</h5>

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
                        <form action="/{{ $myDetails[0]->id }}/updateUser" method="POST">
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
                            <input placeholder="Full Names" value="{{ $myDetails[0]->name }}" name="name" type="text" class="form-control input-field form-control-m">
                            </div>
                            <br />
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-mail"></i>
                                    </span>
                                </div>
                                <input placeholder="Email Address" value="{{ $myDetails[0]->email }}" name="email" type="text" class="form-control input-field form-control-m">
                            </div>
                            <br />
                            <div class="input-group col-md-8">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Account Status</h6>
                                        </div>
                                        <div class="col-md-9">
                                            <fieldset class="position-relative form-group">
                                                <div class="position-relative form-check">
                                                    <label class="form-check-label">
                                                        <input name="status" value="1" type="radio" class="form-check-input" required <?php echo ($myDetails[0]->status == 1) ? 'checked="checked"' : ''; ?>> 
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="position-relative form-check">
                                                    <label class="form-check-label">
                                                        <input name="status" value="0" type="radio" class="form-check-input" <?php echo ($myDetails[0]->status == 0) ? 'checked="checked"' : ''; ?> > 
                                                        Disabled
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-phone"></i>
                                    </span>
                                </div>
                                <input placeholder="Cell Phone" value="{{ $myDetails[0]->phone }}" name="phone" type="number" class="form-control input-field form-control-m">
                            </div>
                            <br>
                        </div>
                        <hr />

                        <!-- HIDDEN INPUT FOR ROLE -->
                        <input type="hidden" name="user_id" value="{{ $myDetails[0]->id }}">
                        <button class="mt-1 btn btn-primary btn-app">Submit</button>
                    </form>
                    </div>
            </div>
        </div>
</div>
@endsection