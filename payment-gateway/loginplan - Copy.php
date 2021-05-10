<?php 

function LoginSubscriptionOne($sql, $rid, $oid, $plan_role)
{
    if($plan_role == 1) {
        $newquery2 = mysqli_query($sql,"SELECT * FROM `cr_groups` WHERE id = 5");
    }
    if($plan_role == 2) {
        $newquery2 = mysqli_query($sql,"SELECT * FROM `cr_groups` WHERE id = 5 OR id = 6");
    }
    if($plan_role == 3) {
        $newquery2 = mysqli_query($sql,"SELECT * FROM `cr_groups` WHERE id = 3 or id = 5 OR id = 6");
    }
    if($plan_role == 4) {
        $newquery2 = mysqli_query($sql,"SELECT * FROM `cr_groups` WHERE id = 3 or id = 4 OR id = 5 OR id = 6");
    }
    
    while($listdatanewquery2 = mysqli_fetch_object($newquery2))
    {
        $id = $listdatanewquery2->id; // 1,5,6
        $name = $listdatanewquery2->description;

        $newquery1 = mysqli_query($sql,"SELECT * FROM `cr_role` WHERE `rid` = '$rid' and `gid` = $id");
        $ccountt = mysqli_num_rows($newquery1);
        if($ccountt == 0)
        {
            mysqli_query($sql,"INSERT INTO `cr_role` (`rid`,`gid`,`access`,`title`) VALUES ('$rid','$id',$oid,'$name')");
            $roleid = mysqli_insert_id($sql);
            LoginSubscriptionTwo($sql, $rid, $roleid);
        } else {
            $newquery11 = mysqli_query($sql,"SELECT * FROM `cr_role` WHERE `rid` = '$rid' and `gid` = $id");
            $newquery111 = mysqli_fetch_object($newquery11);
            $access = $newquery111->access;
            if($access != '') {
                $access = $access.','.$oid;
            } else {
                $access = $oid;
            }
            mysqli_query($sql,"UPDATE `cr_role` SET `access` = '$access' WHERE `rid` = $rid and `gid` = $id");
        } 
    }
}

function LoginSubscriptionTwo($sql, $rid, $roleid)
{
    $query8 = mysqli_query($sql,"SELECT * FROM `page_master` WHERE `deleted` != 1");
    $countquery8 = mysqli_num_rows($query8); // COUNT 40
    for($i=0; $i<$countquery8; $i++) {
        while($listdata8 = mysqli_fetch_object($query8))
        {
            $pageid = $listdata8->id;
            mysqli_query($sql,"INSERT INTO `pagerole` (`rid`,`roleid`,`pageid`,`accessid`) VALUES ('$rid','$roleid','$pageid',0)");
        }    
    }
}

$planid = mysqli_real_escape_string($sql,$_GET['planid']);
$email = mysqli_real_escape_string($sql,$_GET['email']);

$created_date = date("Y-m-d H:i:s");

$query1 = mysqli_query($sql, "SELECT * FROM `cr_users` WHERE `email` = '$email' and `active` = 1");
$listdata1 = mysqli_fetch_object($query1);
$currentid = $listdata1->id;
$rid = $listdata1->rid;
$fname = $listdata1->first_name; // MAIL PURPOSE
$lname = $listdata1->last_name; // MAIL PURPOSE

$query = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `status` = 'Active' and `plan_id` = '$planid'");
$listdata = mysqli_fetch_object($query);
$mailsku = $listdata->sku;
$plan_role = $listdata->plan_role;
$time = $listdata->time;

$buydate = $created_date;
if($time == 1){
    $expirydate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($buydate)));
} else {
    $expirydate = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($buydate)));   
}

