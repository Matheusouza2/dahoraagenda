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

            <!-- Register Form -->
            <div class="register-form mt-4">
                <h6 class="mb-3 text-center">Informe seus dados para cadastro</h6>

                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" id="name" name="name" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <input class="form-control" id="username" name="phone" type="tel" placeholder="Telefone">
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    @error('phone')
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
