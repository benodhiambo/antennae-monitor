<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Change Password | {{ config('app.name')}} </title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="atonga">

    <link href="{{ asset('assets/css/change_password.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/strengthify.min.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('assets/scripts/zxcvbn.js') }}"></script>
    <script src="{{ asset('assets/scripts/change_password.js') }}"></script>

</head>

<body>

<div class="login">
    <h1>change password</h1>
    <form action="{{url('login')}}" method="post" autocomplete="off">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-8">
                <div class="row" style="width:100%" >
                    <div class="input-group col-md-7">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-icon">
                                <i class="metismenu-icon pe-7s-key"></i>
                            </span>
                        </div>
                        <input placeholder="New Password"
                                 name="password"
                                        id="password"
                                        class="form-control input-field form-control-m passwords"
                                        type="password"
                                        autocomplete="off"
                                        title="8 characters minimum"/>
                                        <br>
                                        <meter max="4" id="password-strength-meter"></meter>
                        <p id="password-strength-text" align="left"></p>
                    </div>
                    <div class="col-md-5">
                        
                    </div>
                </div>
                
            </div>
            <br>
            <div class="input-group col-md-8">
                <div class="input-group-prepend">
                    <span class="input-group-text input-icon">
                        <i class="metismenu-icon pe-7s-key"></i>
                    </span>
                </div>
                <input placeholder="Confirm Password"
                         name="password"
                                id="confirmPassword"
                                class="form-control input-field form-control-m passwords"
                                type="password"
                                autocomplete="off"
                                title="8 characters minimum"/>
            </div>
            <br>
            <div>
                <span id="confirmMessage" class="confirm-message"></span>
            </div>
        </div>

        <button type="submit" id="submitDetails" class="btn btn-primary btn-block btn-large">SUBMIT</button>
    </form>
</div>

</body>

</html>