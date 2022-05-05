@extends('main')
@section('content')

@if (Session::has('message'))
{{Session::get('message')}}
@endif

@if (Session::has('warning'))
{{Session::get('warning')}}
@endif
<div id="app">
    <recent-api />
</div>

<form action="/addCompany" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <div>
        <h6 for="name">Name</h6>
        <input type="text" name="name" value="{{old('name')}}"></input>
    </div>
    @error('name')
        {{$message}}
    @enderror
    <div>
        <h6 for="email">Email</h6>
        <input type="text" name="email" value="{{old('email')}}"></input>
    </div>
    @error('email')
        {{$message}}
    @enderror
    <div>
        <h6 for="address">Address</h6>
        <input type="text" name="address" value="{{old('address')}}"></input>
    </div>
    @error('address')
        {{$message}}
    @enderror
    <div>
        <h6 for="logo">Logo</h6>
        <input type="file" name="logo">
    </div>
    @error('logo')
        {{$message}}
    @enderror
    <div>
        <button type="submit">Create</button>
    </div>
</form>

<a href="logout">Logout</a>

@if (count($companies) > 0)
<table>
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
        <tr>
            @if ($company->logo != null)
            <td><img src="{{asset('/storage/'.$company->logo)}}" width="60"></td>
            @else
            <td><img src="{{asset('/storage/placeholder/placeholder.png')}}" width="60"></td>
            @endif
            <td>{{$company->name}}</td>
            <td>{{$company->email}}</td>
            <td>{{$company->address != null ? $company->address : "No address specified"}}</td>
            <td><a href="/edit/{{$company->id}}">Edit</a></td>
            <td>
                <form action="/delete/{{$company->id}}" method="POST">
                    @method('delete')
                    {{csrf_field()}}
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>You have no created companies</p>
@endif


@endsection