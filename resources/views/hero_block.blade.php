@extends('_components.template')

@section('title', 'Inicio')

@section('body')
    <!-- Hero Block Wrapper -->
    <div class="hero-block-wrapper" style="background: #823b00">
        <!-- Styles -->
        <div class="hero-block-styles">
            <div class="hb-styles1" style="background-image: url('img/core-img/dot.png')"></div>
            <div class="hb-styles2"></div>
            <div class="hb-styles3"></div>
        </div>

        <div class="custom-container">
            <!-- Hero Block Content -->
            <div class="hero-block-content">
                <img class="mb-4" src="{{ asset('images/hero.svg') }}" alt="">
                <h2 class="display-4 text-white mb-3">Facilitando sua vida.</h2>
                <p class="text-white">Agende com seu barbeiro um horário de forma rápida e ágil.</p>
                <a class="btn btn-warning btn-lg w-100 mb-3" href="{{ route('login.client') }}">Cliente</a>
                <a class="btn btn-warning btn-lg w-100" href="{{ route('login.profissional') }}">Profissional</a>
            </div>
        </div>
    </div>
@stop
