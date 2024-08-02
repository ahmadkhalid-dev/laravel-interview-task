@extends('auth.head')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card shadow p-3">   
                <h3 class="text-center">Register</h3>
                <div class="text-center mb-3">
                    <small>Enter following details to register</small>
                </div>
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name')? is-invalid @enderror" id="name" name="name">
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation')? is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="text-danger">{{$message}}</div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <div class="d-flex mt-2">
                    <div class="">
                        <p class="">
                            <small>Already have an account?
                                <a href="{{ url('login') }}">Login</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
