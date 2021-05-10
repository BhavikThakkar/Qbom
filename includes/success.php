<?php 

if(isset($_GET['transactionID']))
{
    $transactionID = $_GET['transactionID'];
} else {
    echo '<script>alert("Algo errado!");</script>';
    echo '<script>window.location.href="'.$mainlink.'";</script>';
}

$checktrans = mysqli_query($sql,"SELECT * FROM `cr_stripe_payment` WHERE `transactionID` = '$transactionID'");
$cchecktrans = mysqli_num_rows($checktrans);
if($cchecktrans != 1) 
{
    echo '<script>alert("Algo errado!");</script>';
    echo '<script>window.location.href="'.$mainlink.'";</script>';
}

?>