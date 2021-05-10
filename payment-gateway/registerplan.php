<?php 

// MANAGE PAGE MASTER
function pagerolemanage($sql, $restoid, $roleid)
{
    $query8 = mysqli_query($sql,"SELECT * FROM `page_master` WHERE `deleted` != 1");
    $countquery8 = mysqli_num_rows($query8); // COUNT 40
    for($i=0; $i<$countquery8; $i++) {
        while($listdata8 = mysqli_fetch_object($query8))
        {
            $pageid = $listdata8->id;
            mysqli_query($sql,"INSERT INTO `pagerole` (`rid`,`roleid`,`pageid`,`accessid`) VALUES ('$restoid','$roleid','$pageid',1)");
        }    
    }
}

function otherpagerolemanageA($sql,$restoid)
{
    $testaquery = mysqli_query($sql,"SELECT * FROM `cr_role` WHERE `rid` = '$restoid' and `gid` != 1");
    while($listtestaquery = mysqli_fetch_object($testaquery))
    {
        $getroleid = $listtestaquery->role_id;
        otherpagerolemanageB($sql, $getroleid, $restoid);
    }
}

function otherpagerolemanageB($sql, $getroleid, $restoid)
{
    $query8 = mysqli_query($sql,"SELECT * FROM `page_master` WHERE `deleted` != 1");
    $countquery8 = mysqli_num_rows($query8); // COUNT 40
    for($i=0; $i<$countquery8; $i++) {
        while($listdata8 = mysqli_fetch_object($query8))
        {
            $pageid = $listdata8->id;
            mysqli_query($sql,"INSERT INTO `pagerole` (`rid`,`roleid`,`pageid`,`accessid`) VALUES ('$restoid','$getroleid','$pageid',0)");
        }    
    }
}

// SMS GATEWAY SETTINGS & FIELDS
function smsgatewayfunction($sql, $restoid)
{
    $one = mysqli_query($sql,"SELECT * FROM `cr_sms_gate_ways_setup`");
    while($listone = mysqli_fetch_object($one))
    {
        $sms_gateway_name = $listone->sms_gateway_name;
        $sms_gateway_id = $listone->sms_gateway_id;

        mysqli_query($sql,"INSERT INTO `cr_sms_gate_ways` (`rid`,`sms_gateway_name`) VALUES ('$restoid', '$sms_gateway_name')");
        $oneinsertid = mysqli_insert_id($sql);

        systemsettingfieldsfunction($sql, $restoid, $sms_gateway_id, $oneinsertid);
    }
}

