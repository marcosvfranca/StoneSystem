@extends('pages.tiposblocos.tiposblocos')
@section('tiposblocos')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Alterar classificação de bloco</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tiposblocos.alterar', ['id' => $tipobloco->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6 form-group">
                            <input class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome" value="{{ $tipobloco->descricao }}">
                            @if(!old('tipos_blocos_id'))
                                @error('descricao')
                                <span class="error text-danger">{{ $errors->first('descricao') }}</span>
                                @enderror
                            @endif
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn-warning"> Alterar</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('itens-tipos-blocos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h4 class="font-weight-bold">Cadastrar variação de material de bloco</h4>
                        </div>
                        <input type="hidden" name="tipos_blocos_id" value="{{ $tipobloco->id }}">
                        <div class="col-7 form-group">
                            <input class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Nome da variação" value="{{ old('descricao') }}" autofocus>
                            @if(old('tipos_blocos_id'))
                                @error('descricao')
                                <span class="error text-danger">{{ $errors->first('descricao') }}</span>
                                @enderror
                            @endif
                        </div>
                        <div class="col-5 form-group">
                            <button type="submit" class="btn btn-warning"> Cadastrar variação</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <h4 class="font-weight-bold">Variações cadastradas</h4>
                    </div>
                    <div class="col-12">
                        @if($tipobloco->itensTiposBlocos()->count())
                        <table class="table">
                            <thead class=" text-warning">
                            <tr>
                                <th>
                                    Nome da variação
                                </th>
                                <th class="text-center">
                                    Cadastrado em
                                </th>
                                <th class="text-right">
                                    &nbsp;&nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipobloco->itensTiposBlocos()->get() as $i)
                                <tr>
                                    <td>
                                        {{ $i->descricao }}
                                    </td>
                                    <td class="text-center">
                                        {{ date('d/m/Y', strtotime($i->created_at)) }}
                                    </td>
                                    <td class="td-actions text-right">
                                        @if(auth()->user()->temAcessoUnico('itens-tipos-blocos', 'E'))
                                            <form action="{{ route('itens-tipos-blocos.destroy', ['itens_tipos_bloco' => $i]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Deseja excluir esta variação?')">
                                                    <i class="material-icons">delete</i>
                                                    {{ __('Excluir variação') }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="alert alert-danger">Nenhuma variação de material de bloco cadastrada</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
