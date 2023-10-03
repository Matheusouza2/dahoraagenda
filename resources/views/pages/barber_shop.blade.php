@extends('_components.template')

@section('title', 'Barbearias')

@section('body')

    @include('_components.header_2', ['title' => 'Lista de barbearias'])

    @include('_components.sidebar')

    <div class="page-content-wrapper py-3">
        <div class="blog-wrapper direction-rtl">
            <div class="container">
                <div class="row g-3">

                    @foreach ($return as $key => $barbearia)
                        <!-- Single Blog Card -->
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="card position-relative shadow-sm">
                                <img class="card-img-top" src="{{ asset('images/barber/barber_shop.svg') }}" alt="">
                                <div class="card-body">
                                    <span
                                        class="badge {{ $barbearia['open'] ? 'bg-success' : 'bg-danger' }} rounded-pill mb-2 d-inline-block">
                                        {{ $barbearia['open'] ? 'Aberto' : 'Fechado' }}
                                    </span>
                                    <a class="blog-title d-block mb-3 text-dark"
                                        href="{{ route('schedule_client', [$barbearia['id']]) }}">
                                        {{ $barbearia['name'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('_components.footer')
@stop
