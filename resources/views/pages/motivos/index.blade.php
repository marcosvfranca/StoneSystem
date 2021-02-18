@extends('pages.motivos.padrao')
@inject('user','App\User')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        @if (session('status') or session('error'))
            @push('js')
                <script>
                    $.notify({
                        icon: "cancel_presentation",
                        message: "{{ session('status') ?? session('error')  }}"
                    },{
                        type: @if(session('status')) 'success' @else 'danger' @endif,
                        withtimer: 500,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                </script>
            @endpush
        @endif
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Motivos cancelamento/não conclusão de processos</h4>
            </div>
            <div class="card-body">
                @if(auth()->user()->temAcessoUnico('motivos', 'C'))
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um motivo de operação de processo" id="q">
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('motivos.create') }}" class="btn btn-sm btn-warning">
                                <i class="material-icons">cancel_presentation</i>
                                <div class="ripple-container"></div>
                                {{ __('Cadastrar motivo de cancelamento/não conclusão de processo') }}</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive" id="tableIndex">
                    @include('pages.motivos.table', ['motivos' => $motivos])
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(function() {
            var timer;
            $('#q').keyup(function () {
                clearTimeout(timer);
                var ms = 200; // milliseconds
                timer = setTimeout(function() {
                    pesquisa();
                }, ms);
            });
        });
        function pesquisa () {
            var obj = {"q": $('#q').val()};
            var str = $.param(obj);
            $('#tableIndex').load('{{ route('motivos.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
