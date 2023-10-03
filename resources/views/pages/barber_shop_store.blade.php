@extends('_components.template')

@section('title', 'Atendimentos')

@section('body')

    @include('_components.header_2', ['title' => 'Lista de atendimentos'])

    @include('_components.sidebar')

    <div class="page-content-wrapper py-3">
        <div class="container">
            <!-- User Information-->
            <div class="card user-info-card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="user-profile me-3">
                        <img src="/images/barber/barber_shop.svg" width="80px" height="80px" id="img-logo" alt="">
                    </div>
                </div>
            </div>

            <!-- User Meta Data-->
            <div class="card user-data-card">
                <div class="card-body">
                    <form action="#" class="form-barber-shop">

                        <div class="form-group mb-3">
                            <label class="form-label" for="username">Nome do responsável</label>
                            <input class="form-control" id="username" name="username" type="text"
                                placeholder="Nome do responsável" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="userphone">Telefone do responsável</label>
                            <input class="form-control" id="userphone" name="userphone" type="tel"
                                placeholder="Telefone do responsável" required>
                        </div>

                        <hr>

                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nome</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Nome"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="phone">Telefone</label>
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Telefone"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="whatsapp">Whatsapp</label>
                            <input class="form-control" id="whatsapp" name="whatsapp" type="tel"
                                placeholder="Whatsapp">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="type">Tipo</label>
                            <select name="type" id="type" class="form-control">
                                <option value="1">Barbearia</option>
                                <option value="0">Salão de beleza</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="form-label" for="logo">Logo da barbearia</label>
                            <input class="form-control" type="file" name="logo" id="logo">
                        </div>
                    </form>

                    <button class="btn btn-success w-100" onclick="submit('form-barber-shop', 'barber/store')">
                        Salvar cadastro
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('_components.footer')
@stop

@section('script')
    <script>
        var uploadfoto = document.getElementById('logo');
        var fotopreview = document.getElementById('img-logo');

        $('#type').on('change', function() {
            if (uploadfoto.value == '') {
                if (this.value == 'true') {
                    fotopreview.src = '/images/barber/barber_shop.svg';
                } else {
                    fotopreview.src = '/images/barber/salon.svg';
                }
            }
        });

        uploadfoto.addEventListener('change', function(e) {

            let file = URL.createObjectURL(e.target.files[0])

            fotopreview.src = file;
        });

        $('#phone').mask(SPMaskBehavior, spOptions);
        $('#userphone').mask(SPMaskBehavior, spOptions);
        $('#whatsapp').mask(SPMaskBehavior, spOptions);
    </script>
@endsection
