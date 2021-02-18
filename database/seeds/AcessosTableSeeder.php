<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class AcessosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acessos = [
            [
                'nome' => "Cadastro de funcionários",
                'unico' => "N",
                'apelido' => "profile.edit",
                'ativo' => "S"
            ],
            [
                'nome' => "DashBoard",
                'unico' => "S",
                'apelido' => "dashboard",
                'ativo' => "S"
            ],
            [
                'nome' => "Menu Lateral",
                'unico' => "S",
                'apelido' => "menu_lateral",
                'ativo' => "S"
            ],
            [
                'nome' => "Cadastro de transportadores",
                'unico' => "N",
                'apelido' => "transportadores",
                'ativo' => "S"
            ],
            [
                'nome' => "Cadastro de classificação de blocos",
                'unico' => "N",
                'apelido' => "tipos-blocos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de Blocos",
                'unico' => "N",
                'apelido' => "blocos",
                'ativo' => "S",
            ],
            [
                'nome' => "Abrir bloco após inserir",
                'unico' => "S",
                'apelido' => "blocos.inserir.redirecionar",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de setores",
                'unico' => "N",
                'apelido' => "gruposusuarios",
                'ativo' => "S",
            ],
            [
                'nome' => "Liberar acessos de setores",
                'unico' => "S",
                'apelido' => "gruposusuarios.acessos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de estado de chapas",
                'unico' => "N",
                'apelido' => "estados_chapas",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de espessuras de chapas",
                'unico' => "N",
                'apelido' => "espessuras_chapas",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de observações de chapas",
                'unico' => "N",
                'apelido' => "observacoes_chapas",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de chapas",
                'unico' => "N",
                'apelido' => "chapas",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de material de processo",
                'unico' => "N",
                'apelido' => "tipo_material_processos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de motivos de não conclusão de processos",
                'unico' => "N",
                'apelido' => "motivo_nao_conclusao_processos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de motivos utilizados em processos",
                'unico' => "N",
                'apelido' => "motivos",
                'ativo' => "S",
            ],
            [
                'nome' => "Processos",
                'unico' => "N",
                'apelido' => "processos",
                'ativo' => "S",
            ],
            [
                'nome' => "Agendamento de processos",
                'unico' => "N",
                'apelido' => "agendamento_processos",
                'ativo' => "S",
            ],
            [
                'nome' => "Executar processos",
                'unico' => "N",
                'apelido' => "executar_processos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de chapas serradas",
                'unico' => "N",
                'apelido' => "chapas_serradas",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de fornecedores",
                'unico' => "N",
                'apelido' => "fornecedores",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de classificação de blocos",
                'unico' => "N",
                'apelido' => "classificacoes_blocos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de blocos brutos",
                'unico' => "N",
                'apelido' => "blocos_brutos",
                'ativo' => "S",
            ],
            [
                'nome' => "Relatório de chapas serradas",
                'unico' => "S",
                'apelido' => "relatorio_estoque_chapas_serradas",
                'ativo' => "S"
            ],
            [
                'nome' => "Relatório de blocos/chapas",
                'unico' => "S",
                'apelido' => "relatorio_blocos_chapas",
                'ativo' => "S"
            ],
            [
                'nome' => "Cadastro de ordem de serradas",
                'unico' => "N",
                'apelido' => "ordem_de_serradas",
                'ativo' => "S",
            ],
            [
                'nome' => "Executar ordem de serrada",
                'unico' => "S",
                'apelido' => "executar_ordem_de_serradas",
                'ativo' => "S",
            ],
            [
                'nome' => "Relatório de agendamentos",
                'unico' => "S",
                'apelido' => "relatorio_agendamentos",
                'ativo' => "S",
            ],
            [
                'nome' => "Cadastro de variação de material de bloco",
                'unico' => "N",
                'apelido' => "itens-tipos-blocos",
                'ativo' => "S",
            ],
        ];

        foreach ($acessos as $a) {
            $acesso = DB::table('acessos')->where(['apelido' => $a['apelido']]);
            if (!$acesso->first())
                DB::table('acessos')->insert(['nome' => $a['nome'], 'unico' => $a['unico'], 'apelido' => $a['apelido'], 'ativo' => $a['ativo'], 'created_at' => now(), 'updated_at' => now()]);
            else
                $acesso->update(['nome' => $a['nome'], 'unico' => $a['unico'], 'ativo' => $a['ativo'], 'updated_at' => now()]);
        }

    }
}
