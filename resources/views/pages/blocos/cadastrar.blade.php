@extends('pages.blocos.blocos')
@section('blocos')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title ">Cadastrar chapa bruta</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('blocos.inserir') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-3 form-group">
                            <input class="form-control @error('numeracao') is-invalid @enderror" name="numeracao" placeholder="Numeração do bloco" value="{{ old('numeracao') }}" autofocus autocomplete="true">
                            @error('numeracao')
                            <span class="error text-danger">{{ $errors->first('numeracao') }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <select class="form-control select2 @error('tipos_blocos_id') is-invalid @enderror" name="tipos_blocos_id" data-old="{{old('tipos_blocos_id')}}">
                                <option value="">Selecione o material do bloco...</option>
                                @foreach($data['tiposblocos'] as $t)
                                <option value="{{ $t->id }}" @if($t->id == old('tipos_blocos_id') ?? old('tipos_blocos_id')) selected @endif>{{ $t->descricao }}</option>
                                @endforeach
                            </select>
                            @error('tipos_blocos_id')
                            <span class="error text-danger">{{ $errors->first('tipos_blocos_id') }}</span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <select class="form-control select2 @error('transportadores_id') is-invalid @enderror" name="transportadores_id">
                                <option value="">Selecione o transportador...</option>
                                @foreach($data['transportadores'] as $t)
                                <option value="{{ $t->id }}" @if($t->id == old('transportadores_id') ?? old('transportadores_id')) selected @endif>{{ $t->nome }} / {{ $t->placa }}</option>
                                @endforeach
                            </select>
                            @error('transportadores_id')
                            <span class="error text-danger">{{ $errors->first('transportadores_id') }}</span>
                            @enderror
                        </div>
                        <div class="col-2 form-group">
                            <button type="submit" class="btn btn btn-warning"> Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $('input[name="numeracao"]').autocomplete({
            source: function( request, response ) {
                $.ajax( {
                    url: "{{ route("blocos.pesquisa.chapas-para-importar") }}",
                    dataType: "json",
                    data: {
                        q: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                } );
            },
            minLength: 2,
            select: function( event, ui ) {
                $('select[name="tipos_blocos_id"]').val(ui.item.tipos_blocos_id).trigger('change')
            }
        });
    </script>
@endpush
