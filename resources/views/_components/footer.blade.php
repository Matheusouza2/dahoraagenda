<div class="footer-nav-area" id="footerNav">
    <div class="container px-0">
        <!-- Footer Content -->
        <div class="footer-nav position-relative shadow-sm footer-style-two">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li>
                    <a class="{{ Request::is('cliente/inicio') ? 'text-primary' : '' }}"
                        href="{{ session('owner') == true ? route('home_barber') : route('home_client') }}">
                        <i class="bi bi-house"></i>
                    </a>
                </li>

                <li>
                    <a class="{{ Request::is('cliente/atendimentos') ? 'text-primary' : '' }}"
                        href="{{ route('services_client') }}">
                        <i class="bi bi-collection"></i>
                    </a>
                </li>

                <li class="active">
                    <a href="{{ route('schedule_client') }}">
                        <i class="bi bi-plus-circle-fill"></i>
                    </a>
                </li>

                <li>
                    <a class="{{ Request::is('barbearias') ? 'text-primary' : '' }}"
                        href="{{ route('barber_shop_list') }}">
                        <i class="fa-light fa-scissors"></i>
                    </a>
                </li>

                <li>
                    <a class="{{ Request::is('configuracoes') ? 'text-primary' : '' }}" href="{{ route('settings') }}">
                        <i class="bi bi-gear"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
