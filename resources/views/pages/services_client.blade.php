@extends('_components.template')

@section('title', 'Atendimentos')

@section('body')

    @include('_components.header_2', ['title' => 'Lista de atendimentos'])

    @include('_components.sidebar')

    <div class="page-content-wrapper py-3">

        <!-- Pagination-->
        <div class="shop-pagination pb-3">
            <div class="container">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="input-group search-input">
                            <input type="text" placeholder="Filtrar atendimentos" class="form-control style-1 main-in">
                            <a href="javascript:void(0);" class="btn-clos">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products-->
        <div class="top-products-area product-list-wrap">
            <div class="container">
                <div class="row g-3 agendamento-lista placeholder-glow">

                    <div class="col-12">
                        <div class="card single-product-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-side-img">
                                        <!-- Product Thumbnail -->
                                        <a class="product-thumbnail d-block" href="shop-details.html">
                                            <img src="{{ asset('images/barber/barber_shop.svg') }}" alt="">
                                        </a>
                                    </div>

                                    <div class="card-content px-4 py-2">
                                        <!-- Product Title -->
                                        <a class="product-title d-block text-truncate mt-0 placeholder"
                                            href="shop-details.html">Wooden
                                            Tool</a>
                                        <!-- Product Price -->
                                        <p class="sale-price placeholder">$9.89 $13.42 </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card single-product-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-side-img">
                                        <!-- Product Thumbnail -->
                                        <a class="product-thumbnail d-block" href="shop-details.html">
                                            <img src="{{ asset('images/barber/barber_shop.svg') }}" alt="">
                                        </a>
                                    </div>

                                    <div class="card-content px-4 py-2">
                                        <!-- Product Title -->
                                        <a class="product-title d-block text-truncate mt-0 placeholder"
                                            href="shop-details.html">Wooden
                                            Tool</a>
                                        <!-- Product Price -->
                                        <p class="sale-price placeholder">$9.89 $13.42 </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card single-product-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-side-img">
                                        <!-- Product Thumbnail -->
                                        <a class="product-thumbnail d-block" href="shop-details.html">
                                            <img src="{{ asset('images/barber/barber_shop.svg') }}" alt="">
                                        </a>
                                    </div>

                                    <div class="card-content px-4 py-2">
                                        <!-- Product Title -->
                                        <a class="product-title d-block text-truncate mt-0 placeholder"
                                            href="shop-details.html">Wooden
                                            Tool</a>
                                        <!-- Product Price -->
                                        <p class="sale-price placeholder">$9.89 $13.42 </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination-->
        <div class="shop-pagination pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary btn-carregar-infos" onclick="carregarInfos()">Carregar
                            mais...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_components.footer')
@stop

@section('script')
    <script>
        let page = 1;

        const carregarInfos = () => {
            $.ajax({
                url: `${API_URL}/schedule/list?page=${page}`,
                method: "GET",
                beforeSend: () => {
                    $(".btn-carregar-infos").html(
                        "<i class='fa-solid fa-spinner-third fa-spin'></i>"
                    );
                },
                success: (data) => {
                    $(".btn-carregar-infos").html("Carregar mais...");

                    if (data.schedules.data.length == 0) {
                        Toast.fire({
                            text: "Nenhum outro atendimento encontrado",
                            icon: "warning",
                        });
                        return false;
                    }

                    if (page == 1) {
                        $(".agendamento-lista").html("");
                        $(".agendamento-lista").removeClass("placeholder-wave");
                    }

                    ++page;

                    data.schedules.data.forEach((element) => {
                        $(".agendamento-lista").append(
                            `<div class="col-12">
                                <div class="card single-product-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="card-side-img">
                                                <!-- Product Thumbnail -->
                                                <a class="product-thumbnail d-block" href="shop-details.html">
                                                    <img src="${element.logo}" alt="">
                                                </a>
                                            </div>

                                            <div class="card-content px-4 py-2">
                                                <!-- Product Title -->
                                                <a class="product-title d-block text-truncate mt-0"
                                                    href="shop-details.html">${element.barber_shop}</a>
                                                <!-- Product Price -->
                                                <p class="sale-price">Profissional: ${element.name} </p>
                                                <p class="fs--1">Data: ${moment(`${element.date} ${element.hour}`).format('D/MM/Y h:mm')} </p>
                                                <p class="fs--2">Status: ${element.description} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        );
                    });

                }
            }).done(function() {
                var $rows = $(".agendamento-lista");
                $(".main-in").on("keyup", function() {
                    var val = this.value.trim();
                    if (val === "") $rows.show();
                    else {
                        $rows.hide();
                        $rows.has("div:icontains(" + val + ")").show();
                    }
                });
            });
        }

        carregarInfos();
    </script>
@stop
