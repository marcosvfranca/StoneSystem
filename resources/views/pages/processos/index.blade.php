@extends('pages.processos.padrao')
@section('padrao')
<div class="row">
    <div class="col-md-12">
        @if (session('status') or session('error'))
            @push('js')
                <script>
                    $.notify({
                        icon: "insights",
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
                <h4 class="card-title ">Processos</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um processo" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('processos', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('processos.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">insights</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar processo') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.processos.table', ['processos' => $processos])
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
            $('#tableIndex').load('{{ route('processos.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
