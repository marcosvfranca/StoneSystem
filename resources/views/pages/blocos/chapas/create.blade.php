<form method="post" action="{{ route('chapas.store') }}" class="formCreateChapa" data-message="Chapa cadastrada com sucesso">
    @csrf
    <input type="hidden" name="blocos_id" value="{{ $bloco->id }}">
    <div class="row">
        <div class="col-2 form-group text-left">
            <label>Nº de chapas</label>
        </div>
        <div class="col-2 form-group">
            <input type="number" value="{{ old('qtd') ?? 1 }}" name="qtd" class="form-control @error('qtd') is-invalid @enderror" placeholder="Quantidade">
            <span class="error text-danger"></span>
        </div>
        <div class="col-3 form-group">
            <input type="text" name="numeracao" value="{{ old('numeracao') }}" placeholder="Numeração inicial" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-2 form-group">
            <input type="text" name="comprimento" value="{{ old('comprimento') }}" placeholder="Comprimento" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-2 form-group">
            <input type="text" name="largura" value="{{ old('largura') }}" placeholder="Altura" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-6 form-group">
            <select name="espessuras_chapas_id" class="select2 w-100 select2EspessuraChapa">
                <option value="">Selecione a espessura da chapa</option>
                @foreach($espessuras as $e)
                    <option value="{{ $e->id }}" @if($e->id == old('espessuras_chapas_id')) selected @endif>{{ $e->descricao }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
        </div>
        <div class="col-6 form-group">
            <select class="w-100 select2EstadosChapa" name="estadosChapa[]" multiple="multiple">
                @foreach($estadosChapas as $e)
                    <option value="{{ $e->id }}">{{ $e->descricao }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
            @push('js')
                <script>$('.select2EstadosChapa').select2({placeholder: 'Selecione o estado da chapa'});</script>
            @endpush
        </div>
        <div class="col-6 form-group">
            <select class="w-100 select2ObservacoesChapa" name="observacoesChapa[]" multiple="multiple">
                @foreach($observacoesChapas as $o)
                    <option value="{{ $o->id }}">{{ $o->apelido }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
            @push('js')
                <script>$('.select2ObservacoesChapa').select2({placeholder: 'Selecione a qualidade da serrada'});</script>
            @endpush
        </div>
        <div class="col-12 text-center form-group">
            <button class="btn btn-warning" type="submit" data-original-text="Cadastrar chapa">Cadastrar chapas</button>
        </div>
    </div>
</form>
