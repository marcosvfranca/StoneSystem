<?php

namespace App\Http\Controllers;

use App\AgendamentoProcesso;
use App\Blocos;
use App\BlocosBrutos;
use App\ChapaBlocoAgendamentoProcesso;
use App\ChapasBlocos;
use App\ChapasSerradas;
use App\ClassificacoesBlocos;
use App\EspessurasChapas;
use App\EstadosChapas;
use App\GruposUsuarios;
use App\ItensChapasSerrada;
use App\Motivo;
use App\OrdemDeSerradas;
use App\Processo;
use App\TiposBlocos;
use App\User;
use Illuminate\Support\Facades\DB;

class TesteController extends Controller
{
    public function Teste()
    {
        return TiposBlocos::first()->itensTiposBlocos()->dd();
    }
}
