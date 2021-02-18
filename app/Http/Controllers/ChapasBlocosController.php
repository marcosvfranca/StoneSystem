<?php

namespace App\Http\Controllers;

use App\Blocos;
use App\ChapasBlocos;
use App\ChapasBlocosEstadosChapas;
use App\ChapasBlocosObservacoesChapas;
use App\EspessurasChapas;
use App\EstadosChapas;
use App\Http\Requests\ChapasBlocosRequest;
use App\Http\Requests\ChapasBlocosRequest2;
use App\ObservacoesChapas;
use Illuminate\Http\Request;

class ChapasBlocosController extends Controller
{

    public function index()
    {
        $data = request()->all();
        $chapas = ChapasBlocos::where('blocos_id', $data['bloco'])->orderByRaw(' CAST(numeracao as SIGNED INTEGER)');
        if (isset($data['q']))
            $chapas
                ->whereRaw("(numeracao like '%" . $data['q'] . "%' or " .
                "largura like '%" . $data['q'] . "%' or " .
                "comprimento like '%" . $data['q'] . "%')");
        return view('pages.blocos.chapas.index', ['chapas' => $chapas->get()]);
    }

    public function createForm($bloco)
    {
        $bloco = Blocos::findOrFail($bloco);
        return view('pages.blocos.chapas.create', [
            'bloco' => $bloco,
            'espessuras' => EspessurasChapas::all(),
            'estadosChapas' => EstadosChapas::all(),
            'observacoesChapas' => ObservacoesChapas::all(),
        ]);
    }

    public function store(ChapasBlocosRequest $r)
    {
        $data = $r->all();
        $numeracao = (int)$data['numeracao'];
        $data['comprimento'] = str_replace(',', '.', $data['comprimento']);
        $data['largura'] = str_replace(',', '.', $data['largura']);
        for ($i = 0; $i < (int)$data['qtd']; $i++) {
            $data['numeracao'] = $numeracao + $i;
                $chapa = ChapasBlocos::create($data);
            if (isset($data['estadosChapa']) and is_array($data['estadosChapa']) and count($data['estadosChapa']))
                foreach ($data['estadosChapa'] as $e)
                    ChapasBlocosEstadosChapas::create(['chapas_blocos_id' => $chapa->id, 'estados_chapas_id' => $e]);
            if (isset($data['observacoesChapa']) and is_array($data['observacoesChapa']) and count($data['observacoesChapa']))
                foreach ($data['observacoesChapa'] as $o)
                    ChapasBlocosObservacoesChapas::create(['chapas_blocos_id' => $chapa->id, 'observacoes_chapas_id' => $o]);
        }
        return true;
    }

    public function destroy($chapa)
    {
        $c = ChapasBlocos::findOrFail($chapa);
        $c->apagar();
        return true;
    }

    public function edit(ChapasBlocos $chapa)
    {
        $this->temAcesso('chapas', 'A');
        return view('pages.blocos.chapas.edit', [
            'chapa' => $chapa,
            'espessuras' => EspessurasChapas::all(),
            'estadosChapas' => EstadosChapas::all(),
            'observacoesChapas' => ObservacoesChapas::all(),
        ]);
    }

    public function update(ChapasBlocosRequest2 $request, ChapasBlocos $chapa)
    {
        $this->temAcesso('chapas', 'A');
        $data = $request->all();
        $data['comprimento'] = str_replace(',', '.', $data['comprimento']);
        $data['largura'] = str_replace(',', '.', $data['largura']);
        $chapa->update($data);

        ChapasBlocosEstadosChapas::where('chapas_blocos_id', $chapa->id)->delete();
        if (isset($data['estadosChapa']) and is_array($data['estadosChapa']) and count($data['estadosChapa']))
            foreach ($data['estadosChapa'] as $e)
                ChapasBlocosEstadosChapas::create(['chapas_blocos_id' => $chapa->id, 'estados_chapas_id' => $e]);
        ChapasBlocosObservacoesChapas::where('chapas_blocos_id', $chapa->id)->delete();
        if (isset($data['observacoesChapa']) and is_array($data['observacoesChapa']) and count($data['observacoesChapa']))
            foreach ($data['observacoesChapa'] as $o)
                ChapasBlocosObservacoesChapas::create(['chapas_blocos_id' => $chapa->id, 'observacoes_chapas_id' => $o]);

        return true;
    }

}