function systemsettingfieldsfunction($sql, $restoid, $sms_gateway_id, $oneinsertid)
{
    $three = mysqli_query($sql,"SELECT * FROM `cr_system_settings_fields_setup` WHERE `sms_gateway_id` = '$sms_gateway_id'");
    while($listthree = mysqli_fetch_object($three))
    {
        $field_name = $listthree->field_name;
        $field_key = $listthree->field_key;
        $is_required = $listthree->is_required;
        $field_output_value = $listthree->field_output_value;

        mysqli_query($sql,"INSERT INTO `cr_system_settings_fields` (`rid`,`sms_gateway_id`,`field_name`,`field_key`,`is_required`,`field_output_value`) 
        VALUES ('$restoid', '$oneinsertid','$field_name','$field_key','$is_required','$field_output_value')");
    }
}

function defaultinsertqueries($sql, $restoid)
{
    // LOYALITY POINTS
    mysqli_query($sql,"INSERT INTO `cr_loyality_points` (`rid`,`points_enabled`,`points_label_redeem_placeholder`,`points_label_earn`,
    `points_label_template`,`maximum_earning_points_for_customer`,`earning_point`,`earning_point_value`,`redeeming_point`,
    `redeeming_point_value`,`disabled_redeeming`,`reward_points_for_account_signup`,`points_for_restaurant_review`,
    `points_for_first_order`,`points_for_sharing_app`,`minimum_points_can_be_used`,`maximum_points_can_be_used`,`enable_redeeming`) 
    VALUES ('$restoid','No','XYZ','Points','You earned {points} points','0','0','0.00','0','0.00','No','0','0','0','0','0','0','No')");

    // REFERRAL SETTINGS
    mysqli_query($sql,"INSERT INTO `cr_referral_settings` (`rid`,`referral_enabled`,`points_for_refer_anyone`,`points_for_referred_by_anyone`) 
    VALUES ('$restoid','No','0','0')");

    // PAGES
    mysqli_query($sql,"INSERT INTO `cr_pages` (`slug`, `name`,`description`)
    SELECT `slug`, `name`,`description` FROM `cr_pages_setup`");
    $pgid = mysqli_insert_id($sql);
    mysqli_query($sql,"UPDATE `cr_pages` SET `rid` = '$restoid' WHERE `id` >= $pgid");
    
    // TINIFY SETTINGS
    mysqli_query($sql,"INSERT INTO `cr_tinify_settings` (`rid`,`use_tinify`,`API_Key`,`compress`,`thumb`) VALUES ('$restoid','No','','','')");

    // SMS TEMPLATES
    mysqli_query($sql,"INSERT INTO `cr_sms_templates` (`subject`, `sms_template`)
    SELECT `subject`, `sms_template` FROM `cr_sms_templates_setup`");
    $stid = mysqli_insert_id($sql);
    mysqli_query($sql,"UPDATE `cr_sms_templates` SET `rid` = '$restoid' WHERE `sms_template_id` >= $stid");

    // RESTAURANT TIMINGS
    mysqli_query($sql,"INSERT INTO `cr_restaurant_timings` (`day`, `status`, `from_time`, `to_time`)
    SELECT `day`, `status`, `from_time`, `to_time` FROM `cr_restaurant_timings_setup`");
    $rtid = mysqli_insert_id($sql);
    mysqli_query($sql,"UPDATE `cr_restaurant_timings` SET `rid` = '$restoid' WHERE `id` >= $rtid");

    // $restoid = 8;
    // mysqli_query($sql,"INSERT INTO `cr_languagewords` (`phrase_for`, `lang_key`, `english`, `portuguese`, `espanhol`, `francs`)
    // SELECT `phrase_for`, `lang_key`, `english`, `portuguese`, `espanhol`, `francs` FROM `cr_languagewords` WHERE `rid` = 1");
    // $rttid = mysqli_insert_id($sql);
    // mysqli_query($sql,"UPDATE `cr_languagewords` SET `rid` = '$restoid' WHERE `lang_id` >= $rttid");

    // EMAIL TEMPLATES
    mysqli_query($sql,"INSERT INTO `cr_email_templates` (`subject`, `email_template`)
    SELECT `subject`, `email_template` FROM `cr_email_templates_setup` WHERE `eflag` = 0");
    $etid = mysqli_insert_id($sql);
    mysqli_query($sql,"UPDATE `cr_email_templates` SET `rid` = '$restoid' WHERE id >= $etid");
    
    // SOCIAL NETWORKS
    mysqli_query($sql,"INSERT INTO `cr_social_networks` (`rid`,`facebook`,`twitter`,`google_plus`,`linked_in`,`instagram`,`pinterest`,`tumblr`) 
    VALUES ('$restoid','','','','','','','')");

    // EMAIL SETTINGS
    mysqli_query($sql,"INSERT INTO `cr_email_settings` (`rid`,`smtp_host`,`smtp_port`,`smtp_user`,`smtp_password`,`api_key`,`mail_config`) 
    VALUES ('$restoid','','','','','','webmail')");

    // PAYPAL SETTINGS
    mysqli_query($sql,"INSERT INTO `cr_paypal_settings` (`rid`,`PayPalEnvironmentProduction`,`PayPalEnvironmentSandbox`,`merchantName`,
    `merchantPrivacyPolicyURL`,`merchantUserAgreementURL`,`currency`,`account_type`,`paypal_email`) 
    VALUES ('$restoid','','','','','','EUR','','')");

    smsgatewayfunction($sql, $restoid);
}

function createplanrole($sql,$restoid,$plan_role)
{
    if($plan_role == 1) {
        mysqli_query($sql,"INSERT INTO `cr_role` (`gid`,`title`)
        SELECT `id`,`description` FROM `cr_groups` WHERE id = 1 OR id = 5");
        $crid = mysqli_insert_id($sql);
        mysqli_query($sql,"UPDATE `cr_role` SET `rid` = '$restoid' WHERE `role_id` >= $crid");
        otherpagerolemanageA($sql,$restoid);
    }
    if($plan_role == 2) {
        mysqli_query($sql,"INSERT INTO `cr_role` (`gid`,`title`)
        SELECT `id`,`description` FROM `cr_groups` WHERE id = 1 OR id = 5 OR id = 6");
        $crid = mysqli_insert_id($sql);
        mysqli_query($sql,"UPDATE `cr_role` SET `rid` = '$restoid' WHERE `role_id` >= $crid");
        otherpagerolemanageA($sql,$restoid);
    }
    if($plan_role == 3) {
        mysqli_query($sql,"INSERT INTO `cr_role` (`gid`,`title`)
        SELECT `id`,`description` FROM `cr_groups` WHERE id = 1 OR id = 3 or id = 5 OR id = 6");
        $crid = mysqli_insert_id($sql);
        mysqli_query($sql,"UPDATE `cr_role` SET `rid` = '$restoid' WHERE `role_id` >= $crid");
        otherpagerolemanageA($sql,$restoid);
    }
    if($plan_role == 4) {
        mysqli_query($sql,"INSERT INTO `cr_role` (`gid`,`title`)
        SELECT `id`,`description` FROM `cr_groups` WHERE id = 1 OR id = 3 or id = 4 OR id = 5 OR id = 6");
        $crid = mysqli_insert_id($sql);
        mysqli_query($sql,"UPDATE `cr_role` SET `rid` = '$restoid' WHERE `role_id` >= $crid");
        otherpagerolemanageA($sql,$restoid);
    }
}

if($amount == 0)
{
    $planid = mysqli_real_escape_string($sql,$_POST['planid']);
    $fname = mysqli_real_escape_string($sql,$_POST['fname']);
    $lname = mysqli_real_escape_string($sql,$_POST['lname']);
    $restoname = mysqli_real_escape_string($sql,$_POST['restoname']);
    $phone = mysqli_real_escape_string($sql,$_POST['phone']);
    $email = mysqli_real_escape_string($sql,$_POST['email']);
    $password = mysqli_real_escape_string($sql,$_POST['password']);
} else {
    $planid = mysqli_real_escape_string($sql,$_GET['planid']);
    $fname = mysqli_real_escape_string($sql,$_GET['fname']);
    $lname = mysqli_real_escape_string($sql,$_GET['lname']);
    $restoname = mysqli_real_escape_string($sql,$_GET['restoname']);
    $phone = mysqli_real_escape_string($sql,$_GET['phone']);
    $email = mysqli_real_escape_string($sql,$_GET['email']);
    $password = mysqli_real_escape_string($sql,$_GET['password']);
}

$noconvertpassword = $password;
$activation_code = sha1(md5(microtime()));
$created_on = time();
$referral_code = randomString(10);
$password = md5($password);
$created_date = date("Y-m-d H:i:s");
$Tusername = $fname.' '.$lname;
$ipadd = get_ip();
$restonameurl = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $restoname));

$query6 = mysqli_query($sql,"INSERT INTO `cr_site_settings` (`name`,`nameurl`,`site_title`,`currency`,`facebook_app_id`,`facebook_app_secret`,`google_client_id`,`google_client_secret`,`created_date`) 
VALUES ('$restoname','$restonameurl','$restoname','EUR','facebook app id','facebook app secret','google app id','google app secret','$created_date')");
$restoid = mysqli_insert_id($sql); // GET RESTAURANT ID

// SET DEFAULT LANGUAGE
$defaultquery = mysqli_query($sql,"SELECT `site_language` FROM `cr_site_settings` WHERE `id` = 0");
$listdefaultquery = mysqli_fetch_object($defaultquery);
$site_language = $listdefaultquery->site_language;
mysqli_query($sql,"UPDATE `cr_site_settings` SET `site_language` = '$site_language' WHERE id = $restoid");

$query = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `status` = 'Active' and `plan_id` = '$planid'");
$listdata = mysqli_fetch_object($query);
$plan_role = $listdata->plan_role;
$time = $listdata->time;

// INSERT ROLE
createplanrole($sql,$restoid,$plan_role);

// SELECT ADMIN ROLE
$query8 = mysqli_query($sql,"SELECT * FROM `cr_role` WHERE `rid` = '$restoid' and `title` = 'Administrator'");
$listdata8 = mysqli_fetch_object($query8);
$roleid = $listdata8->role_id;

pagerolemanage($sql, $restoid, $roleid);
defaultinsertqueries($sql, $restoid);

mysqli_query($sql,"INSERT INTO `cr_seo_settings` (`rid`,`meta_keyword`,`meta_description`,`google_analytics`) 
VALUES ('$restoid','$restoname','$restoname','')");

$query1 = mysqli_query($sql,"INSERT INTO `cr_users` (`rid`,`role_id`,`plan_status`,`ip_address`,`first_name`,`last_name`,`phone`,`email`,`password`,`created_datetime`,`activation_code`,`created_on`,`referral_code`,`registertype`,`username`) 
    VALUES ('$restoid','$roleid','1','$ipadd','$fname','$lname', '$phone', '$email','$password','$created_date','$activation_code','$created_on','$referral_code',1,'$Tusername')");

$currentid = mysqli_insert_id($sql);

$buydate = $created_date;
if($time == 1){
    $expirydate = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($buydate)));
} else {
    $expirydate = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($buydate)));   
}

$query2 = mysqli_query($sql,"INSERT INTO `cr_order_plan` (`user_id`,`plan_id`,`buy_date`,`expiry_date`,`created_date`) 
    VALUES ('$currentid','$planid','$buydate','$expirydate','$created_date')");

$oid = mysqli_insert_id($sql);

//$transaction_id = '';
$orderid = 'QBOM00'.$oid;

mysqli_query($sql,"INSERT INTO `cr_cart_plan` (`sku`,`plan_role`, `amount`,`time`,`users`, `menu_title`,`multilingual_title`,
`items`, `order_management`,`custom_interface`,`sms`,`support`, `payment_method`,`take_away_management`)
SELECT `sku`, `plan_role`, `amount`,`time`,`users`, `menu_title`,`multilingual_title`,`items`, `order_management`,
`custom_interface`,`sms`,`support`, `payment_method`,`take_away_management` FROM `cr_plan` WHERE `plan_id` = '$planid'");
$ccpid = mysqli_insert_id($sql);

$query7 = mysqli_query($sql,"SELECT * FROM `cr_plan_role` WHERE `id` = '$plan_role'");
$listdata7 = mysqli_fetch_object($query7);
$plantitle = $listdata7->title;

mysqli_query($sql,"UPDATE `cr_cart_plan` SET `title` = '$plantitle' WHERE `cart_id` = $ccpid");

mysqli_query($sql,"UPDATE `cr_order_plan` SET `orderid` = '$orderid', `cart_id` = '$ccpid',`resto_id` = '$restoid',
    `status` = 1 WHERE id = $oid");

mysqli_query($sql,"UPDATE `cr_users` SET `order_pid` = '$oid' WHERE id = $currentid");

mysqli_query($sql,"UPDATE `cr_role` SET `access` = '$oid' WHERE `rid` = $restoid and gid != 1");

$query3 = mysqli_query($sql,"INSERT INTO `cr_users_groups` (`user_id`,`group_id`) VALUES ('$currentid',1)");

$query4 = mysqli_query($sql,"SELECT * FROM `cr_users` WHERE `id` = '$currentid'");
$listdata4 = mysqli_fetch_object($query4);

// {FOR MAIL PURPOSE}
$query5 = mysqli_query($sql,"SELECT cr.*, cpr.title as plantitle FROM `cr_plan` as cr 
LEFT JOIN `cr_plan_role` as cpr on cpr.id = cr.plan_role WHERE cr.`plan_id` = '$planid'");
$listdata5 = mysqli_fetch_object($query5);
$mailsku = $listdata5->sku;
$mailamount = $listdata5->amount;
$mailplantitle = $listdata5->plantitle;
$mailtime = $listdata5->time;
if($mailtime == 1){
    $maildisplaytime = 'Mês';
} else {
    $maildisplaytime = 'Annum';
}

// RESTAURANT MAIL - USER
$subject="Obrigado por registrar seu restaurante - ".$fromname;
$to=$email;
$message='<div style="padding: 50px 0px;background: #f5f5f5;width: 100%;">
            <div style="border: 0px solid #70d8ed; padding: 20px;background: #fff; width: 700px; margin: 0 auto;">
                <div style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #03bbe1;">
                    <div style=" text-align:center;">
                        <a href="'.$mainlink.'">
                            <img src="'.$logo.'" style="width:150px; background: #202342;" alt="'.$logo.'" />
                        </a>
                    </div>
                </div>			  
                <div>
                    <p style="margin:0px 0px 10px 0px">
                    <p>Caro '.$fname.' '.$lname.',</p>
                    <p>Bem-vindo ao '.$fromname.'</p>
                    <p>Suas credenciais são:</p>
                    <p>O email: '.$email.'</p>
                    <p>Senha: '.$noconvertpassword.'</p>
                    <p>Nome do restaurante: '.$restoname.'</p>
                    <p>Estamos muito gratos por ter decidido experimentar os nossos serviços, bem-vindo e obrigado pela confiança!!</p>
                    <P>Clique neste link para <a href="'.$mainlink.'activation/'.$currentid.'/'.$listdata4->activation_code.'">Activate Your Account</a></p>
                    <p>Atenciosamente,</p>
                    <p>Obrigado,</p>
                    <a href="'.$mainlink.'" style="text-decoration:none;">
                        <p>Equipe '.$fromname.'</p>
                    </a>
                </div>
            </div>
        </div>';
            
sendmail($host,$port,$username,$password,$from,$fromname,$to,$subject,$message);

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
                    <p>Obrigado por comprar o plano de assinatura.</p>
                    <p>Detalhes do plano</p>
                    <table style="width:100%;">
                        <thead>
                            <tr>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Plano</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Quantia</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Id do pedido</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Data de compra do plano</th>
                                <th style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">Data do Plano de Expiração</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">(<code>'.$mailsku.'</code>) | '.$mailplantitle.' <code>('.$maildisplaytime.')</code></td>
                                <td style="background: #efefef; border: 1px solid #ddd; padding: 5px; text-align: center;">'.$mailamount.'</td>
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

// RESTAURANT MAIL - ADMIN
$subject="Novo restaurante está registrado - ".$fromname;
$to=$adminmail;
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
                    <p>Caro Admin,</p>
                    <p>Novo restaurante está registrado</p>
                    <p>Suas credenciais são:</p>
                    <p>Nome de usuário: '.$Tusername.'</p>
                    <p>O email: '.$email.'</p>
                    <p>Nome do restaurante: '.$restoname.'</p>
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
    '$paymentReceiptURL','$paidAmount','$customer_id',1,'$created_date')");
    // REDIRECT TO THANK YOU PAGE
    echo '<script>window.location.href="'.$mainlink.'success/'.$transactionID.'"</script>';
}

// LOG ACTIVITY
mysqli_query($sql,"INSERT INTO `cr_activity_log` (`rid`, `opid`, `userid`, `activity`, `pmid`, `rowid`, `created_date`) 
VALUE ($restoid,$oid,$currentid,12,0,'$currentid','$created_date')");

?>