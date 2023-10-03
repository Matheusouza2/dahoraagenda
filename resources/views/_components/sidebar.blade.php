<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
    aria-labelledby="affanOffcanvsLabel">

    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
        aria-label="Close"></button>

    <div class="offcanvas-body p-0">
        <div class="sidenav-wrapper">
            <!-- Sidenav Profile -->
            <div class="sidenav-profile bg-gradient">
                <div class="sidenav-style1"></div>

                <!-- User Thumbnail -->
                <div class="user-profile">
                    <img src="{{ asset('images/avatar.svg') }}" alt="">
                </div>

                <!-- User Info -->
                <div class="user-info">
                    <h6 class="user-name mb-0">{{ Auth::user()->name }}</h6>
                </div>
            </div>

            <!-- Sidenav Nav -->
            <ul class="sidenav-nav ps-0">
                <li>
                    <a href="{{ route('home_client') }}"><i class="bi bi-house-door"></i> Início</a>
                </li>
                <li>
                    <a href="{{ route('services_client') }}"><i class="bi bi-collection"></i> Lista de Atendimentos</a>
                </li>
                <li>
                    <a href="{{ route('barber_shop_list') }}"><i class="fa-light fa-scissors"></i> Lista de
                        barbearias</a>
                </li>
                <li>
                    <a href="{{ route('settings') }}"><i class="bi bi-gear"></i> Configurações</a>
                </li>
                <li>
                    <div class="night-mode-nav">
                        <i class="bi bi-moon"></i> Modo escuro
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                        </div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> Sair</a>
                </li>
            </ul>

            <!-- Copyright Info -->
            <div class="copyright-info">
                <p>
                    <span id="copyrightYear">2023</span>
                    © DahoraAgenda
                </p>
            </div>
        </div>
    </div>
</div>
