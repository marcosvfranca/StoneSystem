@if($processo->tipoMaterialProcessos()->count())
<label>Selecione abaixo os materiais do processo</label>
<select name="tipoMaterialProcessos[]" multiple class="select2 w-100" data-placeholder="Clique aqui para selecionar os materiais do processo">
    @foreach($processo->tipoMaterialProcessos()->get() as $t)
        <option @if($processo->selecionar_materiais == 'S') selected @endif value="{{ $t->id }}">{{ $t->tipo }}</option>
    @endforeach
</select>
@else
<div class="alert alert-danger"> Nenhum material disponível neste processo.
    @if(auth()->user()->temAcessoUnico('processos'))<p>Clique <a href="{{ route('processos.edit', ['processo' => $processo]) }}">aqui</a> para adicionar materiais ao processo: {{ $processo->nome }}</p>@endif
</div>
@endif
