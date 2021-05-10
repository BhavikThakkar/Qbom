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
                <div class="header-right">
                    
                    <a href="#0" class="header-button d-none d-sm-inline-block">ESCOLHA O PLANO</a>
                </div>
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->
    
    <!--============= Header Section Ends Here =============-->
    <section class="page-header bg_img" data-background="./assets/images/page-header.png">
        <div class="bottom-shape d-none d-md-block">
            <img src="./assets/css/img/page-header.png" alt="css">
        </div>
        <div class="container">
            <div class="page-header-content cl-white">
                <h2 class="title">Covid-19 Info</h2>
                
            </div>
        </div>
    </section>
    <!--============= Header Section Ends Here =============-->

    
    
    <!--============= Blog Section Starts Here =============-->
    <section class="blog-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-">
                    <article class="mb-40-none">
                        
                        
                             <!--- Info 3--->
                        
                        <div class="post-item">
                            <div class="post-thumb">
                                <a href="info3.php"><img src="./assets/images/blog/takeaway.png" alt="blog"></a>
                            </div>
                            <div class="post-content">
                                <h3 class="title">
                                    <a href="info3.php">O take-away terá de continuar a ser uma realidade </a>
                                </h3>
                                <p>Em alguns casos, essa vai passar a ser uma realidade a partir daqui, já que estiveram encerrados por completo. </p>
                                <a href="info3.php" class="read">2 min leitura</a>
                            </div>
                        </div>
                        
                        <!--- Info 4--->
                        
                        <div class="post-item">
                            <div class="post-thumb">
                                <a href="info4.php"><img src="./assets/images/blog/qbom_logo.png" alt="blog"></a>
                            </div>
                            <div class="post-content">
                                <h3 class="title">
                                    <a href="info4.php">Opte pelo  QBom menu digital</a>
                                </h3>
                                <p>Lembra do que disse mais acima? Que as coisas não são mais como antes. Então, o velho menu físico precisa ser aposentado por dois motivos:.</p>
                                <a href="info4.php" class="read">3 min leitura</a>
                            </div>
                        </div>
                        
                        
                        
                    </article>
                    <div class="pagination-area text-center pt-50 pb-50 pb-lg-none">
                        <a href="<?php echo $mainlink; ?>covid19"><i class="fas fa-angle-double-left"></i><span>Ant.</span></a>
                        <a href="<?php echo $mainlink; ?>covid19">1</a>
                        <a href="covid19_2.php"class="active">2</a>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--============= Blog Section Ends Here =============-->

<?php include('footer.php'); ?>