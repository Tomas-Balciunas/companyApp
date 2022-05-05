@if (Session::has('message'))
<div class="alert alert-success fixed-bottom mb-0 text-center" role="alert">
    {{Session::get('message')}}
</div>
@endif

@if (Session::has('warning'))
<div class="alert alert-danger fixed-bottom mb-0 text-center" role="alert">
    {{Session::get('warning')}}
</div>
@endif