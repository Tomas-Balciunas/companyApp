@extends('main')
@section('content')

@if (Session::has('message'))
    {{Session::get('message')}}
@endif

@if (Session::has('warning'))
    {{Session::get('warning')}}
@endif

<form action="/login" method="post">
    {{csrf_field()}}
    <div>
        <h6 for="user_email">Email</h6>
        <input type="text" value="{{old('user_email')}}" name="user_email"></input>
    </div>
    <span>
        @error('user_email')
            {{$message}}
        @enderror
    </span>
    <div>
        <h6 for="password">Password</h6>
        <input type="password" name="password"></input>
    </div>
    <span>
        @error('password')
            {{$message}}
        @enderror
    </span>
    <div>
        <button type="submit">Login</button>
    </div>
</form>

<form action="/register" method="post">
    {{csrf_field()}}
    <div>
        <h6 for="username">Name</h6>
        <input type="text" value="{{old('username')}}" name="username"></input>
    </div>
    <span>
        @error('username')
            {{$message}}
        @enderror
    </span>
    <div>
        <h6 for="user_email">Email</h6>
        <input type="text" value="{{old('user_email')}}" name="user_email"></input>
    </div>
    <span>
        @error('user_email')
            {{$message}}
        @enderror
    </span>
    <div>
        <h6 for="password">Password</h6>
        <input type="password" name="password"></input>
    </div>
    <span>
        @error('password')
            {{$message}}
        @enderror
    </span>
    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection