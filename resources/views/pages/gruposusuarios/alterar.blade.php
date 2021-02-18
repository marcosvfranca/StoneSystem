@extends('pages.gruposusuarios.gruposusuarios')
@inject('user','App\User')
@section('gruposusuarios')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Alterar setor</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('gruposusuarios.alterar', ['id' => $gruposusuarios->id]) }}"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col-3 form-group">
                                <input class="form-control @error('nome') is-invalid @enderror" name="nome"
                                       placeholder="Nome" value="{{ $gruposusuarios->nome }}" autofocus>
                                @error('nome')
                                <span class="error text-danger">{{ $errors->first('nome') }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label style="font-size: 16px;">É administrador? </label>
                                <div class="form-check form-check-radio form-check-inline ml-2">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="admin" id="admin1" value="S"
                                               @if($gruposusuarios->admin == 'S') checked @endif autofocus>
                                        Sim
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="admin" id="admin2" value="N"
                                               @if($gruposusuarios->admin == 'N') checked @endif>
                                        Não
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-4 form-group">
                                <select class="select2 w-100" name="telas_iniciais_id">
                                    <option value="">Selecione a tela inicial</option>
                                    @foreach($telas_iniciais as $t)
                                        <option value="{{ $t->id }}" @if($t->id == $gruposusuarios->telas_iniciais_id) selected @endif>{{ $t->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 form-group">
                                <button type="submit" class="btn btn btn-warning"> Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($gruposusuarios->admin != 'S' and $user->temAcessoUnico('gruposusuarios.acessos'))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Configurar acessos do setor: {{ $gruposusuarios->nome }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h4 class="card-title ">Acessos disponíveis para o setor</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <input type="search" placeholder="Pesquisar acesso" id="searchAcessos" class="form-control" onkeyup="search(this)" data-table="tableSearchAcessos">
                                        </div>
                                    </div>
                                    <div class="table-responsive" id="acessos" style="max-height:300px;overflow-y:auto;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h4 class="card-title ">Acessos que o setor possuí</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <input type="search" placeholder="Pesquisar acesso" id="searchAcessosGruposUsuarios" class="form-control" onkeyup="search(this)" data-table="tableSearchAcessosGruposUsuarios">
                                        </div>
                                    </div>
                                    <div class="table-responsive" id="acessosGruposUsuarios"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            loadAll();
            $(document).on('change', '.checkAcesso', function () {
                var check = $(this);
                $('#btnLiberaAcesso' + check.attr('data-value')).attr('data-' + check.attr('data-name'), (check.is(':checked') ? 'S' : 'N'));
            });
            $(document).on('click', 'button.liberaAcesso', function () {
                var btn = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('gruposusuarios.liberaracesso') }}',
                    dataType: 'text',
                    data: {
                        'inserir': btn.attr('data-inserir'),
                        'alterar': btn.attr('data-alterar'),
                        'excluir': btn.attr('data-excluir'),
                        'id-acesso': btn.attr('data-id-acesso'),
                        'id-grupo': btn.attr('data-id-grupo'),
                        '_token': btn.attr('data-csfr')
                    },
                    // beforeSend: function () {
                    //     carregando();
                    // },
                    success: function (r) {
                        loadAll();
                    },
                    // complete: function () {
                    //     carregando('hide');
                    // },
                    error: function (e) {
                        console.log(e);
                        alert('Houve um erro ao liberar o acesso, tente novamente');
                    }
                });
            });
            $(document).on('click', 'button.removeAcesso', function () {
                var btn = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('gruposusuarios.removeacesso') }}',
                    dataType: 'text',
                    data: {
                        'id': btn.attr('data-id'),
                        '_token': btn.attr('data-csfr')
                    },
                    // beforeSend: function () {
                    //     carregando();
                    // },
                    success: function (r) {
                        loadAll();
                    },
                    // complete: function () {
                    //     carregando('hide');
                    // },
                    error: function (e) {
                        console.log(e);
                        alert('Houve um erro ao remover o acesso, tente novamente');
                        location.reload();
                    }
                });
            });
            function loadAll() {
                $('#acessos').load('{{ route('gruposusuarios.acessos', ['id' => $gruposusuarios->id]) }}', function () {
                    search(document.getElementById('searchAcessos'));
                });
                $('#acessosGruposUsuarios').load('{{ route('gruposusuarios.acessosgruposusuarios', ['id' => $gruposusuarios->id]) }}', function () {
                    search(document.getElementById('searchAcessosGruposUsuarios'));
                });
            }

            function search(este) {
                    var value = este.value.toLowerCase().trim();
                    if (!value)
                        return;
                    $("table." + este.getAttribute('data-table') + " tr").each(function (index) {
                        if (!index) return;
                        $(this).find("td").each(function () {
                            var id = $(this).text().toLowerCase().trim();
                            var not_found = (id.indexOf(value) == -1);
                            $(this).closest('tr').toggle(!not_found);
                            return not_found;
                        });
                    });
            }

        </script>
    @endpush
    @endif
@endsection
