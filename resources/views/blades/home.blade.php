@extends('main')
@section('content')

<div id="app" class="d-flex justify-content-center">
    <recent-api />
</div>

<div class="container mt-5 mb-5">
    <form action="/addCompany" enctype="multipart/form-data" method="post">
        {{csrf_field()}}

        <div class="row">
            <h3 class="text-center font-weight-bold">Create company</h3>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-xl-6 col-md">
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}"></input>
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-xl-6 col-md">
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{old('email')}}"></input>
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-xl-6 col-md">
                <input type="text" class="form-control" placeholder="Address" name="address" value="{{old('address')}}"></input>
                @error('address')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-xl-6 col-md">
                <input type="file" class="form-control" name="logo">
                @error('logo')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-3 mb-2 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-success col-auto">Create</button>
        </div>
    </form>
</div>

<div class="container">
    @if (count($companies) > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="table-dark">
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    @if ($company->logo != null)
                    <td class="align-middle text-center"><img class="text-center logo" src="{{asset('/storage/'.$company->logo)}}"></td>
                    @else
                    <td class="align-middle text-center"><img class="text-center logo" src="{{asset('/storage/placeholder/placeholder.png')}}"></td>
                    @endif
                    <td class="align-middle col-4">{{$company->name}}</td>
                    <td class="align-middle">{{$company->email}}</td>
                    <td class="align-middle">{{$company->address != null ? $company->address : "No address specified"}}</td>
                    <td class="align-middle text-center"><a href="/edit/{{$company->id}}" class="btn btn-outline-primary col-auto">Edit</a></td>
                    <td class="align-middle text-center">
                        <form action="/delete/{{$company->id}}" method="POST">
                            @method('delete')
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-outline-danger col-auto">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$companies->links()}}
    </div>
    @else
    <h3 class="text-center">You have no created companies</h3>
    @endif
</div>

<div class="col d-flex justify-content-center mb-5 mt-5">
    <a href="logout" class="btn btn-outline-danger">Logout</a>
</div>

@endsection