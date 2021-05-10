<?php 

// REGISTER BUY PLAN & LOGIN BUY PLAN
if(isset($_GET['plan']))
{
    $planid = $_GET['plan'];
    $query = mysqli_query($sql,"SELECT cp.*, cpr.title FROM `cr_plan` as cp 
    LEFT JOIN `cr_plan_role` as cpr on cpr.id = cp.plan_role WHERE cp.`status` = 'Active' and cp.`sku` = '$planid'");
    $csku = mysqli_num_rows($query);
    if($csku == 1)
    {
        $listdata = mysqli_fetch_object($query);
        $plan_id = $listdata->plan_id;
        $sku = $listdata->sku;
        $heading = $listdata->title;
        $amount = $listdata->amount;
        $time = $listdata->time;
        if($time == 1){
            $displaytime = 'Mês';
        } else {
            $displaytime = 'Annum';
        }
    } else {
        echo '<script>alert("Algo errado!");</script>';
        echo '<script>window.location.href="'.$mainlink.'";</script>';
    }
}

// MONTHLY PLAN
function monthplan($temprestaurant, $sql, $mainlink)
{
    $query = mysqli_query($sql,"SELECT cp.*, cpr.title FROM `cr_plan` as cp LEFT JOIN `cr_plan_role` as cpr on cpr.id = cp.plan_role WHERE cp.`status` = 'Active' and cp.`time` = '1'");
    while($listdata = mysqli_fetch_object($query))
    {
        $plan_id = $listdata->plan_id;
        $sku = $listdata->sku;
        $heading = $listdata->title;
        $amount = $listdata->amount;
        $time = $listdata->time;
        if($time == 1){
            $displaytime = 'Month';
        } else {
            $displaytime = 'Annum';
        }
        $users = $listdata->users;
        $menu_title = $listdata->menu_title;
        $multilingual_title = $listdata->multilingual_title;
        $items = $listdata->items;
        $order_management = $listdata->order_management;
        $custom_interface = $listdata->custom_interface;
        $sms = $listdata->sms;
        $support = $listdata->support;
        $payment_method = $listdata->payment_method;
        $take_away_management = $listdata->take_away_management;

        commanplandiv($sku, $temprestaurant, $sql, $mainlink, $plan_id, $heading, $amount, $time, $displaytime, $users, $menu_title, $multilingual_title, $items, $order_management, $custom_interface, $sms, $support, $payment_method, $take_away_management);
    }
}

// ANNUM PLAN
function annumplan($temprestaurant, $sql, $mainlink)
{
    //$query = mysqli_query($sql,"SELECT * FROM `cr_plan` WHERE `status` = 'Active' and `time` = '2'");
    $query = mysqli_query($sql,"SELECT cp.*, cpr.title FROM `cr_plan` as cp LEFT JOIN `cr_plan_role` as cpr on cpr.id = cp.plan_role WHERE cp.`status` = 'Active' and cp.`time` = '2'");
    while($listdata = mysqli_fetch_object($query))
    {
        $plan_id = $listdata->plan_id;
        $sku = $listdata->sku;
        $heading = $listdata->title;
        $amount = $listdata->amount;
        $time = $listdata->time;
        if($time == 1){
            $displaytime = 'Month';
        } else {
            $displaytime = 'Annum';
        }
        $users = $listdata->users;
        $menu_title = $listdata->menu_title;
        $multilingual_title = $listdata->multilingual_title;
        $items = $listdata->items;
        $order_management = $listdata->order_management;
        $custom_interface = $listdata->custom_interface;
        $sms = $listdata->sms;
        $support = $listdata->support;
        $payment_method = $listdata->payment_method;
        $take_away_management = $listdata->take_away_management;

        commanplandiv($sku, $temprestaurant, $sql, $mainlink, $plan_id, $heading, $amount, $time, $displaytime, $users, $menu_title, $multilingual_title, $items, $order_management, $custom_interface, $sms, $support, $payment_method, $take_away_management);
    }
}

function commanplandiv($sku, $temprestaurant, $sql, $mainlink, $plan_id, $heading, $amount, $time, $displaytime, $users, $menu_title, $multilingual_title, $items, $order_management, $custom_interface, $sms, $support, $payment_method, $take_away_management)
{
    echo'<div class="pricing-item-2">
            <div>
                <h5 class="cate">'.$heading.'</h5>
                <h2 class="title">'.$amount.'<sup> €</sup></h2>
                <span class="info">'.$displaytime.'</span>
            </div>
            <ul class="pricing-content-3">';
                if($users < 1000) {
                    echo '<li>'.$users.' Utilizador </li>';
                } else {
                    echo '<li>Utilizadores ilimitados </li>';
                }

                if($menu_title != '') {
                    echo'<li>'.$menu_title.'</li>';
                }
                
                if($multilingual_title != '') {
                    echo'<li>'.$multilingual_title.'</li>';
                }
                
                if($order_management == 2) {
                    echo'<li>Gestão de Pedidos</li>';
                }

                if($take_away_management == 2) {
                    echo'<li>Gestão Take Away</li>';
                }

                if($items != '') {
                    if($items < 1000) {
                        echo'<li>Até '.$items.' itens no cardápio</li>';
                    } else {
                        echo'<li>Itens no cardápio ilimitado</li>';
                    }
                }

                if($sms == 2) {
                    echo'<li>Alertas por SMS</li>';
                }

                if($payment_method == 2) {
                    echo'<li>Meios de pagamentos</li>';
                }

                if($custom_interface != '') {
                    echo'<li>Interface personalizado</li>';
                }

                if($support == 1) {
                    echo'<li>Suporte Gratuito</li>';
                } else {
                    echo'<li>Suporte online</li>';
                }
        echo'</ul>';
            if($temprestaurant != '')
            {
                echo '<a href="'.$mainlink.'loginbuyplan/'.$sku.'/'.$temprestaurant.'/" class="get-button">Escolher<i class="flaticon-right"></i></a>';
            } else {
                echo '<a href="'.$mainlink.'registerbuyplan/'.$sku.'" class="get-button">Escolher<i class="flaticon-right"></i></a>';
            }
            echo'</div>';
}

// RANDOM STRING GENERATE
function randomString($length = 6)
{
    $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789';
    $str = '';
    $max = strlen($chars) - 1;
    for ($i=0; $i < $length; $i++)
      $str .= $chars[rand(0, $max)];
    return $str;
}

// EMAIL CONFIGURATION
$emailquery = mysqli_query($sql,"SELECT * FROM `cr_email_settings` WHERE `rid` = 0");
$emaillistdata = mysqli_fetch_object($emailquery);
$smtp_host = $emaillistdata->smtp_host;
$smtp_port = $emaillistdata->smtp_port;
$smtp_user = $emaillistdata->smtp_user;
$smtp_password = $emaillistdata->smtp_password;
$mail_config = $emaillistdata->mail_config;

// RESTAURANT DIRECT UPDATE SUBSCRIPTION PLAN VIA PANEL LOGIN
$temprestaurant = '';
$defaultemail = '';
$defaultpassword = '';

if(isset($_GET['restaurant'])) 
{
    $temprestaurant = $_GET['restaurant'];
    echo'<style>.header-section, .banner-8, #feature, .work-section, .faq-section, .safe-section, .footer-section { display:none; } </style>'; 
}

if(isset($_GET['restaurant']))
{
    $aa = $_GET['restaurant'];
    $userquery1 = mysqli_query($sql,"SELECT * FROM `cr_site_settings` WHERE `nameurl` = '$aa'");
    $ccount = mysqli_num_rows($userquery1);
    if($ccount == 1) 
    {
        $userquerylistdata1 = mysqli_fetch_object($userquery1);
        $sgetid = $userquerylistdata1->id;
        
        $userquery2 = mysqli_query($sql,"SELECT * FROM `cr_users` WHERE `rid` = '$sgetid' and `registertype` = 1");
        $userquerylistdata2 = mysqli_fetch_object($userquery2);
        $defaultemail = $userquerylistdata2->email;
        $defaultpassword = $userquerylistdata2->password;
    } else {
        echo '<script>window.location.href="'.$mainlink.'";</script>';
    }
}

// FOR PAYMENT GATEWAY
function calculateRealNumber($amount) {
    return (($amount)*100);
}

// ADMIN PORTAL EMAIL
$adminemailquery = mysqli_query($sql,"SELECT * FROM `cr_site_settings` WHERE `id` = 0");
$adminemaillistdata = mysqli_fetch_object($adminemailquery);
$adminportalemail = $adminemaillistdata->portal_email;

// PAYMENT GATEWAY
function planamountcalc($sql, $newquery1, $amount)
{
    $listdatanewquery1 = mysqli_fetch_object($newquery1);
    
    $plan_id = $listdatanewquery1->plan_id;
    $buy_date = $listdatanewquery1->buy_date;
    $expiry_date = $listdatanewquery1->expiry_date;
    
    $Adate1 = date_create(date('Y-m-d', strtotime($buy_date)));
    $Adate2 = date_create(date('Y-m-d', strtotime($expiry_date)));
    $Adiff = date_diff($Adate1,$Adate2);
    $plandaycount = $Adiff->format("%a"); // PLAN DAY COUNT (28, 29, 30, 31)
       
    // HOW MANY DAY REMAINING CURRENT DATE TO OLD PLAN EXPIRY DATE
    $Bdate1 = date_create(date('Y-m-d', strtotime(date('Y-m-d')))); // CURRENT DATE
    $Bdate2 = date_create(date('Y-m-d', strtotime($expiry_date))); 
    $Bdiff = date_diff($Bdate1,$Bdate2);
    $remingday = $Bdiff->format("%a"); // PLAN DAY COUNT (REMAINING DAY) 28
        
    $newquery2 = mysqli_query($sql, "SELECT * FROM `cr_plan` WHERE `plan_id` = '$plan_id'");
    $listdatanewquery2 = mysqli_fetch_object($newquery2);
    $oldplanamount = $listdatanewquery2->amount;
        
    $planperday = $oldplanamount / $plandaycount; // GET PER AMOUNT
    $remianingamount = $planperday * $remingday; // REMAINING DAY * PER DAY
    $amount = $amount - $remianingamount; // 30 - 30

    return $amount;
}

?>