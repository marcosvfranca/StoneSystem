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
                            <div class="col-4 form-group">
                                <input autofocus class="form-control @error('numeracao_pedreira') is-invalid @enderror" name="numeracao_pedreira" placeholder="Número de pedreira" value="{{ $blocos_bruto->numeracao_pedreira }}">
                                @error('numeracao_pedreira')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <input autofocus class="form-control @error('nosso_numero') is-invalid @enderror" name="nosso_numero" placeholder="Nosso número" value="{{ $blocos_bruto->nosso_numero }}">
                                @error('nosso_numero')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label style="display: block;margin-top: -15px;">Origem</label>
                                <select class="select2 w-100" name="origem">
                                    <option value="P" @if($blocos_bruto->origem == 'P') selected @endif>Próprio</option>
                                    <option value="T" @if($blocos_bruto->origem == 'T') selected @endif>Terceiros</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group" style="margin-bottom: -25px;">
                                <p class="font-weight-bold">Medidas brutas</p>
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control @error('comprimento_bruto') is-invalid @enderror" name="comprimento_bruto" placeholder="Comprimento bruto" value="{{ number_format($blocos_bruto->comprimento_bruto, 2, ',', '.') }}">
                                @error('comprimento_bruto')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control @error('altura_bruta') is-invalid @enderror" name="altura_bruta" placeholder="Altura bruta" value="{{ number_format($blocos_bruto->altura_bruta, 2, ',', '.') }}">
                                @error('altura_bruta')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control @error('largura_bruta') is-invalid @enderror" name="largura_bruta" placeholder="Largura bruta" value="{{ number_format($blocos_bruto->largura_bruta, 2, ',', '.') }}">
                                @error('largura_bruta')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group" style="margin-bottom: -25px;">
                                <p class="font-weight-bold">Medidas líquidas</p>
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control @error('comprimento_liquido') is-invalid @enderror" name="comprimento_liquido" placeholder="Comprimento líquido" value="{{ number_format($blocos_bruto->comprimento_liquido, 2, ',', '.') }}">
                                @error('comprimento_liquido')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control @error('altura_liquida') is-invalid @enderror" name="altura_liquida" placeholder="Altura líquida" value="{{ number_format($blocos_bruto->altura_liquida, 2, ',', '.') }}">
                                @error('altura_liquida')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control @error('largura_liquida') is-invalid @enderror" name="largura_liquida" placeholder="Largura líquida" value="{{ number_format($blocos_bruto->largura_liquida, 2, ',', '.') }}">
                                @error('largura_liquida')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 form-group">
                                <input class="form-control @error('nf_chegada') is-invalid @enderror" name="nf_chegada" placeholder="NF de chegada" value="{{ $blocos_bruto->nf_chegada }}">
                                @error('nf_chegada')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <label>Data NF Chegada</label>
                                <input type="date" class="form-control @error('dt_nf_chegada') is-invalid @enderror" name="dt_nf_chegada" placeholder="Data NF Chegada" value="{{ $blocos_bruto->dt_nf_chegada }}">
                                @error('dt_nf_chegada')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control @error('nf_compra') is-invalid @enderror" name="nf_compra" placeholder="NF de Compra" value="{{ $blocos_bruto->nf_compra }}">
                                @error('nf_compra')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 form-group">
                                <label>Data NF de Compra</label>
                                <input type="date" class="form-control @error('dt_nf_compra') is-invalid @enderror" name="dt_nf_compra" placeholder="Data NF de Compra" value="{{ $blocos_bruto->dt_nf_compra }}">
                                @error('dt_nf_compra')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
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
