@if(count($chapas))
<h5 class="font-weight-bold">Chapas do agendamento</h5>
<div class="row">
    @foreach($chapas as $c)
    <div class="col-3">
        <div class="card mt-1 mb-1">
            <div class="card-body">
                <div><h6><span class="font-weight-bold">Chapa nº:</span> {{ $c->chapa()->numeracao }}</h6></div>
                <div><span class="font-weight-bold">Espessura:</span> {{ $c->chapa()->espessura()->first()->descricao }}</div>
                <div><span class="font-weight-bold">Comprimento:</span> {{ $c->chapa()->comprimento }}</div>
                <div><span class="font-weight-bold">Altura:</span> {{ $c->chapa()->largura }}</div>
                <div>
                    <span class="font-weight-bold">Materiais:</span>
                    <ul>
                        @foreach($c->tiposMateriais()->get() as $tipoMaterial)
                        <li>{{ $tipoMaterial->tipo }}</li>
                        @endforeach
                    </ul>
                </div>
                @if(auth()->user()->temAcessoUnico('agendamento_processos', 'E'))
                <form action="{{ route('chapas-agendamentos.destroy', ['chapas_agendamento' => $c]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning btn-sm btn-block">Remover chapa</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
    <div class="alert alert-danger"> Nenhuma chapa agendada neste processo, selecione-as abaixo.</div>
@endif
