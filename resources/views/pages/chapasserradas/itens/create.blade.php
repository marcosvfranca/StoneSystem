<form class="card formCreateItem" action="{{ route('itens-chapas-serradas.store') }}" method="post" data-message="Chapas cadastradas com sucesso">
    <div class="card-body row">
        @csrf
        <input type="hidden" name="chapas_serradas_id" value="{{ $chapasSerradas->id }}">
        <div class="col-2 form-group">
            <label>Quantidade de chapas</label>
            <input type="number" name="qtd" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-2 form-group">
            <label>Numeração inicial</label>
            <input type="text" name="numeracao_inicial" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-3 form-group" style="margin-top: -5px;">
            <label>Espessura das chapas</label>
            <select name="espessuras_chapas_id" class="select2 w-100" data-placeholder="Selecione a espessura">
                <option value="">Selecione a espessura</option>
                @php
                    $ordem_de_serrada = $chapasSerradas->ordemDeSerrada()->first();
                @endphp
                @foreach($espessuras as $e)
                    <option value="{{ $e->id }}" @if($ordem_de_serrada and $ordem_de_serrada->espessuras_chapas_id == $e->id) selected @endif>{{ $e->descricao }}</option>
                @endforeach
            </select>
            <span class="error text-danger"></span>
        </div>
        <div class="col-2 form-group">
            <label>Comprimento</label>
            <input type="text" name="comprimento" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-2 form-group">
            <label>Altura</label>
            <input type="text" name="altura" class="form-control">
            <span class="error text-danger"></span>
        </div>
        <div class="col-2 form-group">
            <button type="submit" class="btn btn-warning" data-original-text="Cadastrar">Cadastrar</button>
        </div>
    </div>
</form>
