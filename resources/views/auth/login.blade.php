@extends('auth.head')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card shadow p-3">   
                <h3 class="text-center">Login</h3>
                <div class="text-center mb-3">
                    <small>Enter your email & password to login</small>
                </div>
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email')? is-invalid @enderror" id="email" name="email">
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password')? is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <div class="text-danger">{{$message}}</div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="d-flex mt-2">
                    <div class="">
                        <p class="">
                            <small>Don't have account? 
                                <a href="{{ url('register') }}">Register</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
