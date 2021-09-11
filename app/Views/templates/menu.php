<?php
$pagina = basename($_SERVER['PHP_SELF']);
$menu = [
    [
        'titulo' => 'Cadastros555',
        'icone'  => 'home',
        'submenu'  => true,
        'href'  => 'menu-cadastro',
        'pagSelected' => '',
        'itens' => [
            [
                'titulo' => 'Holders',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/Holders',
                'pagSelected' => 'Holders'
            ],
            [
                'titulo' => 'Contas Bancárias',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/ContasBancarias',
                'pagSelected' => 'ContasBancarias'
            ],
            [
                'titulo' => 'Plano de Contas',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/PlanoContas',
                'pagSelected' => 'PlanoContas'
            ],
            [
                'titulo' => 'Lançamentos Padrões',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/LancamentosPadroes',
                'pagSelected' => 'LancamentosPadroes'
            ],
            [
                'titulo' => 'Produtos e Serviços',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/ProdutosServicos',
                'pagSelected' => 'ProdutosServicos'
            ],
            [
                'titulo' => 'Produtos e Serviços por Agências',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/ProdutosServicosAgencia',
                'pagSelected' => 'ProdutosServicosAgencia'
            ],
            [
                'titulo' => 'Agências (Marketplace)',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/Agencias',
                'pagSelected' => 'Agencias'
            ],
            /*[
                'titulo' => 'Adquirentes',
                'icone'  => '',
                'submenu'  => false,
                'href'  => '',
                'pagSelected' => 'Adquirentes'
            ],
            [
                'titulo' => 'Fornecedores',
                'icone'  => '',
                'submenu'  => false,
                'href'  => '',
                'pagSelected' => 'Fornecedores'
            ]*/
        ]
    ],
    [
        'titulo' => 'Compliance',
        'icone'  => 'shield-account',
        'submenu'  => false,
        'href'  => base_url() . '/Home/Compliance',
        'pagSelected' => 'Compliance'
    ],
    [
        'titulo' => 'Lançamentos',
        'icone'  => 'format-list-checkbox',
        'submenu'  => false,
        'href'  => base_url() . '/Home/Lancamentos',
        'pagSelected' => 'Lancamentos'
    ],
    [
        'titulo' => 'Relatórios',
        'icone'  => 'chart-bar',
        'submenu'  => true,
        'href'  => 'menu-relatorios',
        'pagSelected' => '',
        'itens' => [
            [
                'titulo' => 'Movimento',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioMovimento',
                'pagSelected' => 'relatorioMovimento'
            ],
            [
                'titulo' => 'Receitas',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioReceitas',
                'pagSelected' => 'relatorioReceitas'
            ],
            [
                'titulo' => 'Despesas',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioDespesas',
                'pagSelected' => 'relatorioDespesas'
            ],
            [
                'titulo' => 'Lucro Líquido',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioLucroLiquido',
                'pagSelected' => 'relatorioLucroLiquido'
            ],
            [
                'titulo' => 'Operações',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioOperacoes',
                'pagSelected' => 'relatorioOperacoes'
            ],
            [
                'titulo' => 'Produtos/Servicos',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioProdutosServicos',
                'pagSelected' => 'relatorioProdutosServicos'
            ],
            [
                'titulo' => 'DRE',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioDRE',
                'pagSelected' => 'relatorioDRE'
            ],
            [
                'titulo' => 'Holders',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioHolders',
                'pagSelected' => 'relatorioHolders'
            ],
            [
                'titulo' => 'Status C/C',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioStatusCC',
                'pagSelected' => 'relatorioStatusCC'
            ],
            [
                'titulo' => 'Lançamentos por NSU',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/relatorioRegistroLancamentos',
                'pagSelected' => 'relatorioRegistroLancamentos'
            ],
        ]
    ],
    [
        'titulo' => 'Configurações',
        'icone'  => 'folder-cog-outline',
        'submenu'  => true,
        'href'  => 'menu-configuracoes',
        'pagSelected' => '',
        'itens' => [
            [
                'titulo' => 'Gerais',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/ConfigGerais',
                'pagSelected' => 'ConfigGerais'
            ],
            [
                'titulo' => 'Tipo Endereço',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoEndereco',
                'pagSelected' => 'TipoEndereco'
            ],
            [
                'titulo' => 'Tipo Empresa',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoEmpresa',
                'pagSelected' => 'TipoEmpresa'
            ],
            [
                'titulo' => 'Tipo Documentos',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoDocumento',
                'pagSelected' => 'TipoDocumento'
            ],
            [
                'titulo' => 'Tipo CBO',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoCbo',
                'pagSelected' => 'TipoCbo'
            ],
            [
                'titulo' => 'Tipo CNAES',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoCnae',
                'pagSelected' => 'TipoCnae'
            ],
            [
                'titulo' => 'Tipo Conta',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoConta',
                'pagSelected' => 'TipoConta'
            ],
            [
                'titulo' => 'Tipo Moedas',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoMoedas',
                'pagSelected' => 'TipoMoedas'
            ],

            [
                'titulo' => 'ISPB (Bancos)',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/TipoISBP',
                'pagSelected' => 'TipoISBP'
            ],

            [
                'titulo' => 'Status Holders',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/StatusHolders',
                'pagSelected' => 'StatusHolders'
            ],

            [
                'titulo' => 'Comprovantes (TAGS)',
                'icone'  => '',
                'submenu'  => false,
                'href'  => base_url() . '/Home/Tags',
                'pagSelected' => 'Tags'
            ],

            [
                'titulo' => 'Botão de Pânico',
                'icone'  => '',
                'submenu'  => false,
                'href'  => 'panico()',
                'pagSelected' => ''
            ]
        ]
    ]
];

