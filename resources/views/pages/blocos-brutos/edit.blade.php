@extends('pages.blocos-brutos.padrao')
@section('padrao')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title ">Alterar bloco</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blocos-brutos.update', ['blocos_bruto' => $blocos_bruto]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-3 form-group">
                                <input autofocus class="form-control @error('numeracao') is-invalid @enderror" name="numeracao" placeholder="Numeração" value="{{ $blocos_bruto->numeracao }}">
                                @error('numeracao')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control @error('comprimento') is-invalid @enderror" name="comprimento" placeholder="Comprimento" value="{{ number_format($blocos_bruto->comprimento, 2, ',', '.') }}">
                                @error('comprimento')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control @error('altura') is-invalid @enderror" name="altura" placeholder="Altura" value="{{ number_format($blocos_bruto->altura, 2, ',', '.') }}">
                                @error('altura')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control @error('largura') is-invalid @enderror" name="largura" placeholder="Largura" value="{{ number_format($blocos_bruto->largura, 2, ',', '.') }}">
                                @error('largura')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('transportadores_id') is-invalid @enderror" name="transportadores_id" data-placeholder="Selecione o transportador">
                                    @foreach($transportadores as $t)
                                        <option value="{{ $t->id }}" @if($t->id == $blocos_bruto->transportadores_id) selected @endif >{{ $t->nome }} - {{ $t->placa }}</option>
                                    @endforeach
                                </select>
                                @error('transportadores_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('tipos_blocos_id') is-invalid @enderror" name="tipos_blocos_id" data-placeholder="Selecione o material do bloco">
                                    @foreach($tipos_blocos as $t)
                                        <option value="{{ $t->id }}" @if($t->id == $blocos_bruto->tipos_blocos_id) selected @endif>{{ $t->descricao }}</option>
                                    @endforeach
                                </select>
                                @error('tipos_blocos_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('classificacoes_blocos_id') is-invalid @enderror" name="classificacoes_blocos_id" data-placeholder="Selecione a classificação do bloco">
                                    @foreach($classificacoes_blocos as $c)
                                        <option value="{{ $c->id }}" @if($c->id == $blocos_bruto->classificacoes_blocos_id) selected @endif>{{ $c->descricao }}</option>
                                    @endforeach
                                </select>
                                @error('classificacoes_blocos_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('fornecedores_id') is-invalid @enderror" name="fornecedores_id" data-placeholder="Selecione o fornecedor">
                                    @foreach($fornecedores as $f)
                                        <option value="{{ $f->id }}" @if($f->id == $blocos_bruto->fornecedores_id) selected @endif>{{ $f->nome }}</option>
                                    @endforeach
                                </select>
                                @error('fornecedores_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 form-group">
                                <select class="form-control select2 @error('observacoes_id') is-invalid @enderror" name="observacoes_id[]" data-placeholder="Selecione as observações" multiple>
                                    @foreach($observacoes as $o)
                                        <option value="{{ $o->id }}" @if($blocos_bruto->observacoes()->where('observacoes_blocos_brutos.observacoes_chapas_id', $o->id)->first()) selected @endif>{{ $o->descricao }}</option>
                                    @endforeach
                                </select>
                                @error('observacoes_id')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2 form-group">
                                <button type="submit" class="btn btn-warning"> Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
