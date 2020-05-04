<div>
@if(count($errors))
<div class="alert alert-danger alert-dismissible" role="alert">
    @foreach($errors as $error)
        @foreach($error as $error_item)
            <p>{{ $error_item }}</p>
        @endforeach
    @endforeach
</div>
@endif

@if($success != false )
    <div class="alert alert-success  alert-dismissible" role="alert">
        {{ $success }}
    </div>
@elseif(App\Classes\Session::has('success'))
    <div class="alert alert-success  alert-dismissible" role="alert">
        {{ App\Classes\Session::get('success') }}
    </div>
        {{ App\Classes\Session::remove('success') }}
@endif
</div>

