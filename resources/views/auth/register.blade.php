{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}


<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="{{ asset('images/logo_ico.png') }}" type="image/x-icon" style="height: 50px;">
    <link rel="icon" href="{{ asset('images/logo_ico.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Room Finder</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-1"></div>
            <div class="col-md-6 col-sm-10">
                <div class="text-center">
                    <img src="{{asset('images/logo_main.png')}}" width="120px" alt="" class="pt-0">
                    <h5 class="gray">
                        Register for free !!
                    </h5>
                </div>

                @if ($errors->has('email'))
                <div class="card mx-auto mb-3 animated shake" id="errorlostpassword">
                    <div class="card-body alert alert-dismissible fade show">
                        <a href="#" class="close p-3 mt-2" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="gray"> <b>ERROR:</b> Invalid Email or password</span>
                    </div>
                </div>
                @endif


                <div class="form">
                    <div class="card mx-auto animated pulse" id="login-card">
                        <div class="card-body ">
                            <form class="custom-hover" action="{{ route('register') }}" method="POST">
                                @csrf

                                <div class="form-group">

                                    <label for="name" class="gray" style="padding-top: 0px">Name</label>
                                    <input id="name" type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group">

                                    <label for="email" class="gray">Email</label>

                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                {{--     ADDED SELECT OPTIONS      --}}
                                <div class="form-group">
                                    <label for="roles" class="gray">User Type</label>
                                    <select id="roles" name="role"
                                        class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                        <option value="" disabled selected>...select role</option>
                                        <option value="1">Room Owner</option>
                                        <option value="2">Room Seeker</option>
                                    </select>

                                    @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif

                                </div>


                                <div class="form-group input-group">

                                    <label for="password" class="gray d-block">Password</label>
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" style="width:81%" required>
                                    <div class="input-group-append" id="aaa" onclick="viewpass()">
                                        <span class="input-group-text form-control btn fa fa-eye fa-eye-slash"
                                            id="p_icon"></span>
                                    </div>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>


                                <div class="row">
                                    <div class="col-sm-8 form-group form-check">
                                        <input type="checkbox" class="form-check-input custom-checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label gray" for="remember">Remember Me</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-green float-right"
                                            onclick="anim()">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer text-center text-muted" style="font-size: 13px">By Registering you agree
                            to our policies
                            <span><a href="{{route('read_more')}}">Read More</a></span>
                        </div>
                    </div>
                </div>
                <p class="gray mt-3">
                    <ul class="text-center nodecorationlist p-0" style="list-style-type:none;">
                        <li>
                            <a class="gray" href="{{ url('/') }}" rel="noopener noreferrer">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Website
                            </a>
                        </li>
                    </ul>
            </div>
            <div class="col-md-3 col-sm-1"></div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script>
        //  === login ===============
    function viewpass() {
        var p = document.getElementById("password");
        if (p.type === "password") {
            p.type = "text";
        } else {
            p.type = "password";
        }
        $('#p_icon').toggleClass('fa-eye-slash');
    }
    </script>

</body>

</html>