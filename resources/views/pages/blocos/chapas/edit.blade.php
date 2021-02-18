<form id="editChapa{{ $chapa->id }}" method="post" action="{{ route('chapas.update', ['chapa' => $chapa]) }}" class="container-fluid formEditChapa"
      data-message="Chapa alterada com sucesso">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 form-group mt-4">
            <label>Numeração da chapa</label>
            <input type="text" name="numeracao" value="{{ $chapa->numeracao }}" placeholder="Numeração da chapa"
                   class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-12 form-group">
            <label>Estado da chapa</label>
            <select class="w-100 select2" name="estadosChapa[]" multiple="multiple">
                @foreach($estadosChapas as $e)
                    <option value="{{ $e->id }}"
                            @if($chapa->estados()->where('estados_chapas_id', $e->id)->count()) selected @endif>{{ $e->descricao }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
        </div>
        <div class="col-12 form-group">
            <label>Qualidade da serrada</label>
            <select class="w-100 select2" name="observacoesChapa[]" multiple="multiple" style="tab-index: 999;">
                @foreach($observacoesChapas as $o)
                    <option value="{{ $o->id }}"
                            @if($chapa->observacoes()->where('observacoes_chapas_id', $o->id)->count()) selected @endif>{{ $o->apelido }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
        </div>
        <div class="col-12 form-group">
            <label>Espessura da chapa</label>
            <select name="espessuras_chapas_id" class="select2 w-100 select2EspessuraChapa">
                <option value="">Selecione a espessura da chapa</option>
                @foreach($espessuras as $e)
                    <option value="{{ $e->id }}"
                            @if($e->id == $chapa->espessuras_chapas_id) selected @endif>{{ $e->descricao }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
        </div>
        <div class="col-12 form-group">
            <label>Comprimento</label>
            <input type="text" name="comprimento" value="{{ number_format($chapa->comprimento, 2, ',', '.') }}" placeholder="Comprimento"
                   class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-12 form-group">
            <label>Altura</label>
            <input type="text" name="largura" value="{{ number_format($chapa->largura, 2, ',', '.') }}" placeholder="Altura" class="form-control">
            <span class="error text-danger"></span>
        </div>
        {{--    <div class="td-actions text-right">--}}
        {{--        <button class="btn btn-success" type="submit">--}}
        {{--            <i class="material-icons">edit</i>--}}
        {{--            <div class="ripple-container"></div>--}}
        {{--            {{ __('Salvar') }}--}}
        {{--        </button>--}}
        {{--        <button class="btn btn-danger" onclick="loadChapas()">--}}
        {{--            <i class="material-icons">delete</i>--}}
        {{--            <div class="ripple-container"></div>--}}
        {{--            {{ __('Cancelar') }}--}}
        {{--        </button>--}}
        {{--    </div>--}}
    </div>
</form>
