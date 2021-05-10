<?php 

include('config.php');

$planid = $_GET['planid'];
$email = $_GET['email'];

$planemail = mysqli_query($sql,"SELECT * FROM `cr_users` WHERE `email` = '$email'");
$cemail = mysqli_num_rows($planemail);
if($cemail != 1)
{
    echo '<script>alert("Algo errado!");</script>';
    echo '<script>window.location.href="'.$mainlink.'";</script>';
}
$listdataplanemail = mysqli_fetch_object($planemail);
$username = $listdataplanemail->username;
$currentid = $listdataplanemail->id;

$planamount = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `plan_id` = '$planid'");
$listdataplanamount = mysqli_fetch_object($planamount);
$amount = $listdataplanamount->amount;

$newquery1 = mysqli_query($sql, "SELECT * FROM `cr_order_plan` WHERE `user_id` = '$currentid' and `status` = 1 ORDER BY ID ASC LIMIT 1");
$newquery1count = mysqli_num_rows($newquery1);
if($newquery1count == 1)
{
    $amount = planamountcalc($sql, $newquery1, $amount);
    if($amount <= 0) {
        echo '<script>alert("Desculpe, você não pode fazer downgrade do plano. Até e a menos que seu plano atual não tenha expirado.");</script>';
        echo '<script>window.location.href="'.$mainlink.'";</script>';
        die();
    }
}

?>

<?php 

if($amount == 0)
{
    include('payment-gateway/loginplan.php');
} else { ?>

<style>.stripe-button-el{display:none!important;}.stripe-loader-div{text-align:center; margin-top:12%;}.stripe-loader{width:10%;}</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('.stripe-button-el').click();
});
</script>

<div class="stripe-loader-div"><img src="<?php echo $mainlink; ?>assets/images/stripe-loader.gif" class="stripe-loader"/></div>

<form action="<?php echo $mainlink; ?>payment-gateway/submit.php?logflag=2&planid=<?php echo $planid; ?>&email=<?php echo $email; ?>" method="post">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo $publishableKey; ?>"
data-amount="<?php echo calculateRealNumber($amount); ?>" 
data-name="<?php echo $username; ?>"
data-description="ATUALIZAR PLANO DE ASSINATURA"
data-image="<?php echo $logo; ?>"
data-currency="inr"
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

<?php } ?>




