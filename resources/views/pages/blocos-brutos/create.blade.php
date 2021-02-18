@extends('pages.blocos-brutos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar bloco</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('blocos-brutos.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-4 form-group">
                            <input autofocus class="form-control @error('numeracao') is-invalid @enderror" name="numeracao" placeholder="Número de pedreira" value="{{ old('numeracao') }}">
                            @error('numeracao')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <input autofocus class="form-control @error('numeracao') is-invalid @enderror" name="numeracao" placeholder="Nosso número" value="{{ old('numeracao') }}">
                            @error('numeracao')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <select class="select2 w-100">
                                <option value="">Próprio</option>
                                <option value="">Terceiros</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group" style="margin-bottom: -25px;">
                            <p class="font-weight-bold">Medidas brutas</p>
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control @error('comprimento') is-invalid @enderror" name="comprimento" placeholder="Comprimento" value="{{ old('comprimento') }}">
                            @error('comprimento')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control @error('altura') is-invalid @enderror" name="altura" placeholder="Altura" value="{{ old('altura') }}">
                            @error('altura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control @error('largura') is-invalid @enderror" name="largura" placeholder="Largura" value="{{ old('largura') }}">
                            @error('largura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group" style="margin-bottom: -25px;">
                            <p class="font-weight-bold">Medidas liquidas</p>
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control @error('comprimento') is-invalid @enderror" name="comprimento" placeholder="Comprimento" value="{{ old('comprimento') }}">
                            @error('comprimento')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control @error('altura') is-invalid @enderror" name="altura" placeholder="Altura" value="{{ old('altura') }}">
                            @error('altura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <input class="form-control @error('largura') is-invalid @enderror" name="largura" placeholder="Largura" value="{{ old('largura') }}">
                            @error('largura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 form-group">
                            <input class="form-control @error('comprimento') is-invalid @enderror" name="comprimento" placeholder="NF de chegada" value="{{ old('comprimento') }}">
                            @error('comprimento')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <input class="form-control @error('altura') is-invalid @enderror" name="altura" placeholder="Data NF Chegada" value="{{ old('altura') }}">
                            @error('altura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <input class="form-control @error('largura') is-invalid @enderror" name="largura" placeholder="NF de Compra" value="{{ old('largura') }}">
                            @error('largura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <input class="form-control @error('largura') is-invalid @enderror" name="largura" placeholder="Data NF de Compra" value="{{ old('largura') }}">
                            @error('largura')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('transportadores_id') is-invalid @enderror" name="transportadores_id" data-placeholder="Selecione o transportador">
                                <option value="">Selecione o transportador</option>
                                @foreach($transportadores as $t)
                                    <option value="{{ $t->id }}">{{ $t->nome }} - {{ $t->placa }}</option>
                                @endforeach
                            </select>
                            @error('transportadores_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('tipos_blocos_id') is-invalid @enderror" name="tipos_blocos_id" data-placeholder="Selecione o material do bloco">
                                <option value="">Selecione o material do bloco</option>
                                @foreach($tipos_blocos as $t)
                                    <option value="{{ $t->id }}">{{ $t->descricao }}</option>
                                @endforeach
                            </select>
                            @error('tipos_blocos_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('classificacoes_blocos_id') is-invalid @enderror" name="classificacoes_blocos_id" data-placeholder="Selecione a classificação do bloco">
                                <option value="">Selecione a classificação do bloco</option>
                                @foreach($classificacoes_blocos as $c)
                                    <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                                @endforeach
                            </select>
                            @error('classificacoes_blocos_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('fornecedores_id') is-invalid @enderror" name="fornecedores_id" data-placeholder="Selecione o fornecedor">
                                <option value="">Selecione o fornecedor do bloco</option>
                                @foreach($fornecedores as $f)
                                    <option value="{{ $f->id }}" @if($f->id == old('fornecedores_id')) selected @endif>{{ $f->nome }}</option>
                                @endforeach
                            </select>
                            @error('fornecedores_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <select class="form-control select2 @error('observacoes_id') is-invalid @enderror" name="observacoes_id[]" data-placeholder="Selecione as observações" multiple>
                                @foreach($observacoes as $o)
                                    <option value="{{ $o->id }}" @if(in_array($o->id, old('observacoes_id') ?? [])) selected @endif>{{ $o->descricao }}</option>
                                @endforeach
                            </select>
                            @error('observacoes_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn-warning"> Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
