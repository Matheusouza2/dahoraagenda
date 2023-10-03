@extends('_components.template')

@section('title', 'Configurações')

@section('body')

    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="dark-mode-text text-center">
                <i class="bi bi-moon"></i>
                <p class="mb-0">Switching to dark mode</p>
            </div>
            <div class="light-mode-text text-center">
                <i class="bi bi-brightness-high"></i>
                <p class="mb-0">Switching to light mode</p>
            </div>
        </div>
    </div>

    <!-- RTL mode switching -->
    <div class="rtl-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="rtl-mode-text text-center">
                <i class="bi bi-text-right"></i>
                <p class="mb-0">Switching to RTL mode</p>
            </div>
            <div class="ltr-mode-text text-center">
                <i class="bi bi-text-left"></i>
                <p class="mb-0">Switching to default mode</p>
            </div>
        </div>
    </div>

    @include('_components.header_2', ['title' => 'Configurações'])

    @include('_components.sidebar')

    <div class="page-content-wrapper py-3">
        <div class="container">
            <!-- Setting Card-->
            <div class="card mb-3 shadow-sm">
                <div class="card-body direction-rtl">
                    <p class="mb-2">Configurações</p>

                    <div class="single-setting-panel">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2" checked>
                            <label class="form-check-label" for="flexSwitchCheckDefault2">Enviar notificações</label>
                        </div>
                    </div>

                    <div class="single-setting-panel">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="darkSwitch" name="darkSwitch">
                            <label class="form-check-label" for="darkSwitch">Modo escuro</label>
                        </div>
                    </div>

                    <div class="single-setting-panel">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rtlSwitch">
                            <label class="form-check-label" for="rtlSwitch">Modo RTL</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Setting Card-->
            <div class="card mb-3 shadow-sm">
                <div class="card-body direction-rtl">
                    <p class="mb-2">Conta</p>

                    <div class="single-setting-panel">
                        <a href="user-profile.html">
                            <div class="icon-wrapper">
                                <i class="bi bi-person"></i>
                            </div>
                            Alterar Perfil
                        </a>
                    </div>

                    <div class="single-setting-panel">
                        <a href="change-password.html">
                            <div class="icon-wrapper bg-info">
                                <i class="bi bi-lock"></i>
                            </div>
                            Modificar Senha
                        </a>
                    </div>

                    <div class="single-setting-panel">
                        <a href="privacy-policy.html">
                            <div class="icon-wrapper bg-danger">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            Política de privacidade
                        </a>
                    </div>
                </div>
            </div>

            <!-- Setting Card-->
            <div class="card shadow-sm">
                <div class="card-body direction-rtl">
                    <p class="mb-2">Logout</p>

                    <div class="single-setting-panel">
                        <a href="login.html">
                            <div class="icon-wrapper bg-danger">
                                <i class="bi bi-box-arrow-right"></i>
                            </div>
                            Sair
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_components.footer')
@stop
