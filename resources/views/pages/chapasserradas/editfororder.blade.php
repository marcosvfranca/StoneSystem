@extends('pages.chapasserradas.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h3 class="card-title ">Finalizar ordem de serrada: {{ $ordem_de_serrada->id }}</h3>
                @if($ordem_de_serrada->observacoes)<h4> <b>Observações: </b> @php echo nl2br($ordem_de_serrada->observacoes); @endphp</h4>@endif
            </div>
            <div class="card-body">
                @php
                    $chapasSerradas = $ordem_de_serrada->chapasSerrada()->first();
                @endphp
                <form action="{{ route('chapas-serradas.update', ['chapas_serrada' => $chapasSerradas]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input name="redirect_to_ordem_de_serradas" value="S" type="hidden">
                    <div class="row">
                        <div class="col-3 form-group" style="margin-top: 25px;">
                            <label>Numeração do bloco</label>
                            <input type="text" autofocus class="form-control @error('numeracao') is-invalid @enderror" name="numeracao" placeholder="Numeração do bloco" value="{{ $chapasSerradas->numeracao }}">
                            @error('numeracao')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-5 form-group">
                            <label>Material do bloco</label>
                            <select name="tipos_blocos_id" class="select2 w-100" data-placeholder="Selecione o material do bloco">
                                <option value="">Selecione o material do bloco</option>
                                @foreach($tiposBlocos as $t)
                                    <option value="{{ $t->id }}" @if($chapasSerradas->tipos_blocos_id == $t->id) selected @endif>{{ $t->descricao }}</option>
                                @endforeach
                            </select>
                            @error('tipos_blocos_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <label>Qualidade da serrada</label>
                            <select name="observacoes_id[]" class="select2 w-100" multiple="true" data-placeholder="Selecione a qualidade da serrada">
                                @foreach($observacoes as $o)
                                    <option value="{{ $o->id }}" @if($chapasSerradas->observacoes()->where('observacoes_chapas_id', $o->id)->count()) selected @endif>{{ $o->descricao }}</option>
                                @endforeach
                            </select>
                            @error('observacoes_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <textarea class="form-control @error('observacoes') is-invalid @enderror" name="observacoes" rows="2" placeholder="Observações">{{ old('observacoes') }}</textarea>
                        </div>
                        <div class="col-12 text-center form-group">
                            <button type="submit" class="btn btn-warning"> Salvar dados da serrada</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12 mt-3">
                        <h4>Cadastrar chapas na serrada</h4>
                    </div>
                    <div class="col-12" id="createItem">
                        @include('pages.chapasserradas.itens.create', ['chapasSerradas' => $chapasSerradas, 'espessuras' => $espessuras])
                    </div>
                    <div class="col-12 mt-3">
                        <h4>Chapas da serrada</h4>
                    </div>
                    <div class="col-12" id="itensChapasSerrada">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.chapasserradas.js')
@endsection
