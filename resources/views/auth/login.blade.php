@extends('layouts.auth-master')



@section('content')

<div class="card card-info">

  <div class="card-header"><h4>Login</h4></div>



  <div class="card-body">

    <form method="POST" action="{{route('masuk')}}">

        @csrf

      <div class="form-group">

        <label for="email">Username / Email / No. HP</label>

        <input aria-describedby="emailHelpBlock" id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Your account registered" tabindex="1" value="{{ old('email') }}" autofocus>

        <div class="invalid-feedback">

          {{ $errors->first('email') }}

        </div>

      </div>



      <div class="form-group">

        <div class="d-block">

            <label for="password" class="control-label">Password</label>

          <div class="float-right">

            <a href="{{ route('password.request') }}" class="text-small">

              Forgot Password?

            </a>

          </div>

        </div>

        <input aria-describedby="passwordHelpBlock" id="password" type="password" placeholder="Your account password" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2">

        <div class="invalid-feedback">

          {{ $errors->first('password') }}

        </div>

      </div>



      <div class="form-group">

        <div class="custom-control custom-checkbox">

          <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember"{{ old('remember') ? ' checked': '' }}>

          <label class="custom-control-label" for="remember">Remember Me</label>

        </div>

      </div>



      <div class="form-group">

        <button type="submit" class="btn btn-info btn-lg btn-block" tabindex="4">

          Login

        </button>

      </div>

    </form>

  </div>

</div>

<div class="mt-5 text-muted text-center">

  Don't have an account? <a href="https://smsbersama.id/register">Create One</a>

</div>

@endsection

