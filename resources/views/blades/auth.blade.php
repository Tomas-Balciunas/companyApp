@extends('main')
@section('content')

<div class="container mt-5 mb-5">
    <form action="/login" method="post">
        {{csrf_field()}}

        <div class="row">
            <h3 class="text-center font-weight-bold">Log in</h3>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="text" value="{{old('user_email')}}" name="user_email" placeholder="Email" class="form-control"></input>
                @error('user_email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="password" name="password" placeholder="Password" class="form-control"></input>
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-3 mb-2 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-success col-auto">Login</button>
        </div>
    </form>
</div>

<div class="container mt-5 mb-5">
    <form action="/register" method="post">
        {{csrf_field()}}

        <div class="row">
            <h3 class="text-center font-weight-bold">Create an account</h3>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="text" value="{{old('username')}}" name="username" placeholder="Name" class="form-control"></input>
                @error('username')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>


        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="text" value="{{old('email')}}" name="email" placeholder="Email" class="form-control"></input>
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>


        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="password" name="pass" placeholder="Password" class="form-control"></input>
                @error('pass')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-3 mb-2 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-success col-auto">Register</button>
        </div>
    </form>
</div>

<div id="app" class="d-flex justify-content-center">
    <recent-api />
</div>
@endsection