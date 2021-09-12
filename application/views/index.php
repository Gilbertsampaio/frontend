<?php 
include 'templates/header.php'; 
?>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="bd-placeholder-img" width="100%" height="100%" src="../public/img/slide1.jpg">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Recrie este banner!</h1>
                    <p>Além deste banner inicial, desenvolva esta área com a possibilidade de mais banners, com outras imagens ou vídeos ao fundo também. Utilize toda sua criatividade para dar vida a este site, mas atenção para o responsivo. É importante que o site se adapte e fique legível..</p>
                    <a class="btn btn-lg btn-info pulsaInfo" href="#">Sobre o SiteDemo</a> <a class="btn btn-lg btn-default" href="#">Começar</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img" width="100%" height="100%" src="../public/img/slide2.jpg">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Recrie este banner!</h1>
                    <p>Além deste banner inicial, desenvolva esta área com a possibilidade de mais banners, com outras imagens ou vídeos ao fundo também. Utilize toda sua criatividade para dar vida a este site, mas atenção para o responsivo. É importante que o site se adapte e fique legível..</p>
                    <a class="btn btn-lg btn-info pulsaInfo" href="#">Sobre o SiteDemo</a> <a class="btn btn-lg btn-default" href="#">Começar</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img" width="100%" height="100%" src="../public/img/slide3.jpg">
            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>Recrie este banner!</h1>
                    <p>Além deste banner inicial, desenvolva esta área com a possibilidade de mais banners, com outras imagens ou vídeos ao fundo também. Utilize toda sua criatividade para dar vida a este site, mas atenção para o responsivo. É importante que o site se adapte e fique legível..</p>
                    <a class="btn btn-lg btn-info pulsaInfo" href="#">Sobre o SiteDemo</a> <a class="btn btn-lg btn-default" href="#">Começar</a>
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
<div class="container">
    <section>
        <div class="row" id="boxesClientes"></div>
    </section>
    <section>
        <div class="row" id="boxesServicos"></div>
    </section>
    <section style="margin-bottom: 0; border-bottom:none">
        <div class="col-xxl-8 px-4">
            <div class="row flex-lg-row-reverse align-items-center g-5">
                <div class="col-10 col-sm-8 col-lg-4" style="margin-top: 10px;">
                    <img src="../public/img/computador.png" class="d-block mx-lg-auto img-fluid">
                </div>
                <div class="col-lg-8" style="text-align: left;">
                    <h1 class="fw-bold lh-1 mb-3 text-dark">Atencimento ao Cliente</h1>
                    <p class="lead text-dark">Precisando entrar em contato, ultilize nossos canais de atendimento ou consulte a documentação para mais informações.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button onclick="modalTicket()" type="button" class="btn btn-success btn-lg fs-14 plr pulsaSuccess">Envie um Ticket</button>
                        <button onclick="modalDoc()" type="button" class="btn btn-primary btn-lg fs-14 plr pulsaPrimary">Documentação</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section class="newsletter">
    <div class="px-4 py-5 my-5 text-center">
        <h2 id="tituloNewsletter" class="fw-bold" style="margin-bottom: 20px;">Newsletter</h2>
        <div class="col-lg-6 mx-auto">
            <p id="textoNewsletter" class="lead mb-4">Receba nossas informações por email e fique sabendo de todas as novidades.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center" style="margin-top: 70px;">
                <input type="email" class="form-control" id="email" placeholder="Seu e-mail">
                <button onclick="salvarNewsletter(this)" type="button" class="btn btn-primary btn-lg fs-14 plr pulsaPrimary">Salvar</button>
            </div>
        </div>
    </div>
</section>


<?php include 'templates/footer.php';?>