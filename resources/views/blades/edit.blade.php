@extends('main')
@section('content')

<div class="container mt-5 mb-5">
    <form action="/update/{{$company->id}}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        {{method_field('PATCH')}}

        <div class="row">
            <h3 class="text-center font-weight-bold">Edit company {{$company->name}}</h3>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{$company->name}}"></input>
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$company->email}}"></input>
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="text" class="form-control" placeholder="Address" name="address" value="{{$company->address}}"></input>
                @error('address')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2 mb-2 d-flex justify-content-center">
            <div class="col-xl-6 col-md">
                <input type="file" class="form-control" name="logo">
                @error('logo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <span class="m-2" for="checked">Remove logo:</span>
            <input type="checkbox" name="checked">
        </div>

        <div class="row mt-3 mb-2 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-success col-auto">Update</button>
        </div>

        <div class="row mt-3 mb-2 d-flex justify-content-center">
            <a href="/" class="btn btn-outline-warning col-auto">Home</a>
        </div>
    </form>
</div>
@endsection