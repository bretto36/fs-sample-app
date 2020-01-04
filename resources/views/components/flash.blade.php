@if (Session::has('success'))
    <div class="my-4 alert alert-success" role="alert">
        <span class="alert-text">
            {!! Session::get('success') !!}
        </span>
    </div>
@elseif (Session::has('error'))
    {!! Session::get('error ') !!}
@endif