$query3 = mysqli_query($sql, "SELECT * FROM `cr_order_plan` WHERE `user_id` = '$currentid'");
$count1 = mysqli_num_rows($query3);
if($count1 == 0)
{
    $query2 = mysqli_query($sql,"INSERT INTO `cr_order_plan` (`user_id`,`plan_id`,`buy_date`,`expiry_date`,`created_date`) 
    VALUES ('$currentid','$planid','$buydate','$expirydate','$created_date')");

    $oid = mysqli_insert_id($sql);

    $orderid = 'QBOM00'.$oid;

    mysqli_query($sql,"INSERT INTO `cr_cart_plan` (`sku`,`plan_role`, `amount`,`time`,`users`, `menu_title`,`multilingual_title`,
    `items`, `order_management`,`custom_interface`,`sms`,`support`, `payment_method`,`take_away_management`)
    SELECT `sku`,`plan_role`, `amount`,`time`,`users`, `menu_title`,`multilingual_title`,`items`, `order_management`,
    `custom_interface`,`sms`,`support`, `payment_method`,`take_away_management` FROM `cr_plan` WHERE `plan_id` = '$planid'");
    $ccpid = mysqli_insert_id($sql);

    $query8 = mysqli_query($sql,"SELECT ccp.plan_role, cpr.title FROM `cr_cart_plan` as ccp 
    LEFT JOIN `cr_plan_role` as cpr on cpr.id = ccp.plan_role WHERE ccp.cart_id = $ccpid");
    $listdata8 = mysqli_fetch_object($query8);
    $plantitle = $listdata8->title;
    
    mysqli_query($sql,"UPDATE `cr_cart_plan` SET `title` = '$plantitle' WHERE `cart_id` = $ccpid");

    mysqli_query($sql,"UPDATE `cr_order_plan` SET `orderid` = '$orderid', `cart_id` = '$ccpid',`resto_id` = '$rid',
        `status` = 1 WHERE id = $oid");

    mysqli_query($sql,"UPDATE `cr_users` SET `order_pid` = '$oid' WHERE id = $currentid");

} else {












    
    $query2 = mysqli_query($sql,"INSERT INTO `cr_order_plan` (`user_id`,`plan_id`,`created_date`) 
    VALUES ('$currentid','$planid','$created_date')");

    $oid = mysqli_insert_id($sql);

    $orderid = 'QBOM00'.$oid;

    mysqli_query($sql,"INSERT INTO `cr_cart_plan` (`sku`,`plan_role`, `amount`,`time`,`users`, `menu_title`,`multilingual_title`,
    `items`, `order_management`,`custom_interface`,`sms`,`support`, `payment_method`,`take_away_management`)
    SELECT `sku`,`plan_role`, `amount`,`time`,`users`, `menu_title`,`multilingual_title`,`items`, `order_management`,
    `custom_interface`,`sms`,`support`, `payment_method`,`take_away_management` FROM `cr_plan` WHERE `plan_id` = '$planid'");
    $ccpid = mysqli_insert_id($sql);

    $query8 = mysqli_query($sql,"SELECT ccp.plan_role, cpr.title FROM `cr_cart_plan` as ccp 
    LEFT JOIN `cr_plan_role` as cpr on cpr.id = ccp.plan_role WHERE ccp.cart_id = $ccpid");
    $listdata8 = mysqli_fetch_object($query8);
    $plantitle = $listdata8->title;
    
    mysqli_query($sql,"UPDATE `cr_cart_plan` SET `title` = '$plantitle' WHERE `cart_id` = $ccpid");

    $query4 = mysqli_query($sql, "SELECT * FROM `cr_order_plan` WHERE `user_id` = '$currentid' and `status` = 1");
    $listdata4 = mysqli_fetch_object($query4);
    $exdate = $listdata4->expiry_date;
    $cudate = date('Y-m-d H:i:s');

    if($exdate < $cudate) 
    {
        // IF THE PLAN IS EXPIRED BEFORE CURRENT DATE
        if($time == 1) {
            $expirydate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($cudate)));
        } else {
            $expirydate = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($cudate)));   
        }
        mysqli_query($sql,"UPDATE `cr_order_plan` SET `orderid` = '$orderid', `cart_id` = '$ccpid',`resto_id` = '$rid',
            `buy_date` = '$cudate', `expiry_date` = '$expirydate',  `status` = '1' WHERE id = $oid");
    } else {
        // IF THE PLAN IS NOT EXPIRED BEFORE CURRENT DATE
        $query6 = mysqli_query($sql, "SELECT * FROM `cr_order_plan` WHERE `user_id` = $currentid and `status` != 2 ORDER BY `expiry_date` DESC LIMIT 1");
        $listdata6 = mysqli_fetch_object($query6);
        $exdate = $listdata6->expiry_date;

        if($time == 1) {
            $expirydate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($exdate)));
        } else {
            $expirydate = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($exdate)));   
        }

        mysqli_query($sql,"UPDATE `cr_order_plan` SET `orderid` = '$orderid', `cart_id` = '$ccpid',`resto_id` = '$rid',
        `buy_date` = '$exdate', `expiry_date` = '$expirydate' WHERE id = $oid");
    }

    if($exdate < $cudate) {
        mysqli_query($sql,"UPDATE `cr_users` SET `order_pid` = '$oid', `plan_status` = '1' WHERE id = $currentid");
        $query7 = mysqli_query($sql, "SELECT * FROM `cr_users` WHERE `id` = $currentid and `registertype` = 1");
        $listdata7 = mysqli_fetch_object($query7);
        $order_pid = $listdata7->order_pid;
        mysqli_query($sql,"UPDATE `cr_users` SET `order_pid` = '$order_pid' WHERE `rid` = $rid and `role_id` != ''");
    }

    LoginSubscriptionOne($sql, $rid, $oid, $plan_role);

}

