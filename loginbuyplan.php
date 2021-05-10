<?php 

include('header.php'); 

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
            <div class="buyplanform">
                <h3>Comprar plano de assinatura</h3>
                <div class="plantitle">SKU : <?php echo $sku; ?> | Plano : <?php echo $displaytime; ?> | Título : <?php echo $heading; ?> | Quantia : <?php echo $amount; ?> <sup> €</sup></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>O email:</label>
                            <?php if($defaultemail != '') { ?>
                            <input type="email" placeholder="Digitar ..." class="email" value="<?php echo $defaultemail; ?>" readonly="true" autocomplete="off" required />
                            <?php } else { ?>
                            <input type="email" placeholder="Digitar ..." class="email" autocomplete="off" required />
                            <?php } ?>
                            <span class="errorr dreg1"></span>
                        </div>
                    </div>
                    <?php if($defaultpassword != '') { ?>
                    <div class="col-md-12" style="display:none;">
                    <?php } else { ?>
                    <div class="col-md-12">
                    <?php } ?>
                        <div class="form-group">
                            <label>Senha:</label>
                            <?php if($defaultpassword != '') { ?>
                            <input type="password" placeholder="Digitar ..." class="password" value="<?php echo $defaultpassword; ?>" readonly="true"  autocomplete="off" required />
                            <?php } else { ?>
                            <input type="password" placeholder="Digitar ..." class="password" autocomplete="off" required />
                            <?php } ?>
                        </div>
                    </div>
                    <?php if(!isset($_GET['restaurant'])) { ?>
                    <div class="col-md-6">
                    <?php } else { ?>
                    <div class="col-md-12">
                    <?php } ?>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $plan_id; ?>" class="planid" />
                            <input type="hidden" value="<?php echo $temprestaurant; ?>" class="temprestaurant" />
                            <input type="button" id="loginsubmitplan" name="loginsubmitplan" class="submitplan" value="Continue To Process">
                        </div>
                    </div>
                    <?php if(!isset($_GET['restaurant'])) { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="<?php echo $mainlink; ?>registerbuyplan/<?php echo $sku; ?>" class="alreadyaccount">Você não tem uma conta?</a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <div class="errorr usrnmnotfnd" style="text-align: center;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="<?php echo $mainlink; ?>assets/js/loginbuyplan.js"></script>
