@extends('pages.ordemdeserradas.executar.padrao')
@section('padrao')
    <div class="row">
        @if($ordem_de_serradas->count())
        @foreach($ordem_de_serradas as $o)
        <div class="col-4">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title text-capitalize">{{ __('Ordem de serrada: ') . $o->id }}</h4>
                </div>
                <div class="card-body">
                    <p><b>Númeração do bloco:</b> {{ $o->blocoBruto()->first()->numeracao }}</p>
                    <p><b>Espessura:</b> {{ $o->espessura()->first()->descricao }}</p>
                    <p><b>Material do bloco:</b> {{ $o->blocoBruto()->first()->tiposBlocos()->first()->descricao }}</p>
                    @if($o->observacoes)<div style="display: flex"><h6>Observações: </h6><span style="margin-left: 5px;margin-top: -4px;">@php echo nl2br($o->observacoes) @endphp</span></div>@endif
                    <a class="btn btn-warning btn-block text-white" href="{{ route('chapas-serradas.createfororder', ['ordem_de_serrada' => $o]) }}">Finalizar ordem de serrada</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-danger">Nenhum ordem de serrada disponível...</div>
            </div>
        @endif
    </div>
    @push('js')
        <script>
            setTimeout(function () {
                location.reload();
            }, 1000 * 60 * 5);
        </script>
    @endpush
@endsection
