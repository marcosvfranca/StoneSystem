@extends('pages.fornecedores.padrao')
@section('padrao')
@if (session('status') or session('error'))
    @push('js')
        <script>
            $.notify({
                icon: "supervised_user_circle",
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Fornecedores cadastrados</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Digite aqui para pesquisar um fornecedor" id="q">
                    </div>
                    @if(auth()->user()->temAcessoUnico('fornecedores', 'C'))
                    <div class="col-6 text-right">
                        <a href="{{ route('fornecedores.create') }}" class="btn btn-sm btn-warning">
                            <i class="material-icons">supervised_user_circle</i>
                            <div class="ripple-container"></div>
                            {{ __('Cadastrar fornecedor') }}</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive" id="tableIndex">
                    @include('pages.fornecedores.table', ['fornecedores' => $fornecedores])
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
            $('#tableIndex').load('{{ route('fornecedores.pesquisa') }}?' + str);
        }
    </script>
@endpush
@endsection
