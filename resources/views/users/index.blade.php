@extends('users.padrao')
@inject('user', 'App\User')
@section('padrao')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Funcionários cadastrados</h4>
                </div>
                <div class="card-body">
                    @if($user->temAcessoUnico('profile.edit', 'C'))
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um funcionário" id="q">
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-warning">
                                    <i class="material-icons">group</i>
                                    <div class="ripple-container"></div>
                                    {{ __('Cadastrar funcionário') }}</a>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive" id="tableIndex">
                        @include('users.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        $(function() {
            var timer;
            $('#q').keyup(function () {
                clearTimeout(timer);
                var ms = 200; // milliseconds
                timer = setTimeout(function() {
                    pesquisa();
                }, ms);
            });
        });
        function pesquisa () {
            var obj = {"q": $('#q').val()};
            var str = $.param(obj);
            $('#tableIndex').load('{{ route('users.pesquisa') }}?' + str);
        }
    </script>
    @endpush
@endsection
