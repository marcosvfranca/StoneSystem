@extends('pages.blocos.blocos')
@section('blocos')
<div class="row">
    <div class="col-md-12">
        @if (session('status') or session('error'))
            @push('js')
                <script>
                    $.notify({
                        icon: "view_agenda",
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
                <h4 class="card-title ">Blocos/chapas cadastrados</h4>
            </div>
            <div class="card-body">
                @if(auth()->user()->temAcessoUnico('blocos', 'C'))
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Digite aqui para pesquisar uma chapa bruta" id="q">
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('blocos.cadastrar') }}" class="btn btn-sm btn-warning">
                                <i class="material-icons">view_agenda</i>
                                <div class="ripple-container"></div>
                                {{ __('Cadastrar chapa bruta') }}</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive" id="tableIndex">
                    @include('pages.blocos.table', ['blocos' => $blocos])
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
            $('#tableIndex').load('{{ route('blocos.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
