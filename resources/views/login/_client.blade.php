<!-- Register Form -->
<div class="register-form mt-4">
    <h6 class="mb-3 text-center">Faça login para continuar</h6>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input class="form-control" type="tel" name="user" id="username" value="{{ old('user') }}"
                placeholder="Telefone" data-mask="(00) 0000-0000">
        </div>

        <button class="btn btn-primary w-100" type="submit">Entrar</button>
    </form>
</div>

<!-- Login Meta -->
<div class="login-meta-data text-center mt-4">
    <p class="mb-0">Não tem uma conta? <a class="stretched-link" href="{{ route('register') }}">Cadastre-se</a>
    </p>
</div>
