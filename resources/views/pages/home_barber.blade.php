@extends('_components.template')

@section('title', 'Início')

@section('body')

    @include('_components.header')

    @include('_components.sidebar')

    <div class="page-content-wrapper">

        <div class="pt-3"></div>

        <div class="container">
            <div class="card bg-primary mb-3 bg-img" style="background-image: url('img/core-img/1.png')">
                <div class="card-body direction-rtl p-4">
                    <h2 class="text-white">Bem-vindo</h2>
                    <p class="mb-4 text-white">
                        Faça melhor gestão do seu tempo agendando sempre seus atendimentos no seu barbeiro ou salão pelo
                        <strong>DahoraAgenda</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/star.png" alt="">
                                </div>
                                <p class="mb-0">Best Rated</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/elegant.png" alt="">
                                </div>
                                <p class="mb-0">Elegant</p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="img/demo-img/lightning.png" alt="">
                                </div>
                                <p class="mb-0">Trendsetter</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title">Últimos 5 agendamentos</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card single-product-card bg-gray">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="card-side-img">
                                            <!-- Product Thumbnail -->
                                            <a class="product-thumbnail d-block" href="shop-details.html">
                                                <img src="img/bg-img/p1.jpg" alt="">
                                            </a>
                                        </div>

                                        <div class="card-content px-4 py-2">
                                            <p class="product-title d-block text-truncate mt-0">Nome do salão</p>
                                            <p class="d-block text-truncate m-0">Profissional</p>
                                            <p class="d-block text-truncate m-0">Serviço</p>
                                            <p class="sale-price">Valor (R$)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_components.footer')
@stop
