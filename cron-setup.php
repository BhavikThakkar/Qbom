<?php 

include('config.php');

/**
| -----------------------------------------------------
| DO NOT REMOVE FILE - SET SUBSCRIPTION PLAN REMINDER (CRON FILE RUN EVERY 7 DAY & 1 DAY)
| -----------------------------------------------------
**/

// CRON JOB SETUP
function PHPLogFileFunction($cronrid, $cronrestoname, $cronrestoemail, $cronfirereason, $cronexpirydate) 
{
    $log  = ':: '.date("F j, Y, g:i a").PHP_EOL.
        "Restaurant ID : ".$cronrid.PHP_EOL.
        "Restaurant Name: ".$cronrestoname.PHP_EOL.
        "Email: ".$cronrestoemail.PHP_EOL.
        "Expiry Date: ".$cronexpirydate.PHP_EOL.
        "Status: ".$cronfirereason.PHP_EOL.
        "--------------------------------------------------".PHP_EOL;
    file_put_contents('./cron-log/Cron-Log-'.date("j-n-Y").'.log', $log, FILE_APPEND);
}

$query = mysqli_query($sql,"SELECT cu.rid, cu.username, cu.email, cop.expiry_date, cop.status, css.name as restoname FROM `cr_users` as cu 
LEFT JOIN `cr_order_plan` as cop on cop.id = cu.order_pid
LEFT JOIN `cr_site_settings` as css on css.id = cu.rid
WHERE cu.registertype = 1 and cu.plan_status = 1 and cop.status = 1");
while($cronjob1 = mysqli_fetch_object($query))
{
    $cronexpirydate = date('Y-m-d', strtotime($cronjob1->expiry_date));
    $croncurdate7 = date('Y-m-d', strtotime("+7 days"));
    $croncurdate1 = date('Y-m-d', strtotime("+1 days"));
    $cronrestoemail = $cronjob1->email;
    $cronrestoname = $cronjob1->restoname;
    $cronrid = $cronjob1->rid;

    // FIRE 7 DAY REMINDER SLOT
    if($croncurdate7 == $cronexpirydate) {
        $cronemailtemplate = mysqli_query($sql, "SELECT * FROM `cr_email_templates` WHERE `subject` = 'plan_reminders' and  `status` = 'Active' and `rid` = '0'");
        $cronemailtemplate = mysqli_fetch_object($cronemailtemplate);

        $cronemaillquery = mysqli_query($sql, "SELECT * FROM `cr_site_settings` WHERE `id` = 0");
        $cronemaillquery = mysqli_fetch_object($cronemaillquery);
        $site_title = $cronemaillquery->site_title;
        $land_line = $cronemaillquery->land_line;
        $rights_reserved_content = $cronemaillquery->rights_reserved_content;
        $portal_email = $cronemaillquery->portal_email;
        $slogo = $cronemaillquery->site_logo;
        $slogopath = $mainlink.'assets/images/logo/'.$slogo;
    
        if (!empty($cronemailtemplate)) {
            $content = $cronemailtemplate->email_template;
            $subject="Seu plano expira em breve. - ".$fromname;
            $to=$cronrestoemail;
            $message='<div style="padding: 50px 0px;background: #f5f5f5;width: 100%;">
                        <div style="border: 0px solid #70d8ed; padding: 20px;background: #fff; width: 700px; margin: 0 auto;">
                            <div style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #03bbe1;">
                                <div style=" text-align:center;">
                                    <a href="'.$mainlink.'">
                                        <img src="'.$slogopath.'" style="width:150px; background: #202342;" />
                                    </a>
                                </div>
                            </div>	
                            <div>Olá '.$cronrestoname.' restaurante,</div>
                            <div>'.$content.'</div>		  
                        </div>
                    </div>';
            
            sendmail($host,$port,$username,$password,$from,$fromname,$to,$subject,$message);
            $cronfirereason = 'MAIL SENT - RESTAURANT EXPIRE SOON IN THIS 7 DAYS';
            PHPLogFileFunction($cronrid, $cronrestoname, $cronrestoemail, $cronfirereason, $cronexpirydate);
        } else {
            $cronfirereason = 'Something Wrong! - In 7 Days Slot';
            PHPLogFileFunction($cronrid, $cronrestoname, $cronrestoemail, $cronfirereason, $cronexpirydate);
        }
    } 

    // FIRE 1 DAY REMINDER SLOT
    if($croncurdate1 == $cronexpirydate) {
        $cronemailtemplate = mysqli_query($sql, "SELECT * FROM `cr_email_templates` WHERE `subject` = 'plan_reminders' and  `status` = 'Active' and `rid` = '0'");
        $cronemailtemplate = mysqli_fetch_object($cronemailtemplate);

        $cronemaillquery = mysqli_query($sql, "SELECT * FROM `cr_site_settings` WHERE `id` = 0");
        $cronemaillquery = mysqli_fetch_object($cronemaillquery);
        $site_title = $cronemaillquery->site_title;
        $land_line = $cronemaillquery->land_line;
        $rights_reserved_content = $cronemaillquery->rights_reserved_content;
        $portal_email = $cronemaillquery->portal_email;
        $slogo = $cronemaillquery->site_logo;
        $slogopath = $mainlink.'assets/images/logo/'.$slogo;
    
        if (!empty($cronemailtemplate)) {
            $content = $cronemailtemplate->email_template;
            $subject="Seu plano expira em breve. - ".$fromname;
            $to=$cronrestoemail;
            $message='<div style="padding: 50px 0px;background: #f5f5f5;width: 100%;">
                        <div style="border: 0px solid #70d8ed; padding: 20px;background: #fff; width: 700px; margin: 0 auto;">
                            <div style="padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #03bbe1;">
                                <div style=" text-align:center;">
                                    <a href="'.$mainlink.'">
                                        <img src="'.$slogopath.'" style="width:150px; background: #202342;" />
                                    </a>
                                </div>
                            </div>	
                            <div>Olá '.$cronrestoname.' restaurante,</div>
                            <div>'.$content.'</div>		  
                        </div>
                    </div>';
            
            sendmail($host,$port,$username,$password,$from,$fromname,$to,$subject,$message);
            $cronfirereason = 'MAIL SENT - RESTAURANT EXPIRE AFTER 1 DAY';
            PHPLogFileFunction($cronrid, $cronrestoname, $cronrestoemail, $cronfirereason, $cronexpirydate);
        } else {
            $cronfirereason = 'Something Wrong! - 1 Day Slot';
            PHPLogFileFunction($cronrid, $cronrestoname, $cronrestoemail, $cronfirereason, $cronexpirydate);
        }
    } 
}

?>