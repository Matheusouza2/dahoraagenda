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
                        Tenha total controle do seu salão com o
                        <strong>DahoraAgenda</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        @foreach ($barberShopProfessional as $profissional)
                            <div class="col-4">
                                <div class="feature-card mx-auto text-center">
                                    <div class="card mx-auto bg-gray user-profile">
                                        <img src="{{ asset($profissional->profissionalForeign->photo) }}" alt="">
                                    </div>
                                    <p class="mb-0">{{ $profissional->profissionalForeign->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container direction-rtl">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title">Consultar Agendamentos</h6>
                    <div class="row g-3">
                        <div class="col-12 d-flex justify-content-center">
                            <div id="datetimepicker"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_components.footer')
@stop

@section('script')
    <script>
        let picker = new TempusDominus(document.getElementById('datetimepicker'), {
            display: {
                inline: true,
                components: {
                    clock: false,
                },
                theme: 'light'
            },
            restrictions: {
                minDate: moment().format("MM/DD/Y 00:00:00 a"),
                disabledDates: data.datesClosed
            }
        });
    </script>
@endsection