if($time == 1){
    $displaytime = 'Month';
} else {
    $displaytime = 'Annum';
}

// SUBSCRIPTION PLAN MAIL - USER
$subject="Obrigado por comprar o plano de assinatura - ".$fromname;
$to=$email;
$message='<div style="padding: 50px 0px;background: #f5f5f5;width: 100%;">
            <div style="border: 0px solid #70d8ed; padding: 20px;background: #fff; width: 700px; margin: 0 auto;">
                <div style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #03bbe1;">
                    <div style=" text-align:center;">
                        <a href="'.$mainlink.'">
                            <img src="'.$logo.'" style="width:150px; background: #202342;" />
                        </a>
                    </div>
                </div>			  
                <div>
                    <p style="margin:0px 0px 10px 0px">
                    <p>Caro '.$fname.' '.$lname.',</p>
                    <p>Obrigado por comprar o plano de assinatura</p>
                    <p>Detalhes do plano</p>
                    <table style="width:100%;">
                        <thead>
                            <tr>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Plan</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Amount</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Order Id</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Date of Buy Plan</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Date of Expiry Plan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;"> <code>('.$mailsku.')</code> | '.$plantitle.' <code>('.$displaytime.')</code></td>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">'.$amount.'</td>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">'.$orderid.'</td>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">'.$buydate.'</td>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">'.$expirydate.'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Atenciosamente,</p>
                    <p>Obrigado,</p>
                    <a href="'.$mainlink.'" style="text-decoration:none;">
                        <p>Equipe '.$fromname.'</p>
                    </a>
                </div>
            </div>
        </div>';
            
sendmail($host,$port,$username,$password,$from,$fromname,$to,$subject,$message);

if($amount == 0)
{
    $transactionID = randomString(28);
    mysqli_query($sql,"INSERT INTO `cr_stripe_payment` (`opid`,`transactionID`,`paidAmount`,`paymentstatus`,`during`,`created_date`) 
    VALUES ('$oid','$transactionID',0,'succeeded',1,'$created_date')");
    // REDIRECT TO THANK YOU PAGE
    echo '<script>window.location.href="'.$mainlink.'success/'.$transactionID.'"</script>';
} else {
    mysqli_query($sql,"INSERT INTO `cr_stripe_payment` (`opid`,`stripeToken`,`transactionID`,`paymentID`,`paymentstatus`,`paymentCurrency`,
    `paymentReceiptURL`,`paidAmount`,`customer_id`,`during`,`created_date`) 
    VALUES ('$oid','$stripeToken','$transactionID','$paymentID','$paymentstatus','$paymentCurrency',
    '$paymentReceiptURL','$paidAmount','$customer_id','2','$created_date')");
    // REDIRECT TO THANK YOU PAGE
    echo '<script>window.location.href="'.$mainlink.'success/'.$transactionID.'"</script>';     
}

?>