<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('sem-acesso', 'Controller@semAcesso')->name('sem-acesso');
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('pesquisa-funcionario', 'UserController@pesquisa')->name('users.pesquisa');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::prefix('transportadores')->group(function () {
	    Route::get('/', 'TransportadoresController@index')->name('transportadores');
	    Route::get('/pesquisa', 'TransportadoresController@pesquisa')->name('transportadores.pesquisa');
	    Route::get('/cadastrar', 'TransportadoresController@cadastrar')->name('transportadores.cadastrar');
	    Route::get('/editar/{id}', 'TransportadoresController@editar')->name('transportadores.editar');
	    Route::get('/deletar/{id}', 'TransportadoresController@deletar')->name('transportadores.deletar');
	    Route::post('/inserir', 'TransportadoresController@inserir')->name('transportadores.inserir');
	    Route::post('/alterar/{id}', 'TransportadoresController@alterar')->name('transportadores.alterar');
    });
	Route::prefix('tiposblocos')->group(function () {
	    Route::get('/', 'TiposBlocosController@index')->name('tiposblocos');
	    Route::get('/pesquisa', 'TiposBlocosController@pesquisa')->name('tiposblocos.pesquisa');
	    Route::get('/cadastrar', 'TiposBlocosController@cadastrar')->name('tiposblocos.cadastrar');
	    Route::get('/editar/{id}', 'TiposBlocosController@editar')->name('tiposblocos.editar');
	    Route::get('/deletar/{id}', 'TiposBlocosController@deletar')->name('tiposblocos.deletar');
	    Route::post('/inserir', 'TiposBlocosController@inserir')->name('tiposblocos.inserir');
	    Route::post('/alterar/{id}', 'TiposBlocosController@alterar')->name('tiposblocos.alterar');
    });
	Route::prefix('blocos')->group(function () {
	    Route::get('/', 'BlocosController@index')->name('blocos');
	    Route::get('/pesquisa', 'BlocosController@pesquisa')->name('blocos.pesquisa');
        Route::get('/pesquisa-chapas-serradas', 'BlocosController@pesquisaChapas')->name('blocos.pesquisa.chapas-para-importar');
	    Route::get('/importar-serrada/{bloco}', 'BlocosController@importaSerrada')->name('blocos.importarserrada');
	    Route::get('/lista-serrada/{bloco}', 'BlocosController@listaSerrada')->name('blocos.listaserrada');
	    Route::post('/importar-serrada/{bloco}', 'BlocosController@salvaImportacaoSerrada')->name('blocos.salvaimportacaoserrada');
	    Route::get('/cadastrar', 'BlocosController@cadastrar')->name('blocos.cadastrar');
	    Route::get('/editar/{id}', 'BlocosController@editar')->name('blocos.editar');
	    Route::get('/deletar/{id}', 'BlocosController@deletar')->name('blocos.deletar');
	    Route::post('/inserir', 'BlocosController@inserir')->name('blocos.inserir');
	    Route::post('/alterar/{id}', 'BlocosController@alterar')->name('blocos.alterar');
    });
	Route::prefix('grupos-usuarios')->group(function () {
	    Route::get('/', 'GruposUsuariosController@index')->name('gruposusuarios');
	    Route::get('/pesquisa', 'GruposUsuariosController@pesquisa')->name('gruposusuarios.pesquisa');
	    Route::get('/cadastrar', 'GruposUsuariosController@cadastrar')->name('gruposusuarios.cadastrar');
	    Route::get('/editar/{id}', 'GruposUsuariosController@editar')->name('gruposusuarios.editar');
	    Route::get('/deletar/{id}', 'GruposUsuariosController@deletar')->name('gruposusuarios.deletar');
	    Route::post('/inserir', 'GruposUsuariosController@inserir')->name('gruposusuarios.inserir');
	    Route::post('/alterar/{id}', 'GruposUsuariosController@alterar')->name('gruposusuarios.alterar');
	    Route::get('/acessos/{id}', 'GruposUsuariosController@acessosDisponiveis')->name('gruposusuarios.acessos');
	    Route::get('/acessos-grupos-usuarios/{id}', 'GruposUsuariosController@acessosGruposUsuarios')->name('gruposusuarios.acessosgruposusuarios');
	    Route::post('/libera-acesso', 'GruposUsuariosController@liberarAcesso')->name('gruposusuarios.liberaracesso');
	    Route::post('/remove-acesso', 'GruposUsuariosController@removeAcesso')->name('gruposusuarios.removeacesso');
    });

    Route::resource('estados-chapas', 'ChapasBlocosEstadosController', ['except' => ['show']]);
    Route::get('estados-chapas/pesquisa', 'ChapasBlocosEstadosController@pesquisa')->name('estados-chapas.pesquisa');
    Route::resource('espessuras-chapas', 'ChapasBlocosEspessurasController', ['except' => ['show']]);
    Route::get('espessuras-chapas/pesquisa', 'ChapasBlocosEspessurasController@pesquisa')->name('espessuras-chapas.pesquisa');
    Route::resource('observacoes-chapas', 'ChapasBlocosObservacoesController', ['except' => ['show']]);
    Route::get('observacoes-chapas/pesquisa', 'ChapasBlocosObservacoesController@pesquisa')->name('observacoes-chapas.pesquisa');
    Route::resource('chapas', 'ChapasBlocosController', ['except' => ['show']]);
    Route::get('chapas-form/{bloco}', 'ChapasBlocosController@createForm')->name('chapas.createform');
    Route::resource('tipo-material-processos', 'TipoMaterialProcessosController', ['except' => ['show']]);
    Route::get('tipo-material-processos/pesquisa', 'TipoMaterialProcessosController@pesquisa')->name('tipo-material-processos.pesquisa');
    Route::resource('motivos', 'MotivosController', ['except' => ['show']]);
    Route::get('pesquisa-motivos', 'MotivosController@pesquisa')->name('motivos.pesquisa');
    Route::resource('processos', 'ProcessosController', ['except' => ['show']]);
    Route::get('processos/pesquisa', 'ProcessosController@pesquisa')->name('processos.pesquisa');
    Route::resource('agendamento-processos', 'AgendamentoProcessosController', ['except' => ['show']]);
    Route::resource('chapas-agendamentos', 'ChapaBlocoAgendamentoProcessoController', [
        'except' => ['create', 'edit', 'update','show'],
    ]);
    Route::get('agendamento-processos/pesquisa-chapas', 'AgendamentoProcessosController@pesquisaChapas')->name('agendamento-processos.pesquisa-bloco');

    Route::prefix('executar-processos')->name('executar-processos.')->group(function () {
        Route::get('/', 'ExecutarProcessosController@index')->name('index');
        Route::get('/{agendamento}/edit', 'ExecutarProcessosController@edit')->name('edit');
        Route::post('/concluir-chapas', 'ExecutarProcessosController@concluiChapas')->name('concluir');
        Route::post('/cancelar-chapas', 'ExecutarProcessosController@cancelarChapas')->name('cancelar');
        Route::post('/nao-concluir-chapas', 'ExecutarProcessosController@naoConcluirChapas')->name('naoconcluir');
        Route::get('/{agendamento}/chapas', 'ExecutarProcessosController@chapas')->name('chapas');
    });

    Route::resource('chapas-serradas', 'ChapasSerradasController', ['except' => ['show']]);
    Route::get('chapas-serradas/pesquisa', 'ChapasSerradasController@pesquisa')->name('chapas-serradas.pesquisa');
    Route::get('chapas-serradas/{ordem_de_serrada}/importar-bloco', 'ChapasSerradasController@createForOrder')->name('chapas-serradas.createfororder');
    Route::get('chapas-serradas/{ordem_de_serrada}/edit-for-order', 'ChapasSerradasController@editForOrder')->name('chapas-serradas.editfororder');

    Route::resource('itens-chapas-serradas', 'ItensChapasSerradasController', ['except' => ['show', 'edit', 'update']]);
    Route::resource('fornecedores', 'FornecedoresController', ['except' => ['show']]);
    Route::get('fornecedores/pesquisa', 'FornecedoresController@pesquisa')->name('fornecedores.pesquisa');
    Route::resource('classificacoes-blocos', 'ClassificacoesBlocosController', ['except' => ['show']]);
    Route::get('classificacoes-blocos/pesquisa', 'ClassificacoesBlocosController@pesquisa')->name('classificacoes-blocos.pesquisa');
    Route::resource('blocos-brutos', 'BlocosBrutosController', ['except' => ['show']]);
    Route::get('blocos-brutos/pesquisa', 'BlocosBrutosController@pesquisa')->name('blocos-brutos.pesquisa');
    Route::resource('ordem-de-serradas', 'OrdemDeSerradasController', ['except' => ['show']]);
    Route::get('ordem-de-serradas/pesquisa', 'OrdemDeSerradasController@pesquisa')->name('ordem-de-serradas.pesquisa');
    Route::get('ordem-de-serradas/executar', 'OrdemDeSerradasController@executar')->name('ordem-de-serradas.executar');

    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::get('estoque-chapas-serradas', 'RelatoriosController@estoqueChapasSerradas')->name('estoque-chapas-serradas');
        Route::get('blocos-chapas', 'RelatoriosController@blocosChapas')->name('blocos-chapas');
        Route::get('estoque-blocos', 'RelatoriosController@estoqueBlocos')->name('estoque-blocos');
        Route::get('agendamentos', 'RelatoriosController@agendamentos')->name('agendamentos');
        Route::get('historico-bloco/{numeracao}', 'RelatoriosController@historicoBloco')->name('historico');
    });

    Route::resource('itens-tipos-blocos', 'ItensTiposBlocosController', ['except' => ['index', 'create', 'update', 'edit', 'show']]);
});

Route::get('teste', 'TesteController@teste');
