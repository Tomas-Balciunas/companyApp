@if (Session::has('message'))
<div class="alert alert-success alert-dismissible fixed-bottom mb-0 text-center" role="alert">
    {{Session::get('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('warning'))
<div class="alert alert-danger alert-dismissible fixed-bottom mb-0 text-center" role="alert">
    {{Session::get('warning')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif