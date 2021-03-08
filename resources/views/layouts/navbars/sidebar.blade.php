<div class="sidebar ocultarNaImpressao" data-color="orange" data-background-color="white"
     data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    {{--  Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"--}}
    {{--      Tip 2: you can also add an image using data-image tag--}}
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ __(env('APP_NAME')) }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if($user->temAcessoUnico('dashboard'))
                <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">home</i>
                        <p>{{ __('Início') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('profile.edit'))
                <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management' || $activePage == 'gruposusuarios') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p>{{ __('Funcionários/Setores') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div
                        class="collapse {{ ($activePage == 'user-management' || $activePage == 'gruposusuarios') ? ' show' : '' }}"
                        id="laravelExample">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <i class="material-icons">group</i>
                                    <span class="sidebar-normal"> {{ __('Funcionários') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'gruposusuarios' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('gruposusuarios') }}">
                                    <i class="material-icons">groups</i>
                                    <p>{{ __('Setores') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if($user->temAcessoUnico('transportadores'))
                <li class="nav-item{{ $activePage == 'transportadores' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('transportadores') }}">
                        <i class="material-icons">commute</i>
                        <p>{{ __('Transportadores') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('tipos-blocos'))
                <li class="nav-item{{ $activePage == 'tiposblocos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('tiposblocos') }}">
                        <i class="material-icons">view_module</i>
                        <p style="white-space: normal;">{{ __('Cadastro de Material de blocos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('blocos'))
                <li class="nav-item{{ $activePage == 'blocos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('blocos') }}">
                        <i class="material-icons">view_agenda</i>
                        <p>{{ __('Chapa Bruta (Gatti)') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('estados_chapas'))
                <li class="nav-item{{ $activePage == 'estados_chapas' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('estados-chapas.index') }}">
                        <i class="material-icons">calendar_view_day</i>
                        <p>{{ __('Estados de chapas') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('espessuras_chapas'))
                <li class="nav-item{{ $activePage == 'espessuras_chapas' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('espessuras-chapas.index') }}">
                        <i class="material-icons">aspect_ratio</i>
                        <p>{{ __('Espessuras de chapas') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('observacoes_chapas'))
                <li class="nav-item{{ $activePage == 'observacoes_chapas' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('observacoes-chapas.index') }}">
                        <i class="material-icons">flip_to_front</i>
                        <p>{{ __('Qualidade da serrada') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('tipo_material_processos'))
                <li class="nav-item{{ $activePage == 'tipo_material_processos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('tipo-material-processos.index') }}">
                        <i class="material-icons">library_books</i>
                        <p>{{ __('Material de processos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('motivos'))
                <li class="nav-item{{ $activePage == 'motivos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('motivos.index') }}">
                        <i class="material-icons mt-3">cancel_presentation</i>
                        <p style="white-space: normal;">{{ __('Motivos cancelamento/não conclusão de processos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('processos'))
                <li class="nav-item{{ $activePage == 'processos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('processos.index') }}">
                        <i class="material-icons">insights</i>
                        <p>{{ __('Processos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('agendamento_processos'))
                <li class="nav-item{{ $activePage == 'agendamento_processos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('agendamento-processos.index') }}">
                        <i class="material-icons">note_add</i>
                        <p>{{ __('Agendar processos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('executar_processos'))
                <li class="nav-item{{ $activePage == 'executar_processos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('executar-processos.index') }}">
                        <i class="material-icons">perm_data_setting</i>
                        <p>{{ __('Executar processos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('chapas_serradas'))
                <li class="nav-item{{ $activePage == 'chapas_serradas' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('chapas-serradas.index') }}">
                        <i class="material-icons">reorder</i>
                        <p>{{ __('Chapas serradas') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('classificacoes_blocos'))
                <li class="nav-item{{ $activePage == 'classificacoes_blocos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('classificacoes-blocos.index') }}">
                        <i class="material-icons">wysiwyg</i>
                        <p>{{ __('Classificações de blocos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('fornecedores'))
                <li class="nav-item{{ $activePage == 'fornecedores' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('fornecedores.index') }}">
                        <i class="material-icons">supervised_user_circle</i>
                        <p>{{ __('Fornecedores') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('blocos_brutos'))
                <li class="nav-item{{ $activePage == 'blocos_brutos' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('blocos-brutos.index') }}">
                        <i class="material-icons">call_to_action</i>
                        <p>{{ __('Blocos') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('ordem_de_serradas'))
                <li class="nav-item{{ $activePage == 'ordem_de_serradas' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('ordem-de-serradas.index') }}">
                        <i class="material-icons">dvr</i>
                        <p style="white-space: normal;">{{ __('Cadastro de ordem de serradas') }}</p>
                    </a>
                </li>
            @endif
            @if($user->temAcessoUnico('executar_ordem_de_serradas'))
                <li class="nav-item{{ $activePage == 'executar_ordem_de_serradas' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('ordem-de-serradas.executar') }}">
                        <i class="material-icons">list_alt</i>
                        <p>{{ __('Ordem de serradas') }}</p>
                    </a>
                </li>
            @endif
                @php $acessos_relatorios = ['relatorio_estoque_chapas_serradas', 'relatorio_blocos_chapas', 'relatorio_estoque_blocos', 'relatorio_agendamentos'];
                @endphp
            @if($user->temAcessoUnico($acessos_relatorios))
                <li class="nav-item {{ (in_array($activePage, $acessos_relatorios)) ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#relatorios" aria-expanded="false">
                        <i class="material-icons">print</i>
                        <p>{{ __('Relatórios') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (in_array($activePage, $acessos_relatorios)) ? ' show' : '' }}" id="relatorios">
                        <ul class="nav">
                            @if($user->temAcessoUnico('relatorio_estoque_chapas_serradas'))
                            <li class="nav-item{{ $activePage == 'relatorio_estoque_chapas_serradas' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('relatorios.estoque-chapas-serradas') }}" target="_blank">
                                    <i class="material-icons">receipt_long</i>
                                    <span class="sidebar-normal"> {{ __('Estoque de chapas serradas') }} </span>
                                </a>
                            </li>
                            @endif
                            @if($user->temAcessoUnico('relatorio_blocos_chapas'))
                            <li class="nav-item{{ $activePage == 'relatorio_blocos_chapas' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('relatorios.blocos-chapas') }}" target="_blank">
                                    <i class="material-icons">receipt_long</i>
                                    <span class="sidebar-normal">{{ __('Estoque Chapa Bruta (Gatti)') }}</span>
                                </a>
                            </li>
                            @endif
                            @if($user->temAcessoUnico('relatorio_estoque_blocos'))
                            <li class="nav-item{{ $activePage == 'relatorio_estoque_blocos' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('relatorios.estoque-blocos') }}" target="_blank">
                                    <i class="material-icons">receipt_long</i>
                                    <span class="sidebar-normal"> {{ __('Estoque de blocos') }} </span>
                                </a>
                            </li>
                            @endif
                            @if($user->temAcessoUnico('relatorio_agendamentos'))
                            <li class="nav-item{{ $activePage == 'relatorio_agendamentos' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('relatorios.agendamentos') }}" target="_blank">
                                    <i class="material-icons">receipt_long</i>
                                    <span class="sidebar-normal"> {{ __('Agendamentos') }} </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
