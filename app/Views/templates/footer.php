  <footer class="d-flex flex-wrap align-items-center py-3">
    <p class="col-md-2 mb-0 text-muted footP"><a class="logo" href="#"><img src="../public/img/footer-logo.png" /></a></p>
    <ul class="nav col-md-7 justify-content-center">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-footer-center">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-footer-center">Sobre</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-footer-center">Preço</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-footer-center">Desenvolvedores</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-footer-center">Ajuda</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-footer-center">Contato</a></li>
    </ul>
    <p class="col-md-3 mb-0 text-muted"><a class="foneEmail" href="tel:+80123456789">+80 1234 56789</a> | <a class="foneEmail" href="mailto:ola@sitedemo.com.br">ola@sitedemo.com.br</a></p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
  <script>
    $(document).ready(function() {

      carregarBoxes();

    });

    function carregarBoxes() {

      let settings = {
        url: "<?php echo base_url('../../db.json') ?>",
        method: "POST"
      }

      $.ajax(settings).done(function(response) {

        let services_rows = '';
        let icone = '';

        $.each(response.services, function(index, val) {

          switch (val.id) {
            case 1:
              icone = 'checkbox-marked-circle-outline';
              break;
            case 2:
              icone = 'card-bulleted-outline';
              break;
            case 3:
              icone = 'piggy-bank';
              break;
            default:
              break;
          }

          services_rows += `<div class="col-lg-4 ${val.id == 2 ? 'text-dark' : 'bg-box'}">
                                    <i class="mdi mdi-${icone}"></i>
                                    <div class="titulo">${val.title}</div>
                                    <p class="texto">${val.description}</p>
                                </div>`;

        })

        $('#boxesServicos').html(services_rows)
      })

      let settingsClientes = {
        url: "<?php echo base_url('../../clientes.json') ?>",
        method: "POST"
      }

      $.ajax(settingsClientes).done(function(responseClientes) {

        let clientes_rows = '';
        let link = '';

        $.each(responseClientes.clientes, function(index, val) {

          link = val.link + '/' + val.image;

          clientes_rows += `<div class="col-lg-3 padding-45">
                                    <a href="${val.url}" target="_new"><img src="${link}" title="${val.title}"/></a>
                                </div>`;

        })

        $('#boxesClientes').html(clientes_rows)
      })

    }

    function salvarNewsletter(e) {

      let titulo = $('#tituloNewsletter').html();
      let texto = $('#textoNewsletter').html();
      let email = $('#email');
      let regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      let iconeAlerta = '';
      let colorAlerta = '';
      let tituloAlerta = '';
      let msgAlerta = '';

      if (email.val() == "") {

        iconeAlerta = 'message-alert';
        colorAlerta = 'danger';
        pulse = 'pulsaDanger';
        tituloAlerta = 'Erro';
        msgAlerta = 'Ops! Você precisa informar um E-mail.';
        email.addClass('treme');

      } else if (!regex.test(email.val())) {

        iconeAlerta = 'message-alert';
        colorAlerta = 'danger';
        pulse = 'pulsaDanger';
        tituloAlerta = 'Atenção';
        msgAlerta = 'Você precisa informar um E-mail com um formato válido.';
        email.val('');
        email.addClass('treme');

      } else {

        iconeAlerta = 'check-all';
        colorAlerta = 'success';
        pulse = 'pulsaSuccess';
        tituloAlerta = 'E-mail Enviado';
        msgAlerta = 'E-mail cadastrado com sucesso. Aguarde para receber nossas promoções e ofertas.';
        email.val('');

      }

      email.toggleClass(colorAlerta + 'Input').focus();
      $(e).toggleClass('btn-' + colorAlerta + ' ' + pulse);
      $('#tituloNewsletter').toggleClass('text-' + colorAlerta).html(`<i style="font-size:2rem;" class="mdi mdi-${iconeAlerta}"></i> ${tituloAlerta}`);
      $('#textoNewsletter').toggleClass('text-' + colorAlerta).html(msgAlerta);

      setTimeout(function() {
        email.removeClass(colorAlerta + 'Input');
        $(e).removeClass('btn-' + colorAlerta + ' ' + pulse);
        $('#tituloNewsletter').removeClass('text-' + colorAlerta).html(titulo);
        $('#textoNewsletter').removeClass('text-' + colorAlerta).html(texto);
        email.removeClass('treme');
      }, 5000)

    }

    function modalTicket() {

      let idModal = 'modalPanico';
      let elemento = $('.modal');
      let modal = new bootstrap.Modal(elemento, {
        keyboard: false,
        focus: true,
        backdrop: 'static'
      });

      //pequeno: 'sm' - padrão: '' - grande: 'lg' - muito grande: 'xl' - tela cheia: 'fullscreen'
      let tamanho = 'md';

      //modal-dialog-centered
      let centro = '';

      //modal-dialog-scrollable
      let rolagem = '';

      let label = 'primary';

      elemento.attr('id', idModal);
      elemento.find('.modal-header').attr('class', 'modal-header btn-' + label);
      elemento.find('.modal-dialog').attr('class', 'modal-dialog modal-' + tamanho + ' ' + centro + ' ' + rolagem);
      elemento.find('.modal-title').html('<i style="font-size:18px" class="mdi mdi-car-emergency"></i> Ticket - Abertura de chamado');
      elemento.find('.modal-body').html(`<div class="row">
                                                <div class="col-md-12 text-dark" style="margin-bottom:30px">
                                                    <label class="form-label negrito">LEIA COM ATENÇÃO:</label>
                                                    <div>Após a abertura do seu chamado, um de nossos colaboradores entrará em contato através do telefone informado em até <b>24 horas</b>.</div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-10">
                                                        <span class="input-group-text">Nome<small>*</small></span>
                                                        <select class="form-select" name="setor" id="setor">
                                                          <option value="">Escolha o Setor</option>
                                                          <option value="1">Atendimento</option>
                                                          <option value="2">Financeiro</option>
                                                          <option value="3">Supervisão</option>
                                                          <option value="4">Ouvidoria</option>
                                                          <option value="5">Diretoria</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-10">
                                                        <span class="input-group-text">Nome<small>*</small></span>
                                                        <input autocomplete="off" type="text" class="form-control text-dark" name="nome" id="nome">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-10">
                                                        <span class="input-group-text">E-mail<small>*</small></span>
                                                        <input autocomplete="off" type="text" class="form-control text-dark" name="email_t" id="email_t">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-10">
                                                        <span class="input-group-text">Telefone<small>*</small></span>
                                                        <input autocomplete="off" type="text" class="form-control text-dark telefone" name="telefone" id="telefone">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-10">
                                                        <span class="input-group-text">Mensagem<small>*</small></span>
                                                        <textarea autocomplete="off" rows="5" class="form-control text-dark" name="texto" id="texto"></textarea>
                                                    </div>
                                                </div>
                                                
                                            </div>`);
      elemento.find('.modal-footer').html(`
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button onclick="enviarTicket('Enviar')" id="botTicket" class="btn btn-primary disabled">Enviar</button>
                                                
                                                `);
      elemento.find('.modal-footer').css({
        'justify-content': 'flex-end',
        'padding-bottom': '20px'
      });
      modal.show();

      setTimeout(function() {
        $('#setor').focus();
      }, 500);

      acoesAuxiliares();
      return false;

    }

    function modalDoc() {

      let idModal = 'modalDoc';
      let elemento = $('.modal');
      let modal = new bootstrap.Modal(elemento, {
        keyboard: false,
        focus: true,
        backdrop: 'static'
      });

      //pequeno: 'sm' - padrão: '' - grande: 'lg' - muito grande: 'xl' - tela cheia: 'fullscreen'
      let tamanho = 'md';

      //modal-dialog-centered
      let centro = 'modal-dialog-centered';

      //modal-dialog-scrollable
      let rolagem = '';

      let label = 'danger';

      elemento.attr('id', idModal);
      elemento.find('.modal-header').attr('class', 'modal-header btn-' + label);
      elemento.find('.modal-dialog').attr('class', 'modal-dialog modal-' + tamanho + ' ' + centro + ' ' + rolagem);
      elemento.find('.modal-title').html('<i style="font-size:18px" class="mdi mdi-text-box-search"></i> Documentos - Baixe os Documentos');
      elemento.find('.modal-body').html(`<div class="row">
                                          <div class="col-md-12 text-dark" style="margin-bottom:30px">
                                              <label class="form-label negrito">AVISOS IMPORTANTES:</label>
                                              <div>Antes de finalizar o processo de escolha e selecionar o candidato para a vaga, realize o <b>Download dos arquivos (WORD ou PDF)</b> e leia atentamente as qualificações.</div>
                                          </div>
                                          <div class="col-md-6 center">
                                              <a class="doc" href="<?php echo base_url('../public/files/Curriculo-2021-floripa.docx') ?>" download><img style="height:100px" src="<?php echo base_url('../public/img/word.png') ?>" /></a>
                                          </div>
                                          <div class="col-md-6 center">
                                              <a class="doc" href="<?php echo base_url('../public/files/Curriculo-2021-floripa.pdf') ?>" download><img style="height:100px" src="<?php echo base_url('../public/img/pdf.png') ?>" /></a>
                                          </div>
                                      </div>`);
      elemento.find('.modal-footer').html(`
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>`);
      elemento.find('.modal-footer').css({
        'justify-content': 'flex-end',
        'padding-bottom': '20px'
      });
      modal.show();

      setTimeout(function() {
        $('#setor').focus();
      }, 500);

      acoesAuxiliares();
      return false;

    }

    function acoesAuxiliares() {

      telefone()

      $('#setor').change(verificar);
      $('#nome').keyup(verificar);
      $('#email_t').keyup(verificar);
      $('#telefone').keyup(verificar);
      $('#texto').keyup(verificar);

    }

    function verificar() {

      let setor = $('#setor').val();
      let nome = $('#nome').val();
      let email = $('#email_t').val();
      let telefone = $('#telefone').val();
      let texto = $('#texto').val();
      let regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (setor != "" && nome != "" && email != "" && telefone != "" && texto != "" && regex.test(email)) {
        $("#botTicket").removeClass("disabled");
        console.log('abriu')
      } else {
        $("#botTicket").addClass("disabled");
      }
    }

    function telefone() {

      var behavior = function(val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
          onKeyPress: function(val, e, field, options) {
            field.mask(behavior.apply({}, arguments), options);
          }
        };

      $('.telefone').mask(behavior, options);
    }

    function enviarTicket(acao) {

      let label = '';
      let titulo = $('.modal-title').html();

      let ticket = "";
      let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

      for (var i = 0; i < 10; i++) {
        ticket += possible.charAt(Math.floor(Math.random() * possible.length));
      }

      $('#setor').val('');
      $('#nome').val('');
      $('#email_t').val('');
      $('#telefone').val('');
      $('#texto').val('');

      if (acao == 'Enviar') {
        label = 'btn-primary';
        addLabel = 'btn-success';
        msgTexto = `O Ticket (T-${ticket}) foi criado com sucesso.`;
      }

      $('.modal .modal-header').removeClass(label);
      $('.modal .modal-header').addClass(addLabel);
      $('.modal .modal-title').html(msgTexto);

      setTimeout(function() {
        $('.modal .modal-title').html(titulo);
        $('.modal .modal-header').addClass(label);
        $('.modal .modal-header').removeClass(addLabel);
        $('.modal').modal('hide');
      }, 5000)
    }
  </script>

  <?php echo view('templates/modal') ?>
  </body>

  </html>