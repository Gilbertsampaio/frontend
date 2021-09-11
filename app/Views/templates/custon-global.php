<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('/public/js/bootstrap-toggle.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

<?php
$session = session();
$nomeUsuarioLogado = (!empty($session->get('name'))) ? $session->get('name') : ' - ';
?>

<script>
    function zeraDataTable(tempo) {

        let columns = $("#tabela > thead > tr > th").length;
        $("#tabelaListagem").html(`<tr>
						<td colspan="${columns}" class="text-center td-bg">
							Nenhum registro encontrado
						</td>
					</tr>`);
        gifOn();

        setTimeout(() => {
            gifOff(tempo);
        }, 10);


        let tab = $('#tabela');

        if ($.fn.dataTable.isDataTable(tab)) {
            table = tab.DataTable();
            table.clear();
            table.draw();
            table.destroy();
        }

    }

    function resetDataTable(tableId) {

        let tab = $('#' + tableId);

        if ($.fn.dataTable.isDataTable(tab)) {
            table = tab.DataTable({
                destroy: true,
                searching: true,
                retrieve: true,
                paging: true
            });
            table.clear();
            table.draw();
            table.destroy();
        }
    }

    function setDataTable(tableId, coluna = null, todos = 10) {

        let tab = $('#' + tableId);

        table = tab.DataTable({

            columnDefs: coluna,
            order: [1, 'esc'],
            ordering: false,
            language: {
                'search': 'Filtrar',
                "thousands": ".",
                'emptyTable': 'Nenhum registro encontrado',
                "zeroRecords": 'Nenhum registro encontrado',
                'lengthMenu': '_MENU_ por página',
                /*"infoEmpty"         : "Exibindo 0 a 0 de 0 registros",*/
                "infoEmpty": "Aguardando registros para exibição",
                "info": "Exibindo _START_ a _END_ de _TOTAL_ registros",
                "infoFiltered": "",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "<i class='mdi mdi-chevron-double-right'></i>",
                    "previous": "<i class='mdi mdi-chevron-double-left'></i>"
                }
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "TODOS"]
            ],
            iDisplayLength: todos,
            destroy: false,
            searching: true,
            retrieve: true,
            paging: true,

        });

        $('select[name="tabela_length"]').addClass('form-select pt-2');
        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_filter').addClass('pb-10');

        let info = table.page.info();
        let linhasApagar = table.rows().$('.removerLinhaDataTable').length;
        let diferenca = parseInt(info.recordsTotal - linhasApagar);

        if (diferenca <= 9) {
            totalSelectTabela = diferenca;
        } else {
            totalSelectTabela = $('[name=tabela_length').val();
        }

        let totalPorPagina = (totalSelectTabela == '-1' || diferenca < totalSelectTabela) ? diferenca : totalSelectTabela;


        $('#tabela_info').html(`Exibindo ${diferenca == 0 ? 0 : 1} a ${totalPorPagina} de ${diferenca} registros`)

    }

    $(document).on('change', '[name=tabela_length]', function() {
        let tab = $('#tabela');
        let info = tab.DataTable().page.info();
        let linhasApagar = table.rows().$('.removerLinhaDataTable').length;
        let diferenca = parseInt(info.recordsTotal - linhasApagar);

        if (diferenca <= 9) {
            totalSelectTabela = diferenca;
        } else {
            totalSelectTabela = $('[name=tabela_length').val();
        }

        let totalPorPagina = (totalSelectTabela == '-1' || diferenca < totalSelectTabela) ? diferenca : totalSelectTabela;

        $('#tabela_info').html(`Exibindo ${diferenca == 0 ? 0 : 1} a ${totalPorPagina} de ${diferenca} registros`)

    })

    $(document).on('keyup', '#tabela_filter input', function() {
        let valor = $(this).val();
        let tab = $('#tabela');
        let info = tab.DataTable().page.info();
        let linhasApagar = table.rows().$('.removerLinhaDataTable').length;
        let diferenca = parseInt(info.recordsTotal - linhasApagar);

        if (diferenca <= 9) {
            totalSelectTabela = diferenca;
        } else {
            totalSelectTabela = $('[name=tabela_length').val();
        }

        let totalPorPagina = (totalSelectTabela == '-1' || diferenca < totalSelectTabela) ? diferenca : totalSelectTabela;

        if (valor == "") {
            $('#tabela_info').html(`Exibindo ${diferenca == 0 ? 0 : 1} a ${totalPorPagina} de ${diferenca} registros`)
        }
    })

    $(document).on('click', '#cardBody > div > div > button', function() {
        $(this).html(`<div class="spinner-border text-light" role="status">
                        <span class="sr-only"></span>
                    </div> Alterar Filtro`);
    })




    $('.modal').on('shown.bs.modal', function(e) {

        if (!$('#cardBody > div > div > button').html('<i class="mdi mdi-sync"></i> Alterar Filtro')) {
            $('#cardBody > div > div > button').html('<i class="mdi mdi-sync"></i> Alterar Filtro');
        }

        if (!$('#cardBody > div > h5 > span > #botaoAlterarFiltro').html('<i class="mdi mdi-sync"></i> Alterar Filtro')) {
            $('#cardBody > div > h5 > span > #botaoAlterarFiltro').html('<i class="mdi mdi-sync"></i> Alterar Filtro');
        }

        if (!$('#cardBody > div > h5 > span > #botaoInserirLancamento').html('<i class="mdi mdi-plus"></i> Inserir Lançamento')) {
            $('#cardBody > div > h5 > span > #botaoInserirLancamento').html('<i class="mdi mdi-plus"></i> Inserir Lançamento');
        }

        if ($('.iconeFiltroBotao').hasClass('d-none')) {
            $('.iconeFiltroBotao').removeClass('d-none');
            $('.iconeFiltroBotaoSpinner').addClass('d-none');
        }

        if ($('.iconeCadastrar').hasClass('d-none')) {
            $('.iconeCadastrar').removeClass('d-none');
            $('.iconeCadastrarBotaoSpinner').addClass('d-none');
        }

        $('button').removeClass('disabled');
    })

    $(document).on('click', '#botaoAlterarFiltro, #botaoInserirLancamento', function() {
        let objeto = $(this).attr('id');
        $(this).html(`<div style="height:12px; width:12px;" class="spinner-border text-light" role="status">
                        <span class="sr-only"></span>
                    </div> ${objeto == 'botaoAlterarFiltro' ? 'Alterar Filtro' : 'Inserir Lançamento' }`);
    })

    $(document).on('click', '#filtroRelatorio', function() {
        $('.iconeFiltroBotao').addClass('d-none');
        $('.iconeFiltroBotaoSpinner').removeClass('d-none');
    })

    $(document).on('click', '#addRegistro', function() {
        $('.iconeCadastrar').addClass('d-none');
        $('.iconeCadastrarBotaoSpinner').removeClass('d-none');
    })

    $(document).on('click', 'button', function() {

        let elemento = $(this);
        let modalPai = elemento.parent().parent().parent().find(elemento);
        let divModal = modalPai.closest('.note-editor');
        let classe = '';

        if (divModal[0]) {
            classe = divModal[0].classList[0];
        } else {
            classe = '';
        }

        if (classe != 'note-editor') {
            elemento.addClass('disabled');
        }
    })


    window.onload = function() {

        atualizaConteudo();
        selecionarMenu();
        let tempo = '';

        $('#tabelaListagem > tr > td').prepend(`<div class="spinner-border text-light" role="status">
                                                <span class="sr-only"></span>
                                            </div>`);

    };

    function loadBuscarHolder(e, numero) {

        if (numero == 1) {
            $(e).html(`<div class="spinner-border text-light" role="status">
						<span class="sr-only"></span>
					</div>`);
        } else if (numero == 2) {
            $(e).html(`<i class="mdi mdi-magnify"></i>`);
        } else if (numero == 3) {
            $(e).html(`<i class="mdi mdi-magnify"></i>`);
            $("#national_registration ~ a").addClass("disabled");
        }
    }

    function alertaErro(erro, mensagem, acao = null, modal = null) {

        let label = '';
        let titulo = $('.modal-title').html();

        if (acao == 'Cadastrar') {
            label = 'btn-success';
            addLabel = 'btn-danger';
        } else if (acao == 'Editar') {
            label = 'btn-primary';
            addLabel = 'btn-danger';
        } else if (acao == 'Localizado') {
            label = 'btn-success';
            addLabel = 'btn-warning';
        } else if (acao == 'Panico') {
            label = 'btn-danger';
            addLabel = 'btn-warning';
            $('#email').val('').attr('readonly', false).focus();
            $('#password').val('').attr('readonly', false);
            $('#botPanico').removeClass('disabled').html('Confirmar');
        }

        $('.modal'+modal+' .modal-header').removeClass(label);
        $('.modal'+modal+' .modal-header').addClass(addLabel);

        if (erro == 501) {
            msgTexto = 'Um erro inesperado ocorreu. Tente mais tarde.';
        } else if (erro == 222) {
            msgTexto = '<i class="mdi mdi-message-alert"></i> ' + mensagem;
        } else {
            msgTexto = '<i class="mdi mdi-message-alert"></i> ' + mensagem;
        }

        $('.modal'+modal+' .modal-title').html(msgTexto);

        setTimeout(function() {
            $('.modal'+modal+' .modal-title').html(titulo);
            $('.modal'+modal+' .modal-header').addClass(label);
            $('.modal'+modal+' .modal-header').removeClass(addLabel);

        }, 5000)
    }

    function alertaErroFiltro(erro, mensagem) {

        let titulo = $('.modal-title').html();

        $('input').val('');
        $('.modal-header').addClass('btn-danger');
        $('.modal-header').removeClass('btn-primary');
        $('.modal-title').html(erro == 501 ? 'Um erro inesperado ocorreu. Tente mais tarde.' : '<i class="mdi mdi-message-alert"></i> ' + mensagem);

        setTimeout(function() {
            $('.modal-title').html(titulo);
            $('.modal-header').addClass('btn-primary');
            $('.modal-header').removeClass('btn-danger');
        }, 5000)
    }

    function selecionarMenu() {
        $('.nav-link.pagSelected').parent().parent().parent().toggleClass('show');
        $('.nav-link.pagSelected').parent().parent().parent().prev().toggleClass('pagSelected ativo').attr('aria-expanded', 'true');
    }

    $(document).on('click', '#botCadastrar, #botFiltrar, #botSelecionar, #statusHolderBotao, #inserirModelo, #botPanico', function() {

        let nomeBotao = $(this).html();
        let elemento = $(this);

        loadBotao(nomeBotao, elemento, 1)

    })

    function loadBotao(nomeBotao = null, elemento = null, acao = null) {

        if (acao == 1) {

            elemento.addClass('disabled').html(`<div class="spinner-border text-light" role="status">
                                                <span class="sr-only"></span>
                                            </div> ${nomeBotao}`);

            let modalPai = elemento.parent().parent().find(elemento);
            let divModal = modalPai.closest('.modal');
            divModal.find('input, textarea, .form-select').attr('readonly', true);

        } else {

            $('#botCadastrar, #botFiltrar, #botSelecionar, #statusHolderBotao, #inserirModelo, #botPanico').removeClass('disabled').html(`${nomeBotao}`);
            $('input, textarea, .form-select').attr('readonly', false);
        }

    }

    function loadingPage(tempo = null) {
        //=$('.loading').toggleClass('d-none');
    }

    function gifOn() {

        //let gif = '<?php echo base_url('public/img/ok.gif') ?>';

        //$('.gif-confirm').attr('src', gif).toggleClass('d-none');
        //$('.loader').toggleClass('gif');
        //$('.circular').toggleClass('d-none');
    }

    function gifOffModal() {
        //$('.loading').toggleClass('d-none');
        //$('.circular').toggleClass('d-none');
        //$('.loader').toggleClass('gif');
        //$('.gif-confirm').toggleClass('d-none');
        //let img = document.querySelector(".gif-confirm");
        //img.setAttribute('src', '');
    }

    function gifOff(tempo = null, tempoConfirma = null) {
        //$('.loading').toggleClass('d-none');
        //$('.circular').toggleClass('d-none');
        //$('.loader').toggleClass('gif');
        //$('.gif-confirm').toggleClass('d-none');
        //let img = document.querySelector(".gif-confirm");
        //img.setAttribute('src', '');

        if ($('.modal').hasClass(tempo) || $('.modal2').hasClass(tempoConfirma)) {
            $('.modal').modal('hide');

            if ($('.modal2').hasClass(tempoConfirma)) {
                $('.modal2').modal('hide');
            }
        }
    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });

        $('[data-toggle="tooltip"]').on('click', function() {
            $(this).tooltip('hide')
        });
    });

    $(document).on('click', 'aside > ul > li > .nav-link', function() {
        if (!$(this).hasClass('ativo')) {
            $('.nav-link.ativo').removeClass('ativo');
            $('.submenu').removeClass('show');
        }

        $(this).toggleClass('ativo');
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $(document).on('click', '#filtroBotao', function() {
        let filtro = $('#filtroTabela');
        filtro.toggleClass('oculto');

        if (filtro.hasClass('oculto')) {
            $('.iconFilter').html(`<path fill="#fff" ng-attr-d="{{icon.data}}" d="M21 8H3V6H21V8M13.81 16H10V18H13.09C13.21 17.28 13.46 16.61 13.81 16M18 11H6V13H18V11M18 15V18H15V20H18V23H20V20H23V18H20V15H18Z"></path>`)
            $('#filtroBotao').attr('data-bs-original-title', 'Exibir Filtro');
        } else {
            $('.iconFilter').html(`<path fill="#fff" ng-attr-d="{{icon.data}}" d="M21 8H3V6H21V8M13.81 16H10V18H13.09C13.21 17.28 13.46 16.61 13.81 16M18 11H6V13H18V11M21.12 15.46L19 17.59L16.88 15.46L15.47 16.88L17.59 19L15.47 21.12L16.88 22.54L19 20.41L21.12 22.54L22.54 21.12L20.41 19L22.54 16.88L21.12 15.46Z"></path>`)
            $('#filtroBotao').attr('data-bs-original-title', 'Ocultar Filtro');
        }
    })

    $('.modal').on('hidden.bs.modal', function(event) {
        $('main, .card-header').removeClass('modal-open');
        $('.modal').attr('class', 'modal fade');

        if ($('.modal').attr('id') == 'modalTags') {
            $('.modal-body').attr('style', '');
            $('.modal-footer').attr('style', '');
            $('.modal-header').attr('style', '');
        }

        $('.modal').removeAttr('id');
    })

    $('.modal2').on('hidden.bs.modal', function(event) {
        $('main, .card-header').removeClass('modal-open');
        $('.modal2 .modal-title').html('');
        $('.modal2 .modal-body').html('').removeAttr('style');
        $('.modal2').attr({
            'class': 'modal2 fade'
        });
        $('.modal2').removeAttr('id');
    })

    $(document).on('click', '.abrirFecharMenu', function() {
        $('aside').toggleClass('close');
        $('main').toggleClass('full');
        $('.card-header').toggleClass('full');

        if ($('.div-menu').hasClass('close')) {
            $(this).attr({
                'data-bs-original-title': 'Abrir Menu'
            });
        } else {
            $(this).attr({
                'data-bs-original-title': 'Fechar Menu'
            });
        }
    })

    $(document).on("change", ".inputDocumentos", function() {
        var file = this.files[0].name;
        var dflt = $(this).attr("placeholder");

        if (file.length < 40) {
            var radical = file;
        } else {
            var prefixo = file.substr(0, 15);
            var sufixo = file.substr(-15, 15);
            var radical = prefixo + '...' + sufixo;
        }

        $(this).prev().css('background', '#64bc36');

        if ($(this).val() != "") {
            $(this).prev().text(radical);
        } else {
            $(this).prev().text(dflt);
        }
    });

    $(document).on('click', '.selectLanguage', function() {
        let imgIdioma = $(this).find('img').attr('src');
        $('.imgIdiomaSelected').attr('src', imgIdioma);
    })

    $(document).on('click', '.selectPrice', function() {
        let imgPrice = $(this).attr('data-idioma');
        $('.imgPriceSelected').attr('src', imgPrice);
        //let nomeImg = imgPrice.split('.')[0];
        //$('.imgPriceSelected').attr('src', nomeImg+'-b.png');
    })

    function abrirLink(link) {
        window.location = link
    }

    function habilitar(check, input) {

        if (document.getElementById(check).checked) {
            document.getElementById(input).removeAttribute("disabled");
            document.getElementById(input).placeholder = "Informe o motivo da negação";
            document.getElementById(input).focus();
            $('#' + input).parent().prev().prev().toggleClass('show');
            document.getElementById(input).setAttribute("data-status-img", 0);

            let mensagem = document.getElementById(input).getAttribute("data-description-img");
            document.getElementById(input).value = mensagem;

            /*document.getElementById("status_holder_id").value = "6";

            let selectStatusHolder = document.getElementById("status_holder_id");
            var options = selectStatusHolder.getElementsByTagName('option');

            for (var i = 0; i < options.length; i++) {
                if (options[i].value == 1 || options[i].value == 2 || options[i].value == 3 ||
                    options[i].value == 4 || options[i].value == 5 || options[i].value == 7 ||
                    options[i].value == 8 || options[i].value == 9 || options[i].value == 10 ||
                    options[i].value == 11 || options[i].value == "") {

                    selectStatusHolder.removeChild(options[i]);
                    i--;
                }
            }*/

        } else {

            document.getElementById(input).value = "";
            document.getElementById(input).setAttribute("disabled", true);
            document.getElementById(input).placeholder = "Marque a caixa ao lado para negar o documento";
            $('#' + input).parent().prev().prev().toggleClass('show');

            let checado = $(':checkbox:checked').length;

            if (checado == 0) {

                /*let selectStatusHolder = document.getElementById("status_holder_id");

                var settings = {
                    url: "<?php echo base_url('API/HolderStatus') ?>",
                    method: "POST"
                }

                $.ajax(settings).done(function(response) {

                    $.each(response, function(index, val) {

                        let option = document.createElement("option");

                        if (val.id != 6) {
                            option.value = val.id;
                            option.text = val.id + ' - ' + val.nome;
                            selectStatusHolder.add(option, selectStatusHolder.options[index]);
                        }
                    })

                    let optionVazio = document.createElement("option");
                    optionVazio.value = "";
                    optionVazio.text = 'Escolha uma opção';
                    selectStatusHolder.add(optionVazio, selectStatusHolder.options);
                    selectStatusHolder.value = "";
                })*/
            }

            document.getElementById(input).setAttribute("data-status-img", 1);

        }

        $('#' + input).parent().prev().toggleClass('imgBorrada');
    }

    function mascaraReal() {
        $('money').mask({
            decimal: ',',
            thousands: '.',
            precision: 2
        }, {
            reverse: true
        });
    }

    function somenteNumero() {
        $('.numero').mask("#", {
            reverse: true
        });
    }

    function mascaraPercentual() {
        $('.percentual').mask('##0,00%', {
            reverse: true
        });
    }

    function mascaraCPF() {
        $('.cpf').mask('###.###.###-##', {
            reverse: true
        });
    }

    function mascaraCNPJ() {
        $('.cnpj').mask('##.###.###/####-##', {
            reverse: true
        });
    }

    var options = {
        onKeyPress: function(cpf, ev, el, op) {
            var masks = ['###.###.###-###', '##.###.###/####-##'];
            $('.cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }

    $('.cpf_cnpj').length > 11 ? $('.cpf_cnpj').mask('##.###.###/####-##', options) : $('.cpf_cnpj').mask('###.###.###-###', options);

    function formatarReal(v) {
        v = v.toString().replace(/\D/g, "");
        v = (v / 100).toFixed(2) + '';
        v = v.replace(".", ",");
        v = v.toString().replace(/(\d)(\d{8})$/, "$1.$2");
        v = v.toString().replace(/(\d)(\d{5})$/, "$1.$2");
        v = v.toString().replace(/(\d)(\d{2})$/, "$1,$2");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
        return v
    }

    function formatarData(date) {
        if (!date) {
            return ' - '
        }
        date = `${date}`
        var parts = date.split(/[- :]/);
        var v = parts[2] + '/' + parts[1] + '/' + parts[0];
        return v
    }

    function removerCaracteres(v) {
        v = `${v}`
        return v.replace(/\D/g, '');
    }

    function converterData(data) {
        data = data.split('-').reverse().join('/');
        return data
    }

    function reverterData(data) {
        data = `${data}`
        var dia = data.split("/")[0];
        var mes = data.split("/")[1];
        var ano = data.split("/")[2];
        return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
    }

    function cnpj(v) {
        v = `${v}`
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d{2})(\d)/, "$1.$2")
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    function soNumero(string) {
        string = `${string}`
        return string.replace(/\D/g, '');
    }

    function maskCC(v) {
        v = `${v}`
        while (v.length < 6) {
            v = '0' + v
        }
        return v
    }

    function cpf(v) {
        v = `${v}`
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
        return v
    }

    function cep(v) {
        v = `${v}`
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{2})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1-$2")
        return v
    }

    function telefone(v) {
        regex = /^(.{1,2})(.{4,5})(.{4})/g;
        v = `${v}`;
        subst = `($1)$2-$3 `;

        v = v.replace(regex, subst);
        return v
    }

    $(document).on('keypress', '.soNumero', function(e) {
        var key = (window.event) ? event.keyCode : e.which;
        if ((key > 47 && key < 58)) {
            //$(this).css('background', '#fff');
            return true;
        } else {
            //$(this).css('background', '#ff0000');
            return (key == 8 || key == 0) ? true : false;
        }
    });

    function encurtadorNome(file) {
        var prefixo = file.substr(0, 15);
        var sufixo = file.substr(-15, 15);
        var radical = prefixo + '...' + sufixo;
        return radical
    }

    function limiteImagemUpload(e, callback = 0) {
        var input, file;
        var Title = 'Erro!';

        if (!window.FileReader) {
            simpleMsg('erro', Title, 'API ainda não suportada em seu navegador. Tenha certeza que sua imagem não ultrapassa 8.1MB.');
            return;
        }

        input = e;
        if (!input) {
            simpleMsg('erro', Title, 'Input do arquivo não encontrado. Tenha certeza que sua imagem não ultrapassa 8.1MB.');
        } else if (!input.files) {
            simpleMsg('erro', Title, 'Este navegador não suporta a propriedade \'files\' dos inputs de arquivos. Tenha certeza que sua imagem não ultrapassa 8.1MB.');
        } else {
            file = input.files[0];
            var sizelimit = 2097152;
            if (file.size >= sizelimit) {
                simpleMsg('erro', Title, 'Tamanho do arquivo excede o limite (2MB). Por favor, selecione outra imagem.');
                clearFile(e, callback);
            }
        }
    }


    function panico() {
        loadingPage();

        let idModal = 'modalPanico';
        let modale = '';

        if ($('.modal').hasClass('show')) {
            modale = $('.modal2');
        } else {
            modale = $('.modal');
        }

        let elemento = modale;

        let modal = new bootstrap.Modal(elemento, {
            keyboard: false,
            focus: true,
            backdrop: 'static'
        });

        tempoPanico = 'time_' + new Date().getTime();
        elemento.addClass(tempoPanico);

        //pequeno: 'sm' - padrão: '' - grande: 'lg' - muito grande: 'xl' - tela cheia: 'fullscreen'
        let tamanho = 'md';

        //modal-dialog-centered
        let centro = '';

        //modal-dialog-scrollable
        let rolagem = '';

        let label = 'danger';

        elemento.attr('id', idModal);
        elemento.find('.modal-header').attr('class', 'modal-header btn-' + label);
        elemento.find('.modal-dialog').attr('class', 'modal-dialog modal-' + tamanho + ' ' + centro + ' ' + rolagem);
        elemento.find('.modal-title').html('<i class="mdi mdi-car-emergency"></i> Botão de Pânico - Travamento de Sistema');
        elemento.find('.modal-body').html(`<div class="row">
                                                <div class="col-md-12 justify">
                                                    <label class="form-label negrito">LEIA COM ATENÇÃO:</label>
                                                    <div>Você está prestes a tornar o sistema <b>INOPERANTE</b> por acreditar que as informações e operações do sistema correm risco de vulnerabilidade.
                                                    Dessa forma, para confirmar a autenticidade desta ação, soclitamos que informe a sua senha de acesso abaixo:</div>
                                                </div>
                                                <input type="hidden" id="bloqueio_transacoes">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Digite o E-mail MASTER<small>*</small></span>
                                                        <input autocomplete="off" type="text" class="form-control" name="email" id="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Digite a senha MASTER<small>*</small></span>
                                                        <input autocomplete="off" type="password" class="form-control" name="password" id="password">
                                                        <span id="verSenha" class="input-group-text cursorPointer"><i class="mdi mdi-eye"></i></span>
                                                    </div>
                                                </div>
                                            </div>`);
        elemento.find('.modal-footer').html(`
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button onclick="confirmarPanico('${tempoPanico}')" id="botPanico" class="btn btn-danger">Confirmar</button>
                                                
                                                `);
        elemento.find('.modal-footer').css({
            'justify-content': 'flex-end',
            'padding-bottom': '20px'
        });
        modal.show();

        $('#bloqueio_transacoes').val(1);

        setTimeout(function() {
            loadingPage();
        }, 120);

        setTimeout(function() {
            $('#email').focus();
        }, 500);

        acoesAuxiliares();
        return false;
    }

    function confirmarPanico(tempoPanico = null) {

        loadingPage(tempoPanico);

        let bloqueio_transacoes = $('#bloqueio_transacoes').val();
        let email = $('#email').val();
        let password = $('#password').val();

        let Data = {
            bloqueio_transacoes,
            email,
            password
        }

        var queryAPI = '<?php echo base_url('API/Configurador/update') ?>';

        var settings = {
            url: queryAPI,
            method: "POST",
            data: Data
        }

        $.ajax(settings).done(function(response) {

            if (response.status == 0) {
                alertaErro('Erro de Permissão', response.validation + '!', 'Panico');
            } else {
                fecharModalPanico(tempoPanico);
            }

        }).fail(function(status) {

            loadingPage();
            alertaErro(status.responseJSON.error, 'Ocorre um erro inesperado! Tente mais tarde.');
            return false;
        });

        return false;
    }

    function fecharModalPanico(tempoPanico) {

        if ($('.modal').hasClass(tempoPanico) || $('.modal2').hasClass(tempoPanico)) {

            $('.modal').modal('hide');

            if ($('.modal2').hasClass(tempoPanico)) {
                $('.modal2').modal('hide');
            }
        }
    }

    $(document).on('click', '#verSenha', function(event) {
        event.preventDefault();
        if ($('#password').attr("type") == "text") {
            $('#password').attr('type', 'password');
            $('#verSenha i').addClass("mdi-eye");
            $('#verSenha i').removeClass("mdi-eye-off");
        } else if ($('#password').attr("type") == "password") {
            $('#password').attr('type', 'text');
            $('#verSenha i').removeClass("mdi-eye");
            $('#verSenha i').addClass("mdi-eye-off");
        }
    });


    function formAlteraSenha() {
        loadingPage();

        var idModal = 'modalAbrir';
        var elemento = $('.modal');

        var modal = new bootstrap.Modal(elemento, {
            keyboard: false,
            focus: true,
            backdrop: 'static'
        });

        //pequeno: 'sm' - padrão: '' - grande: 'lg' - muito grande: 'xl' - tela cheia: 'fullscreen'
        var tamanho = 'md';

        //modal-dialog-centered
        var centro = '';

        //modal-dialog-scrollable
        var rolagem = '';

        var label = 'primary';

        elemento.attr('id', idModal);
        elemento.find('.modal-header').attr('class', 'modal-header btn-' + label);
        elemento.find('.modal-dialog').attr('class', 'modal-dialog modal-' + tamanho + ' ' + centro + ' ' + rolagem);
        elemento.find('.modal-title').html('Alterar senha');
        elemento.find('.modal-body').html(`
                                            <form id="formAlterarSenha">
                                                <span id="altera_senha_error" class="text-danger"></span>
                                                <span id="altera_senha_success" class="text-success"></span>
                                                <div class="row" id="senha_inputs">

                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text col-5">Digite a senha atual <small>*</small></span>
                                                            <input autocomplete="off" type="password" aria-label="Senha atual" class="form-control" name="password" id="password" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text col-5">Defina a nova senha<small>*</small></span>
                                                            <input autocomplete="off" type="password" aria-label="Nova senha" class="form-control" name="new_password" id="new_password" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text col-5">Confirme a nova senha<small>*</small></span>
                                                            <input autocomplete="off" type="password" aria-label="Confirme nova senha" class="form-control" name="new_password_confirm" id="new_password_confirm" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>`);
        elemento.find('.modal-footer').html(`
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button type="submit" form="formAlterarSenha" id="bt_enviar" class="btn btn-primary">Enviar</button>
                                                
                                                `);
        elemento.find('.modal-footer').css({
            'justify-content': 'flex-end',
            'padding-bottom': '20px'
        });
        modal.show();

        setTimeout(function() {
            loadingPage();
        }, 120);

        setTimeout(function() {
            $('#password').focus();
        }, 500);

        acoesAuxiliares();
    }


    $(document).submit('#formAlterarSenha', function(e) {
        e.preventDefault();
        let password = $("password").val();
        let newPassword = $("new_password").val();
        let newPasswordConfirm = $("new_password_confirm").val();
        let Data = new FormData($('#formAlterarSenha')[0]);
        var url = "<?php echo base_url('api/users/updateSenha') ?>";

        $.ajax({
            url: url,
            type: "post",
            data: Data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response) {
                    var successMsg = $("#altera_senha_success");
                    successMsg.html("<br>Senha alterada com sucesso!");
                    $("#senha_inputs").slideUp(10);
                    $("#bt_enviar").hide();
                }
            },
            error: function(xhr, status, error) {
                var errorMsg = $("#altera_senha_error");
                var errorReturn = JSON.parse(xhr.responseText);
                var erro = errorReturn.messages.error;
                errorMsg.html("<p id='erroSenha'>" + erro + "</p>");
                setTimeout(function() {
                    $("#erroSenha").slideUp(),
                        function() {
                            errorMsg.html('');
                        }

                }, 4500);
            }
        });

    });

    function maskNsu(valor) {

        let nsu = '';
        valor = `${valor}`;
        let tamanho = valor.length;
        switch (tamanho) {
            case 1:
                nsu = '00000' + valor;
                break;
            case 2:
                nsu = '00000' + valor;
                break;
            case 3:
                nsu = '000' + valor;
                break;
            case 4:
                nsu = '00' + valor;
                break;
            case 5:
                nsu = '0' + valor;
                break;
            case 6:
                nsu = '' + valor;
                break;
            default:
                break;
        }
        return nsu;
    }

    function hoje() {
        let hoje = new Date().getFormated(false);
        return hoje
    }

    function mesPassado() {
        let mesPassado = new Date().addMonths(-1).getFormated(false);
        return mesPassado
    }

    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf())
        date.setDate(date.getDate() + days)
        return date
    }

    Date.prototype.addMonths = function(months) {
        var date = new Date(this.valueOf())
        date.setMonth(date.getMonth() + months)
        return date
    }

    Date.prototype.addYears = function(yers) {
        var date = new Date(this.valueOf())
        date.setFullYear(date.getFullYear() + yers)
        return date
    }

    Date.prototype.getFormated = function(br, time) {
        var date = new Date(this.valueOf())

        let y = date.getFullYear()
        let m = date.getMonth() + 1
        let d = date.getDate()

        m < 10 ? m = ('0' + m) : false
        d < 10 ? d = ('0' + d) : false

        if (!br)
            return `${y}-${m}-${d}`
        else if (br && !time)
            return `${d}/${m}/${y}`
        else if (br && time) {

            let hor = date.getHours()
            let min = date.getMinutes()
            let sec = date.getSeconds()

            hor < 10 ? hor = ('0' + hor) : false
            min < 10 ? min = ('0' + min) : false
            sec < 10 ? sec = ('0' + sec) : false

            return `${d}/${m}/${y} às ${hor}:${min}:${sec}`
        }
    }

    function toggleFullScreen(id) {

        var div = document.getElementById(id);

        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });

        $('[data-toggle="tooltip"]').on('click', function() {
            $(this).tooltip('hide')
        });

        $('#cardBody').append(`<button id="fullScreenBotaoFechar" onclick="fecharTelaCheia();" type="button" class="btn btn-primary d-none bot2" data-toggle="tooltip" data-bs-placement="bottom" title="Fechar Tela">
                                <svg class="iconFullScreen" style="width:17px;height:17px;" viewBox="0 0 24 24">
                                    <path fill="#fff" ng-attr-d="{{icon.data}}" d="M14,14H19V16H16V19H14V14M5,14H10V19H8V16H5V14M8,5H10V10H5V8H8V5M19,8V10H14V5H16V8H19Z"></path>
                                </svg> Fechar Tela
                            </button>`)

        if ((div.fullScreenElement && div.fullScreenElement !== null) ||
            (!div.mozFullScreen && !div.webkitIsFullScreen)) {

            if (div.requestFullScreen) {
                div.requestFullScreen();
            } else if (div.mozRequestFullScreen) {
                div.mozRequestFullScreen();
            } else if (div.webkitRequestFullScreen) {
                div.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }

            $('.bot1').addClass('d-none');
            $('.bot2').removeClass('d-none');
            $('#cardBody > div > div > button').addClass('d-none');
            $('#tabela_info').toggleClass('full');
            $('#tabela_paginate').toggleClass('full');
        }
    }

    if (document.addEventListener) {
        document.addEventListener('webkitfullscreenchange', sairTelaCheia, false);
        document.addEventListener('mozfullscreenchange', sairTelaCheia, false);
        document.addEventListener('fullscreenchange', sairTelaCheia, false);
        document.addEventListener('MSFullscreenChange', sairTelaCheia, false);
    }

    function sairTelaCheia() {
        if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
            $('.bot1').removeClass('d-none');
            $('.bot2').addClass('d-none');
            $('#cardBody > div > div > button').removeClass('d-none');
            $('#tabela_info').toggleClass('full');
            $('#tabela_paginate').toggleClass('full');
            $('#fullScreenBotaoFechar').remove();
            $('button').removeClass('disabled');
        }
    }

    function fecharTelaCheia() {
        document.exitFullscreen();
    }


    function gerarPDF(idTabela, nomeArquivo, titulo, total, resumido = null, relatorio = null, lancamento = null, dre = null) {

        let data_inicial = '';
        let data_final = '';
        let mesPeriodo = '';
        let totalRegistros = total;

        let totalSelectTabela = '';

        if (totalRegistros <= 9) {
            totalSelectTabela = totalRegistros;
        } else {
            totalSelectTabela = $('[name=tabela_length').val();
        }

        let totalPorPagina = (totalSelectTabela == '-1' || totalRegistros < totalSelectTabela) ? totalRegistros : totalSelectTabela;
        let responsavel = '<?= $nomeUsuarioLogado ?>';
        let periodo = '';

        if (dre == 1) {
            mesPeriodo = $('#mes').val();
            let meses = ["JANEIRO", "FEVEREIRO", "MARÇO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO", "DEZEMBRO"];
            let data = new Date(mesPeriodo);
            let dataFormatada = ((meses[(data.getMonth())] + " de " + data.getFullYear()));
            periodo = (relatorio == 1) ? 'Mês: ' + dataFormatada : ''
        } else {
            data_inicial = formatarData($('#data_inicial').val());
            data_final = formatarData($('#data_final').val());
            periodo = (relatorio == 1) ? 'Período: ' + data_inicial + ' à ' + data_final : ''
        }

        let dataAtual = new Date();
        let dia = dataAtual.getDate();
        let mes = (dataAtual.getMonth() + 1);
        let ano = dataAtual.getFullYear();
        let horas = dataAtual.getHours();
        let minutos = dataAtual.getMinutes();

        let dataCompleta = dia + '/' + (mes >= 10 ? mes : '0' + mes) + '/' + ano + ' - ' + horas + ':' + minutos + 'h.';

        let doc = new jspdf.jsPDF('l', 'pt', "a4");
        let totalPagesExp = '{total_pages_count_string}';


        doc.addFont("<?php echo base_url('/public/fonts/arial.ttf'); ?>", "Arial", "normal");
        doc.setFont("Arial");

        let logo = "<?php echo base_url('/public/img/logo.png'); ?>";
        doc.addImage(logo, "JPEG", 687, 60, 125, 31);

        doc.setFontSize(14)
        doc.setTextColor(40)
        doc.text(titulo, 330, 30)

        doc.setFontSize(10)
        doc.setTextColor(40)
        doc.text('Responsável: ' + responsavel, 30, 30)

        doc.setFontSize(10)
        doc.setTextColor(150)
        doc.text(periodo, 30, 75)

        doc.setFontSize(10)
        doc.setTextColor(28, 126, 214)
        doc.setFont('Arial', 'italic');
        doc.text('Exibindo 1 a ' + totalPorPagina + ' de ' + totalRegistros + ' registros', 30, 90)

        tabela = document.getElementById("tabela");
        cloneTabela = tabela.cloneNode(true);
        sets = cloneTabela.getElementsByClassName('noPrint');

        while (sets.length) {
            sets[0].remove();
        }

        if (resumido == 1) {
            detalhado = cloneTabela.getElementsByClassName('detalhado');

            while (detalhado.length) {
                detalhado[0].remove();
            }
        }

        doc.autoTable({

            margin: {
                bottom: 30,
                top: 100,
                left: 30,
                right: 30
            },

            didDrawPage: function(data) {

                data.settings.margin.top = 40;
                let pageSize = doc.internal.pageSize
                let pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
                let str = 'Página ' + doc.internal.getNumberOfPages()

                doc.setFontSize(10)
                doc.setTextColor(150);
                doc.text(dataCompleta, 720, 30)

                if (typeof doc.putTotalPages === 'function') {
                    str = str + ' de ' + totalPagesExp
                }
                doc.setFontSize(10)
                doc.setTextColor(150);
                doc.text(str, 740, pageHeight - 20)
            },

            headStyles: {
                fontSize: 10,
                halign: 'left'
            },
            bodyStyles: {
                fontSize: 10,
                halign: 'left',
                company: {
                    halign: 'left',
                }
            },
            columnStyles: {
                0: {
                    halign: 'left',
                    font: 'Arial'
                },
            },
            footStyles: {
                fontSize: 12,
                halign: 'left'
            },

            html: cloneTabela,

        })

        if (typeof doc.putTotalPages === 'function') {
            doc.putTotalPages(totalPagesExp)
        }

        $('button').removeClass('disabled');

        doc.save(nomeArquivo + ".pdf")
    }

    $(document).on('dblclick', 'input[list]', function() {

        let idInput = $(this).attr('id');
        let readonly = $(this).attr('readonly');

        if (readonly != 'readonly') {

            $(this).val('');

            if (idInput == 'name_lancamento') {
                $('#debito').val('').attr('readonly', false);
                $('#credito').val('').attr('readonly', false);
            }
        }
    })

    function contaDigito(campo, tammax, pos, teclapres) {
        var keyCode;
        if (teclapres.srcElement) {
            keyCode = teclapres.keyCode;
        } else if (teclapres.target) {
            keyCode = teclapres.which;
        }
        if (keyCode == 0 || keyCode == 8) {
            return true;
        }
        if ((keyCode < 48 || keyCode > 57) && keyCode != 88 && (keyCode != 120)) {
            return false;
        }
        var tecla = keyCode;
        vr = campo.value;
        vr = vr.replace("-", "");
        vr = vr.replace("/", "");

        tam = vr.length;
        if (tam < tammax && tecla != 8) {
            tam = vr.length + 1;
        }
        if (tecla == 8) {
            //tam = tam - 1;
            campo.value = vr.substr(0, tam - pos) + "-" + vr.substr(tam - pos, tam);
        }
        if (tecla == 8 || tecla == 88 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 || tecla == 120) {
            if (tam <= 2) {
                campo.value = vr;
            }
            if (tam > pos && tam < tammax) {
                campo.value = vr.substr(0, tam - pos) + "-" + vr.substr(tam - pos, tam);
            }
        }
    }

    const cloneArray = arr => JSON.parse(JSON.stringify(arr))

    const groupBy = key => {
        return function group(array) {
            return array.reduce((acc, obj) => {
                const property = obj[key]
                acc[property] = acc[property] || []
                acc[property].push(obj);
                return acc
            }, {})
        }
    }
</script>