<?php 

include('header.php');

if($amount == 0) 
{
    include('free-register-auth.php'); 
} else {
    include('register-auth.php'); 
}

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
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Primeiro nome:</label>
                                <input type="text" class="fname" placeholder="Digitar ..." name="fname" autocomplete="off" required />
                                <span class="errorr creg1"><?php echo $fnameerror; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sobrenome:</label>
                                <input type="text" class="lname" placeholder="Digitar ..." name="lname" autocomplete="off" required />
                                <span class="errorr creg2"><?php echo $lnameerror; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome do restaurante:</label>
                                <input type="text" class="restoname" placeholder="Digitar ..." name="restoname" autocomplete="off" required />
                                <span class="errorr creg6"><?php echo $restonameerror; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone:</label>
                                <input type="text" class="phone" placeholder="Digitar ..." name="phone" autocomplete="off" required />
                                <span class="errorr creg3"><?php echo $phoneerror; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>O email:</label>
                                <input type="email" id="email" class="nospace" placeholder="Digitar ..." name="email" autocomplete="off" required />
                                <span class="errorr creg4"><?php echo $emailerror; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Senha:</label>
                                <input type="password" class="password" placeholder="Digitar ..." minlength="6" name="password" autocomplete="off" required />
                                <span class="errorr creg5"><?php echo $passworderror; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $plan_id; ?>" name="planid" />
                                <button type="submit" id="registersubmitplan" name="registersubmitplan" class="submitplan">Continue To Process</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="<?php echo $mainlink; ?>loginbuyplan/<?php echo $sku; ?>" class="alreadyaccount">Já tem uma conta?</a>
                            </div>
                        </div>
                    </div>
                </form>
                <span class="errorr"><?php echo $allerror; ?></span>
                
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php include('footer.php'); ?>
<script src="<?php echo $mainlink; ?>assets/js/registerbuyplan.js"></script>

