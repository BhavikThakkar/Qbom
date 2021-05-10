<?php 

require('../config.php'); 

\Stripe\Stripe::setVerifySslCerts(false);

$stripeToken = '';
$stripeID = '';
$paymentID = '';
$paymentstatus = '';
$paymentCurrency = '';
$paymentReceiptURL = '';
$paidAmount = '';
$customer_id = '';
$transactionID = '';

$logflag = $_GET['logflag']; // LOGIN FLAG (1.REGISTER | 2.LOGIN)
$planid = $_GET['planid'];

if($logflag == 1) // REGISTER PROCESS
{
    $planamount = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `plan_id` = '$planid'");
    $listdataplanamount = mysqli_fetch_object($planamount);
    $amount = $listdataplanamount->amount;
} else { // LOGIN PROCESS
    $email = mysqli_real_escape_string($sql,$_GET['email']);
    $query1 = mysqli_query($sql, "SELECT * FROM `cr_users` WHERE `email` = '$email' and `active` = 1");
    $listdata1 = mysqli_fetch_object($query1);
    $currentid = $listdata1->id;

    $planamount = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `plan_id` = '$planid'");
    $listdataplanamount = mysqli_fetch_object($planamount);
    $amount = $listdataplanamount->amount;

    $newquery1 = mysqli_query($sql, "SELECT * FROM `cr_order_plan` WHERE `user_id` = '$currentid' and `status` = 1 ORDER BY ID ASC LIMIT 1");
    $newquery1count = mysqli_num_rows($newquery1);
    if($newquery1count == 1)
    {
        $amount = planamountcalc($sql, $newquery1, $amount);
    }
}

if(isset($_POST['stripeToken']))
{
    $token = $_POST['stripeToken'];

    /*$customer = Stripe\Customer::create(array(
        'email' => "my-email@gmail.com",
        'source'  => $token
    ));*/

    $data = \Stripe\Charge::create(array(
        "amount"=>calculateRealNumber($amount),
        "currency"=>"inr",
        "description"=>"SUBSCRIPTION PLAN",
        "source"=>$token,
    ));

    //echo '<pre>';
    //print_r($data);

    if($data->status == 'succeeded')
    {
        $stripeToken = $_POST['stripeToken']; // STRIPE TOKEN
        $transactionID = $data->balance_transaction; // TRANSACTION ID
        $paymentID = $data->payment_method; // PAYMENT ID
        $paymentstatus = $data->status; // PAYMENT STATUS
        $paymentCurrency = $data->currency; // PAYMENT CURRENCY
        $paymentReceiptURL = $data->receipt_url; // RECEIPT URL
        $paidAmount = substr($data->amount_captured, 0, -2); // PAID AMOUNT - REMOVE LAST DIGIT
        $customer_id = $data->id; // CUSTOMER ID
        $created_date = date("Y-m-d H:i:s");

        if($logflag == 1) // REGISTER
        {
            include('registerplan.php');
        }

        if($logflag == 2) // LOGIN
        {
            include('loginplan.php');
        }
    
    } else {

        $stripeToken = $_POST['stripeToken']; // STRIPE TOKEN
        $transactionID = $data->balance_transaction; // TRANSACTION ID
        $paymentID = $data->payment_method; // PAYMENT ID
        $paymentstatus = $data->status; // PAYMENT STATUS
        $paymentCurrency = $data->currency; // PAYMENT CURRENCY
        $paymentReceiptURL = $data->receipt_url; // RECEIPT URL
        $paidAmount = substr($data->amount_captured, 0, -2); // PAID AMOUNT - REMOVE LAST DIGIT
        $customer_id = $data->id; // CUSTOMER ID
        $created_date = date("Y-m-d H:i:s");

        mysqli_query($sql,"INSERT INTO `cr_stripe_payment` (`stripeToken`,`transactionID`,`paymentID`,`paymentstatus`,`paymentCurrency`,
        `paymentReceiptURL`,`paidAmount`,`customer_id`,`created_date`) 
        VALUES ('$stripeToken','$transactionID','$paymentID','$paymentstatus','$paymentCurrency',
        '$paymentReceiptURL','$paidAmount','$customer_id','$created_date')");

        // REIDRECT TO FAILED PAGE
        echo '<script>window.location.href="'.$mainlink.'failed/'.$transactionID.'"</script>';
    }
} else { 
    echo '<script>alert("Something Wrong!");</script>';
    echo '<script>window.location.href="'.$mainlink.'";</script>';
}

?>