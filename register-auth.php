<?php 

$fnameerror = '';
$lnameerror = '';
$emailerror = '';
$phoneerror = '';
$passworderror = '';
$allerror = '';
$restonameerror = '';

// CHECK EMAIL
function checkemail($email,$sql)
{
    $query = mysqli_query($sql, "select `email` from `cr_users` where email = '$email'");
    $num = mysqli_num_rows($query);
    return $num;
}

// CHECK PHONE
function checkphone($phone,$sql)
{
    $query = mysqli_query($sql, "select `phone` from `cr_users` where phone = '$phone'");
    $num = mysqli_num_rows($query);
    return $num;
}

// CHECK RESTAURANT
function checkrestaurant($restoname,$sql)
{
    $query = mysqli_query($sql, "select `name` from `cr_site_settings` where `name` = '$restoname'");
    $num = mysqli_num_rows($query);
    return $num;
}

if(isset($_POST['registersubmitplan']))
{
    $planid = mysqli_real_escape_string($sql,$_POST['planid']);
    $fname = mysqli_real_escape_string($sql,$_POST['fname']);
    $lname = mysqli_real_escape_string($sql,$_POST['lname']);
    $restoname = mysqli_real_escape_string($sql,$_POST['restoname']);
    $phone = mysqli_real_escape_string($sql,$_POST['phone']);
    $email = mysqli_real_escape_string($sql,$_POST['email']);
    $password = mysqli_real_escape_string($sql,$_POST['password']);
    $enum = checkemail($email,$sql);
    $rnum = checkrestaurant($restoname,$sql);
    $pnum = checkphone($phone,$sql);
    $reg = 0;

    //$restonameurl = strtolower(preg_replace("/[^a-zA-Z]+/", "", $restoname));

    if(empty($_POST['fname'])) 
    {
		$fnameerror = "Este campo é obrigatório";
		$reg=1;	
    }
    if(empty($_POST['lname'])) 
    {
		$lnameerror = "Este campo é obrigatório";
		$reg=1;	
    }
    if(empty($_POST['restoname'])) 
    {
		$restonameerror = "Este campo é obrigatório";
		$reg=1;	
    }
    if(empty($_POST['phone'])) 
    {
		$phoneerror = "Este campo é obrigatório";
		$reg=1;	
    }
    if(empty($_POST['email'])) 
    {
		$emailerror = "Este campo é obrigatório";
		$reg=1;	
    }
    if(empty($_POST['password'])) 
    {
		$passworderror = "Este campo é obrigatório";
		$reg=1;	
	}

    if($reg == 0) // CHECH THE VALIDATION
    {
        if($rnum == 0) // CHECK THE RESTAURANT
        {
            if($pnum == 0) // CHECK THE PHONE NUMBER
            {
                if($enum == 0) // CHECK THE EMAIL ID
                {
                    $fname =  base64_encode($fname);
                    $lname =  base64_encode($lname);
                    $restoname =  base64_encode($restoname);
                    $phone =  base64_encode($phone);
                    $email =  base64_encode($email);
                    $password =  base64_encode($password);
                    // $amount =  base64_encode($amount);
                    
                    echo '<script>window.location.href="'.$mainlink.'auth-register.php?planid='.$planid.'&fname='.$fname.'&lname='.$lname.'&restoname='.$restoname.'&phone='.$phone.'&email='.$email.'&password='.$password.'";</script>';
                } else {
                    $emailerror = "Email já existe!";
                }
            } else {
                $phoneerror = "Número de celular já cadastrado";
            }
        } else {
            $restonameerror = "O nome do restaurante já existe!";
        }
    } else {
        $allerror = "Algo deu errado!";
    }
}



?>