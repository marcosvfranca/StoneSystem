<?php

namespace App\Http\Controllers;

use App\EspessurasChapas;
use App\Http\Requests\ChapasBlocosEspessurasRequest;

class ChapasBlocosEspessurasController extends Controller
{
    public function index()
    {
        $this->temAcesso('espessuras-chapas');
        return view('pages.espessuraschapas.index', ['espessurasChapas' => EspessurasChapas::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $espessurasChapas = EspessurasChapas::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $espessurasChapas
                ->where('descricao', 'like', '%' . $data['q'] . '%');
        return view('pages.espessuraschapas.table', ['espessurasChapas' => $espessurasChapas->get()]);
    }

    public function create()
    {
        $this->temAcesso('espessuras-chapas', 'C');
        return view('pages.espessuraschapas.create');
    }

    public function store(ChapasBlocosEspessurasRequest $r)
    {
        $data = $r->all();
        if ($data['cor'] == '#000000')
            $data['cor'] = null;
        if ($data['cor_fonte'] == '#000000')
            $data['cor_fonte'] = null;
        EspessurasChapas::create($data);
        flash('Espessura chapa cadastrada com sucesso')->success();
        return $this->rindex();
    }

    public function rindex()
    {
        return redirect()->route('espessuras-chapas.index');
    }

    public function destroy($espessuras_chapa)
    {
        $espessuraChapa = EspessurasChapas::findOrFail($espessuras_chapa);
        if ($espessuraChapa->chapas()->count())
            flash('Existem ' . $espessuraChapa->chapas()->count() . ' chapas associadas a esta espessura de chapa. Não será possível excluir')->error()->important();
        else
            $espessuraChapa->delete();
        return $this->rindex();
    }

    public function edit($espessuras_chapa)
    {
        $espessuraChapa = EspessurasChapas::findOrFail($espessuras_chapa);
        return view('pages.espessuraschapas.edit', ['espessuraChapa' => $espessuraChapa]);
    }

    public function update(ChapasBlocosEspessurasRequest $r, $espessuras_chapa)
    {
        $data = $r->all();
        if ($data['cor'] == '#000000')
            $data['cor'] = null;
        if ($data['cor_fonte'] == '#000000')
            $data['cor_fonte'] = null;
        $espessuraChapa = EspessurasChapas::findOrFail($espessuras_chapa);
        $espessuraChapa->update($data);
        return $this->rindex();
    }

}
