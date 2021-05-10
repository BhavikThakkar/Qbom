<?php 

include('header.php');
include('includes/failed.php'); 

?>

<body>
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
                    
                    <a href="Https://www.demo.qbom.pt" target="_blank" class="header-button d-none d-sm-inline-block">DEMO</a>
                </div>
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here1 =============-->

<div class="buyplanformsection">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="buyplanformfailed">
                <h3>Fracassado</h3>
                <div class="buyplanformfaileddiv">
                    <p>Desculpe, a transação falhou.</p>
                    <p>ID de transação: <?php echo $transactionID; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php include('footer.php'); ?>

