@extends('_components.template')

@section('body')
    <!-- Page Content Wrapper -->
    <div class="page-content-wrapper py-3">
        <div class="container">
            <div class="card text-center px-3">
                <div class="card-body">
                    <i class="bi bi-wifi-off text-danger mb-2"></i>
                    <h5>Sem conexão com a internet!</h5>
                    <p class="mb-0">
                        Parece que você está sem conexão com a internet, conecte-se a uma rede WIFI ou ligue seus dados
                        móveis e tente novamente
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
