<?php echo view('templates/header') ?>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="bd-placeholder-img" width="100%" height="100%" src="<?php echo base_url('../public/img/slide1.jpg') ?>">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Recrie este banner!</h1>
                    <p>Além deste banner inicial, desenvolva esta área com a possibilidade de mais banners, com outras imagens ou vídeos ao fundo também. Utilize toda sua criatividade para dar vida a este site, mas atenção para o responsivo. É importante que o site se adapte e fique legível..</p>
                    <a class="btn btn-lg btn-info" href="#">Sobre o SiteDemo</a> <a class="btn btn-lg btn-default" href="#">Começar</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img" width="100%" height="100%" src="<?php echo base_url('../public/img/slide2.jpg') ?>">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Recrie este banner!</h1>
                    <p>Além deste banner inicial, desenvolva esta área com a possibilidade de mais banners, com outras imagens ou vídeos ao fundo também. Utilize toda sua criatividade para dar vida a este site, mas atenção para o responsivo. É importante que o site se adapte e fique legível..</p>
                    <a class="btn btn-lg btn-info" href="#">Sobre o SiteDemo</a> <a class="btn btn-lg btn-default" href="#">Começar</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img" width="100%" height="100%" src="<?php echo base_url('../public/img/slide3.jpg') ?>">
            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>Recrie este banner!</h1>
                    <p>Além deste banner inicial, desenvolva esta área com a possibilidade de mais banners, com outras imagens ou vídeos ao fundo também. Utilize toda sua criatividade para dar vida a este site, mas atenção para o responsivo. É importante que o site se adapte e fique legível..</p>
                    <a class="btn btn-lg btn-info" href="#">Sobre o SiteDemo</a> <a class="btn btn-lg btn-default" href="#">Começar</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>


<!-- Marketing messaging and featurettes
  ================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->
<section>
    <div class="row" id="boxesClientes"></div>
</section>

<section>
    <div class="row" id="boxesServicos"></div>
</section>

<section>
    <div class="col-xxl-8 px-4">
        <div class="row flex-lg-row-reverse align-items-center g-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="<?php echo base_url('../public/img/computador.png') ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6" style="text-align: left;">
                <h1 class="fw-bold lh-1 mb-3 text-dark">Atencimento ao Cliente</h1>
                <p class="lead text-dark">Precisando entrar em contato, ultilize nossos canais de atendimento ou consulte a documentação para mais informações.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-success btn-lg px-4 fs-14 plr">Envie um Ticket</button>
                    <button type="button" class="btn btn-primary btn-lg px-4 fs-14 plr">Documentação</button>
                </div>
            </div>
        </div>
    </div>
</section>

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

            console.log(clientes_rows)
            $('#boxesClientes').html(clientes_rows)
        })

    }
</script>

<?php echo view('templates/footer') ?>