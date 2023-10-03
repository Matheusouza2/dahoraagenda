<!-- Header Area-->
<div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content-->
        <div
            class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
            <!-- Back Button-->
            <div class="back-button">
                <a href="{{ URL::previous() }}">
                    <i class="bi bi-arrow-left-short"></i>
                </a>
            </div>

            <!-- Page Title-->
            <div class="page-heading">
                <h6 class="mb-0">{{ $title }}</h6>
            </div>

            <!-- Navbar Toggler-->
            <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
                data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                <span class="d-block"></span>
                <span class="d-block"></span>
                <span class="d-block"></span>
            </div>
        </div>
    </div>
</div>
