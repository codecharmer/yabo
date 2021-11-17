@php $class = 'danger';
if ($message = Session::get('error')):
    $class = 'danger';
elseif ($message = Session::get('warning')):
    $class = 'warning';
elseif ($message = Session::get('success')):
    $class = 'success';
elseif ($message = Session::get('info')):
    $class = 'info';
endif; @endphp

@if ($errors->any() || $message)
    <div class="w-25 w-md-50 position-fixed" style="top: 2%; right: 1%; z-index: 9999">
        <div class="alert alert-{{ $class }} alert-dismissible shadow fade show p-4 rounded-3" role="alert">
            <h4 class="alert-heading mb-3">@if ($errors->any())Something went wrong @else {{ $message }} @endif</h4>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
