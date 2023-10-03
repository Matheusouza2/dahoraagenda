@php
    use SertSoft\Laradations\Laradator;
@endphp
@extends('_components.template')

@section('title', 'Agendamentos')

@section('style')
    <link href="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/css/tempus-dominus.css" rel="stylesheet" />
@stop

@section('body')

    @include('_components.header')

    @include('_components.sidebar')

    <div class="page-content-wrapper py-3">
        <div class="wrapper">
            <div class="container">

                @if ($unset)
                    <div class="row">
                        <div class="col-12">
                            <div class="card btn-select-barber" data-barber-value="{{ $barberShop->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('images/barber/barber_shop.svg') }}" alt=""
                                                width="100px">
                                        </div>

                                        <div class="col-6">
                                            <h6 style="font-size: 11pt;">{{ $barberShop->name }}</h6>
                                            <small class="text-white"
                                                style="font-size: 9pt">{{ Laradator::laraMask('telefone', $barberShop->phone) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="title-bar">
                        <h6>1. Selecione a barbearia</h6>
                    </div>

                    <div class="input-group search-input">
                        <input type="text" placeholder="Filtrar atendimentos" class="form-control style-1 main-in">
                        <a href="javascript:void(0);" class="btn-clos">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>

                    <div class="swiper-btn-center-lr">
                        <div class="swiper-container tag-group mt-4 dz-swiper recomand-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($barberShop as $key => $value)
                                    <div class="swiper-slide {{ $key == 0 ? '' : 'ms-5' }}" style="width: 100px;">
                                        <a href="javascript:void(0)" class="btn p-0 btn-select-barber"
                                            data-barber-value="{{ $value->id }}">
                                            <div class="card user-info-card">
                                                <div class="card-body">
                                                    <div class="user-profile">
                                                        <img src="{{ asset('images/barber/barber_shop.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <h6 style="font-size: 10pt;">{{ $value->name }}</h6>
                                                    <small
                                                        style="font-size: 7pt">{{ Laradator::laraMask('telefone', $value->phone) }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row row-date" hidden>
                    <div class="title-bar mt-3" id="selectData">
                        <h6>2. Selecione a data</h6>
                    </div>


                    <div class="col-12 d-flex justify-content-center">
                        <div id="datetimepicker"></div>
                    </div>
                </div>

                <div class="row row-services" hidden>
                    <div class="title-bar mt-3" id="selectService">
                        <h6>3. Selecione o serviço</h6>
                    </div>

                    <div class="col-12">
                        <div class="row g-3 row-services-button">
                        </div>
                    </div>

                </div>

                <div class="row row-professional" hidden>
                    <div class="title-bar mt-3" id="selectPro">
                        <h6>4. Selecione o profissional</h6>
                    </div>

                    <div class="col-12">
                        <div class="row g-3 row-professional-button">
                        </div>
                    </div>

                </div>

                <div class="row row-hour" hidden>
                    <div class="title-bar mt-3" id="selectHour">
                        <h6>5. Selecione um horário</h6>
                    </div>

                    <div class="col-12">
                        <div class="row g-3 row-hour-button">
                        </div>
                    </div>

                </div>

                <div class="row row-schedule" hidden>
                    <div class="title-bar mt-3" id="saveButton">
                        <h6>Confirme as informações acima</h6>
                    </div>

                    <div class="col-12 text-center">
                        <button class="btn btn-success" onclick="save()">Agendar</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @include('_components.footer')
@stop

@section('script')
    <script>
        //Definição da variavel que será o calendario, e a data do calendario quando for selecionada
        let picker = null,
            dateGlobal = null;

        //Instancia o swiper de barbearias
        var swiperDefult = new Swiper(".dz-swiper", {
            speed: 500,
            parallax: true,
            slidesPerView: "auto",
            spaceBetween: 5,
            loop: false,
            navigation: {
                nextEl: ".swiper-btn-next",
                prevEl: ".swiper-btn-prev",
            },
            pagination: {
                el: ".swiper-defult-pagination",
                clickable: true,
            },
        });

        //Faz com que o input search funcione para filtrar as barbearias
        $(".search-input .form-control").on("change paste keyup", function() {
            if ($(this).val().length > 0) {
                $(".search-input .btn-clos").fadeIn(500);
            } else {
                $(".search-input .btn-clos").fadeOut(500);
            }
        });

        $(".search-input .btn-clos").on("click", function() {
            $(".search-input .form-control").val(null);
            $(this).fadeOut(0);
        });

        var $rows = $(".swiper-slide");
        $(".main-in").on("keyup", function() {
            var val = this.value.trim();
            if (val === "") $rows.show();
            else {
                $rows.hide();
                $rows.has("div:icontains(" + val + ")").show();
            }
        });


        //Ao Selecionar a barbearia consulta as datas de fechamento e os profissionais da barbearia
        $(".btn-select-barber").on('click', function() {
            $.ajax({
                url: `${API_URL}/schedule_close/consult/${$(this).attr("data-barber-value")}`,
                method: 'GET',
                beforeSend: () => {
                    modalShow("consulta");
                },
                success: (data) => {
                    $('html, body').animate({
                        scrollTop: $("#selectData").offset().top
                    }, 500);
                    modalHide();
                    $(".row-date").removeAttr('hidden');
                    $(".row-professional-button").html('');
                    $(".row-professional").attr('hidden', true);
                    $(".row-services-button").html('');
                    $(".row-services").attr('hidden', true);
                    $(".row-hour").attr('hidden', true);
                    $(".row-hour-button").html('');

                    if (picker != null) {
                        picker.hide();
                    }
                    picker = new TempusDominus(document.getElementById('datetimepicker'), {
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

                    data.services.forEach(element => {
                        $(".row-services-button").append(`
                            <div class="col-6">
                                <button class="btn btn-outline-primary rounded-pill" onclick="selectService(this)">
                                    ${element.description} - R$ ${element.value}
                                </button>
                            </div>
                        `);
                    });

                    data.professionals.forEach(element => {
                        $(".row-professional-button").append(`
                            <div class="col-4">
                                <button class="btn btn-outline-primary rounded-pill" data-barber-professional="${element.profissional}" onclick="consultHour(this)">
                                    ${element.name}
                                </button>
                            </div>
                        `);
                    });
                },
                error: (err) => {
                    modalHide();
                    errorTreat(err);
                }
            });
            $(".btn-select-barber").removeClass('bg-success');
            $(this).addClass("bg-success");
        });

        $("#datetimepicker").on('change.td', function(date) {
            $(".row-professional").attr('hidden', true);
            $('.row-schedule').attr('hidden', true);
            $(".row-hour").attr('hidden', true);
            $(".row-services").removeAttr('hidden');
            dateGlobal = moment(date.date).format("Y-MM-DD");
            $('html, body').animate({
                scrollTop: $("#selectService").offset().top
            }, 500);
        });

        const selectService = (element) => {
            $(".row-services-button .btn").removeClass('active');
            $(element).addClass('active');
            $(".row-professional").removeAttr('hidden');
            $('html, body').animate({
                scrollTop: $("#selectPro").offset().top
            }, 500);
        }

        const appointment = (hora, element) => {
            $('.row-schedule').removeAttr('hidden');
            $(".row-hour .btn").removeClass('active');
            $(element).addClass('active');

            $('html, body').animate({
                scrollTop: $("#saveButton").offset().top
            }, 500);
        }

        const save = () => {
            let barber = $(".bg-success").attr("data-barber-value");
            let hour = $(".row-hour-button .active").text().trim();
            let professional = $(".row-professional-button .active").attr('data-barber-professional');
            $.ajax({
                url: `${API_URL}/schedule/store`,
                data: {
                    barber_shop: barber,
                    barber: professional,
                    date: dateGlobal,
                    hour: hour
                },
                method: 'POST',
                beforeSend: () => {
                    modalShow();
                },
                success: (data) => {
                    modalHide();
                    Swal.fire({
                        text: `${data.message}`,
                        icon: "success!"
                    })
                },
                error: (err) => {
                    modalHide();
                    errorTreat(err);
                }
            });
        }

        const consultHour = (element) => {
            $(".row-professional .btn").removeClass('active');
            $(".row-schedule").attr('hidden');
            $(element).addClass('active');
            let barber = $(".bg-success").attr("data-barber-value");
            let professional = $(".row-professional-button .active").attr('data-barber-professional');
            $.ajax({
                url: `${API_URL}/schedule/consult`,
                data: {
                    barber_shop: barber,
                    barber: professional,
                    date: dateGlobal,
                },
                beforeSend: () => {
                    modalShow("consulta");
                },
                success: (data) => {
                    $(".row-hour").removeAttr('hidden');
                    $(".row-hour-button").html("");
                    $('html, body').animate({
                        scrollTop: $("#selectHour").offset().top
                    }, 500);
                    let cap = 0;
                    modalHide();
                    let date = new Date(`${dateGlobal}T${data.config.hour_1}`);
                    console.log(dateGlobal);
                    for (let index = 0; index < 100; index++) {
                        let minutes = date.getMinutes();
                        let hours = date.getHours();
                        let hora_desejada =
                            `${hours < 10 ? `0${hours}`:hours}:${ minutes== 0?"00":minutes}`;
                        console.log(minutes);
                        console.log(hours);
                        let flagPrintHour = false;
                        data.schedules.forEach(element => {
                            if (element.hour == `${hora_desejada}:00`) flagPrintHour = true;
                            if (`${hora_desejada}:00` >= data.config.hour_2 &&
                                `${hora_desejada}:00` < data.config.hour_3) {
                                let newDate = moment(`${dateGlobal}T${data.config.hour_3}`)
                                    .subtract(
                                        data.interval, 'minutes').format('H:mm:ss').split(":");
                                date.setHours(newDate[0], newDate[1], newDate[2]);
                                flagPrintHour = true
                            }

                            if (`${hora_desejada}:00` >= data.config.hour_4 &&
                                `${hora_desejada}:00` < data.config.hour_5) {
                                flagPrintHour = true
                                date = new Date(`${dateGlobal}T${data.config.hour_5}`);
                            }
                        });

                        if (data.config.hour_6 != null && data.config.hour_6 != "00:00:00") cap = data
                            .config.hour_6
                        else if (data.config.hour_4 != null && data.config.hour_4 != "00:00:00") cap = data
                            .config.hour_4
                        else if (data.config.hour_2 != null && data.config.hour_2 != "00:00:00") cap = data
                            .config.hour_2

                        if (hora_desejada >= cap) {
                            return false;
                        }

                        if (!flagPrintHour) {
                            $(".row-hour-button").append(`
                                <div class="col-4">
                                    <button class="btn btn-outline-primary rounded-pill" onclick="appointment('${hora_desejada}', this)">
                                        ${hora_desejada}
                                    </button>
                                </div>
                            `);
                        }
                        flagPrintHour = false;

                        date.setMinutes(date.getMinutes() + data.interval);
                    }
                }
            });
        }

        @if ($unset)
            $(".btn-select-barber").trigger("click");
        @endif
    </script>
@endsection
