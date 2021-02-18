@extends('pages.gruposusuarios.gruposusuarios')
@section('gruposusuarios')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Cadastrar setor</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('gruposusuarios.inserir') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-3 form-group">
                                <input class="form-control @error('nome') is-invalid @enderror" name="nome" autofocus
                                       placeholder="Nome" value="{{ old('nome') }}">
                                @error('nome')
                                <span class="error text-danger">{{ $errors->first('nome') }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label style="font-size: 16px;">É administrador? </label>
                                <div class="form-check form-check-radio form-check-inline ml-2">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="admin" id="admin1" value="S">
                                        Sim
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="admin" id="admin2" value="N" checked>
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
                                        <option value="{{ $t->id }}">{{ $t->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 form-group">
                                <button type="submit" class="btn btn btn-warning"> Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
