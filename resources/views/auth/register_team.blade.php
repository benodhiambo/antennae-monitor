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
                        <h5 class="content-detail-title">Add Team</h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/teams';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Teams
                            </button>
                            <button onclick="window.location.href = '/contractors';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Contractors
                            </button>
                            <button onclick="window.location.href = '/users';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Users
                            </button>
                            <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Back
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        <form action="{{url('/teams/add')}}" method="POST">
                            @csrf
                        <div>
                            @if ($errors->any())
                                <h6><span class="text-danger">{{ $errors }}</span></h6>
                            @endif
                                <div class="input-group col-md-8">
                                    <label class="form-check-label" style="width: 100%;">
                                        <select class="form-control" id="contractors" name="contractor_id" style="width: 100%!;">
                                            <option value="" selected>Choose Contractor</option>
                                            @foreach ($cons as $con)
                                                <option value=" {{ $con->id }} "> {{ $con->contractor_name }} </option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <br />
                        </div>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-user"></i>
                                    </span>
                                </div>
                                <input placeholder="Team Name" 
                                       name="team_name" 
                                       class="form-control input-field form-control-m"
                                       pattern=".{3,100}" 
                                       type="text"   
                                       required 
                                       title="3 characters minimum">
                            </div>
                            <br />

                        <hr />

                        <button class="mt-1 btn btn-primary btn-app">Submit</button>
                        <input class="btn btn-primary" type="reset" value="Clear Form">
                    </form>
                    </div>
            </div>
        </div>
</div>
@endsection