?>


<aside class="div-menu">
    <div class="nome-global">
        <div class="col-md-2 center fc-branco pl-20 mt-0">
            <img class="logo-topo" src="<?php echo base_url('/public/img/logo.png'); ?>">
        </div>
    </div>
    <div class="abrirFecharMenu" data-toggle="tooltip" data-bs-placement="right" title="Fechar Menu">
        <i class="mdi mdi-backburger"></i>
    </div>
    <ul class="nav flex-column">
        <?php
        foreach ($menu as $item) {
            $atributosLink = 'href="' . $item['href'] . '"';
            if ($item['submenu']) {
                $atributosLink = 'data-bs-toggle="collapse" href="#' . $item['href'] . '" role="button" aria-expanded="false" aria-controls="' . $item['href'] . '"';
            }
            $ativo = ($item['pagSelected'] == $pagina) ? 'pagSelected' : '';
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $ativo ?>" <?= $atributosLink ?>>
                    <?= (!empty($item['icone'])) ? '<i class="mdi mdi-' . $item['icone'] . '"></i>' : '' ?>
                    <?= $item['titulo'] ?>
                    <?= ($item['submenu']) ? '<span class="float-end"><i class="mdi mdi-chevron-right"></i></span>' : '' ?>
                </a>
                <?php if ($item['submenu']) { ?>

                    <div class="collapse submenu" id="<?= $item['href'] ?>">
                        <ul class="nav flex-column">
                            <?php
                            foreach ($item['itens'] as $item) {

                                $cursor = ($item['href'] == 'panico()') ? 'style="cursor:pointer;"' : '';
                                $tag = ($item['href'] == 'panico()') ? 'onclick' : 'href';

                                $atributosLink = $tag . '="' . $item['href'] . '"';
                                //$atributosLink = 'href="' . $item['href'] . '"';

                                $ativo = ($item['pagSelected'] == $pagina) ? 'pagSelected' : '';
                            ?>
                                <li class="nav-item">
                                    <a <?= $cursor ?> class="nav-link <?= $ativo ?>" <?= $atributosLink ?>>
                                        <?= (!empty($item['icone'])) ? '<i class="mdi mdi-' . $item['icone'] . '"></i>' : '' ?> <?= $item['titulo'] ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                <?php
                }
                ?>

            </li>
        <?php
        }
        ?>
    </ul>
</aside>