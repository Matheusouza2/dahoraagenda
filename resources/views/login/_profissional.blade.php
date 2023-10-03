<!-- Register Form -->
<div class="register-form mt-4">
    <h6 class="mb-3 text-center">Faça login para continuar</h6>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" id="username" name="user" value="{{ old('user') }}" placeholder="Telefone">
        </div>

        <div class="form-group position-relative">
            <input class="form-control" id="psw-input" type="password" name="password" placeholder="Senha">
            <div class="position-absolute" id="password-visibility">
                <i class="bi bi-eye"></i>
                <i class="bi bi-eye-slash"></i>
            </div>
        </div>

        <button class="btn btn-primary w-100" type="submit">Entrar</button>
    </form>
</div>
