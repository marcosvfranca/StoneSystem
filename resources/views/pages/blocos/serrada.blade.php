@if($chapaSerrada->count())
    <div class="col-12 mt-3">
        <div class="alert alert-danger">
            <h4>Foram encontradas {{ $chapaSerrada->count() }} chapas serradas com esta numeração de bloco</h4>
            {{--                                    <br>--}}
            <button class="btn btn-warning" onclick="importaSerrada()">Clique aqui para importar</button>
        </div>
    </div>
@endif
