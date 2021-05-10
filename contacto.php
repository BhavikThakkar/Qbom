<?php include('header.php'); ?>

<body data-spy="scroll" data-target="#faq-menu" data-offset="150">
    <!--============= ScrollToTop Section Starts Here =============-->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div>
    <!--============= ScrollToTop Section Ends Here =============-->


    <!--============= Header Section Starts Here =============-->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="<?php echo $mainlink; ?>">
                        <img src="<?php echo $mainlink; ?>assets/images/logo/logo2big-01.png" alt="logo">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="<?php echo $mainlink; ?>">Home</a>
                        
                        
                    </li>
                    <li>
                        <a href="<?php echo $mainlink; ?>vantagens">Vantagens</a>
                        
                    </li>
                    <li>
                        <a href="<?php echo $mainlink; ?>covid19">Covid-19</a>
                        
                    </li>
                    
                   
                    
                    <li>
                        <a href="<?php echo $mainlink; ?>contacto">Contato</a>
                    </li>
                    
                </ul>
                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->

    <!--============= Header Section Ends Here =============-->
    <section class="page-header single-header bg_img oh" data-background="./assets/images/page-header.png">
        <div class="bottom-shape d-none d-md-block">
            <img src="./assets/css/img/page-header.png" alt="css">
        </div>
    </section>
    <!--============= Header Section Ends Here =============-->


    
    
    <!--============= Contact Section Starts Here =============-->
    <section class="contact-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header mw-100 cl-white">
                <h2 class="title">Contato QBom</h2>
                <p>Se procura uma demonstração, uma pergunta de suporte ou uma consulta comercial, entre em contato.</p>
            </div>
            <div class="row justify-content-center justify-content-lg-between">
                <div class="col-lg-7">
                    <div class="contact-wrapper">
                        <h4 class="title text-center mb-30">Entrar em contato</h4>
                        <form class="contact-form" id="contact_form_submit">
                            <div class="form-group">
                                <label for="surename">O nome da sua empresa</label>
                                <input type="text" placeholder="Introduza o nome da empresa/estabelecimento" id="surename" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Introduza o seu nome completo</label>
                                <input type="text" placeholder="Nome completo" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Número de telefone</label>
                                <input type="text" placeholder="Introduza o seu numero de contacto " id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Seu email </label>
                                <input type="text" placeholder="Introduza o seu email  " id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Seu assunto</label>
                                <input type="text" placeholder="Introduza o plano pretendido " id="subject" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="message">Sua mensagem </label>
                                <textarea id="message" placeholder="Deixe a sua mensagem" required></textarea>
                                <div class="form-check">
                                    <input type="checkbox" id="check" checked><label for="check">Aceito receber e-mails, newsletters e mensagens promocionais</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Enviar Mensagem">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-content">
                        <div class="man d-lg-block d-none">
                            <img src="./assets/images/contact/man.png" alt="bg">
                        </div>
                        
                        <div class="contact-area">
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="./assets/images/contact/contact1.png" alt="contact">
                                </div>
                                <div class="contact-contact">
                                    <h5 class="subtitle">Envia-nos um email</h5>
                                    <a href="Mailto:info@mosto.com">info@qbom.com</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="./assets/images/contact/contact2.png" alt="contact">
                                </div>
                                <div class="contact-contact">
                                    <h5 class="subtitle">Ligue para nós</h5>
                                    <a href="Tel:565656855">++353(0)1 2342424</a>
                                    <a href="Tel:565656855">++353(0)1 2342424</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="./assets/images/contact/contact3.png" alt="contact">
                                </div>
                                <div class="contact-contact">
                                    <h5 class="subtitle">Visite-Nos</h5>
                                    <p>77 Sir John Rogerson´s Quay
                                       Grand Canal Docklands
                                       Dublin 2, D02 VK60</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Contact Section Ends Here =============-->


    <!--============= Map Section Starts Here =============-->
   <!-- <div class="map-section padding-bottom-2">
        <div class="container">
            <div class="section-header">
                <div class="thumb">
                    <img src="./assets/images/contact/earth.png" alt="contact">
                </div>
                <h3 class="title">Somos fáceis de encontrar</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="maps-wrapper">
                        <div class="maps"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!--============= Map Section Ends Here =============-->


    <!--============= Do Section Starts Here =============-->
    <!--<div class="do-section padding-bottom padding-top-2">
        <div class="container">
            <div class="row mb-30-none justify-content-center">
                <div class="col-md-6">
                    <div class="do-item cl-white">
                        <h3 class="title">Sobre nós</h3>
                        <p>Descubra quem somos e o que fazemos!</p>
                        <a href="about.php"><i class="fas fa-angle-left"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="do-item cl-white">
                        <h3 class="title">Parceiros</h3>
                        <p>Seja um parceiro QBom</p>
                        <a href="partners.php"><i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!--============= Do Section Ends Here =============-->
    


<?php include('footer.php'); ?>

<script src="./assets/js/contact.js"></script>