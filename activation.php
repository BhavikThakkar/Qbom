<?php 

include('header.php');

$currentid = $_GET['currentid'];
$activation_code = $_GET['activation_code'];

$activationquery = mysqli_query($sql,"SELECT * FROM `cr_users` WHERE `id` = '$currentid' and `activation_code` = '$activation_code'");
$activationquerycount = mysqli_num_rows($activationquery);
if($activationquerycount == 1)
{
    mysqli_query($sql,"UPDATE `cr_users` SET `active` = 1, `activation_code` = '' WHERE id = $currentid");
    echo '<script>alert("Obrigado por ativar sua conta.");</script>';

    $listactivationquery = mysqli_fetch_object($activationquery);
    $rid = $listactivationquery->rid;

    $activationquery1 = mysqli_query($sql,"SELECT * FROM `cr_site_settings` WHERE `id` = '$rid'");
    $listactivationquery1 = mysqli_fetch_object($activationquery1);
    $nameurl = $listactivationquery1->nameurl;
} else {
    echo '<script>alert("Algo errado!");</script>';
    echo '<script>window.location.href="'.$mainlink.'";</script>';
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
            <div class="buyplanformsuccess">
                <h3>Sucesso</h3>
                <div class="buyplanformsuccessdiv">
                    <p>Obrigado por ativar sua conta. Seu restaurante está pronto. Por favor, faça login em sua conta e preencha os outros detalhes.</p>
                    <p>O URL do seu restaurante é: <a target="_blank" href="https://<?php echo $nameurl; ?>.qbom.pt">https://<?php echo $nameurl; ?>.qbom.pt</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php include('footer.php'); ?>

