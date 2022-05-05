@extends('main')
@section('content')
<form action="/update/{{$company->id}}" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div>
        <h6 for="name">Name</h6>
        <input type="text" name="name" value="{{$company->name}}"></input>
    </div>
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
    <div>
        <h6 for="email">Email</h6>
        <input type="text" name="email" value="{{$company->email}}"></input>
    </div>
    @error('email')
        <span class="text-danger">{{$message}}</span>
    @enderror
    <div>
        <h6 for="address">Address</h6>
        <input type="text" name="address" value="{{$company->address}}"></input>
    </div>
    @error('address')
        <span class="text-danger">{{$message}}</span>
    @enderror
    <div>
        <h6 for="logo">Logo</h6>
        <input type="file" name="logo">
    </div>
    @error('logo')
        <span class="text-danger">{{$message}}</span>
    @enderror
    <div>
        <label for="checked">Remove logo</label>
        <input type="checkbox" name="checked">
    </div>
    <div>
        <button type="submit">Update</button>
    </div>
</form>
@endsection