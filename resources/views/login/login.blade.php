@extends('_components.template')

@section('title', 'Login')

@section('body')

    <!-- Back Button -->
    @if (!Request::is('/'))
        <div class="login-back-button">
            <a href="{{ URL::previous() }}">
                <i class="bi bi-arrow-left-short"></i>
            </a>
        </div>
    @endif

    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="custom-container">
            <div class="text-center px-4">
                <img class="login-intro-img" src="{{ asset('images/login.svg') }}" alt="">
            </div>

            @if (Request::is('entrar/cliente'))
                @include('login._client')
            @else
                @include('login._profissional')
            @endif
        </div>
    </div>
@stop

@section('script')
    @error('login')
        <script>
            Swal.fire({
                text: "{{ $message }}",
                icon: 'error'
            })
        </script>
    @enderror
    <script>
        $('#username').mask(SPMaskBehavior, spOptions);
    </script>
@endsection
