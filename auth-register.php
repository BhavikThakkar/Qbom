<?php 

include('config.php');

$planid = $_GET['planid'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$restoname = $_GET['restoname'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$password = $_GET['password'];
//$amount = $_GET['amount'];

$fname = base64_decode($fname);
$lname = base64_decode($lname);
$restoname = base64_decode($restoname);
$phone = base64_decode($phone);
$email = base64_decode($email);
$password = base64_decode($password);
//$amount = base64_decode($amount);

$planamount = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `plan_id` = '$planid'");
$listdataplanamount = mysqli_fetch_object($planamount);
$amount = $listdataplanamount->amount;

?>

<style>.stripe-button-el{display:none!important;}.stripe-loader-div{text-align:center; margin-top:12%;}.stripe-loader{width:10%;}</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('.stripe-button-el').click();
});
</script>

<div class="stripe-loader-div"><img src="<?php echo $mainlink; ?>assets/images/stripe-loader.gif" class="stripe-loader"/></div>

<form action="<?php echo $mainlink; ?>payment-gateway/submit.php?logflag=1&planid=<?php echo $planid; ?>&fname=<?php echo $fname; ?>&lname=<?php echo $lname; ?>&restoname=<?php echo $restoname; ?>&phone=<?php echo $phone; ?>&email=<?php echo $email; ?>&password=<?php echo $password; ?>" method="post">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo $publishableKey; ?>"
data-amount="<?php echo $amount; ?>00" 
data-name="<?php echo $fname; ?> <?php echo $lname; ?>"
data-description="COMPRAR PLANO DE ASSINATURA"
data-image="<?php echo $logo; ?>"
data-currency="INR"
data-email="<?php echo $email; ?>"
>
</script>
</form>

<script>
// $(document).on("DOMNodeRemoved",".stripe_checkout_app", close);
// function close() {
//   window.location.href="<?php echo $mainlink; ?>";
// }
</script>

