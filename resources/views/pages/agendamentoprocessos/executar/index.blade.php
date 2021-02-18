@extends('pages.agendamentoprocessos.executar.padrao')
@section('padrao')
    <div class="row">
        @if($processosDisponiveis->count())
        @foreach($processosDisponiveis as $p)
        <div class="col-4">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title text-capitalize">{{ __('Agendamento: ') . $p->id . " - " . $p->processo()->first()->nome }}</h4>
                </div>
                <div class="card-body">
                    <p><b>Númeração do bloco:</b> {{ $p->chapas()->first()->chapa()->bloco()->first()->numeracao }}</p>
                    <h5><b>Quantidade de chapas:</b> {{ $p->chapas()->count() }}</h5>
                    <p><b>Material do bloco:</b> {{ $p->chapas()->first()->chapa()->bloco()->first()->tiposBlocos()->first()->descricao }}</p>
                    <div style="display: flex"><h6>Observações: </h6><span style="margin-left: 5px;margin-top: -4px;">{{ $p->observacoes ?? 'Sem observações' }}</span></div>
                    <a class="btn btn-warning btn-block text-white" href="{{ route('executar-processos.edit', ['agendamento' => $p]) }}">Realizar {{ $p->processo()->first()->nome }}</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-danger">Nada disponível...</div>
            </div>
        @endif
    </div>
    @push('js')
        <script>
            setTimeout(function () {
                location.reload();
            }, 60000 * 5.1);
        </script>
    @endpush
@endsection
