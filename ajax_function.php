<?php 

include('config.php');

// EMAIL ID CHECK
if(isset($_POST['checkmail']))
{
	$email = $_POST['checkmail'];
    $query1 = mysqli_query($sql, "SELECT `email` FROM `cr_users` WHERE `email` = '$email'");
    $count = mysqli_num_rows($query1);
    if($count > 0) {
        echo 1;
    } else {
        echo 0;
    }
}

// PHONE CHECK
if(isset($_POST['checkmobile']))
{
	$phone = $_POST['checkmobile'];
    $query1 = mysqli_query($sql, "SELECT `phone` FROM `cr_users` WHERE `phone` = '$phone'");
    $count = mysqli_num_rows($query1);
    if($count > 0) {
        echo 1;
    } else {
        echo 0;
    }
}

// RESTAURANT NAME CHECK
if(isset($_POST['checkrestaurantname']))
{
	$restoname = $_POST['checkrestaurantname'];
    $query1 = mysqli_query($sql, "SELECT `nameurl` FROM `cr_site_settings` WHERE `nameurl` = '$restoname'");
    $count = mysqli_num_rows($query1);
    if($count > 0) {
        echo 1;
    } else {
        echo 0;
    }
}

// EMAIL ID & PASSWORD CHECK
if(isset($_POST['checkusername1']))
{
    $planid = $_POST['planid'];
    $email = $_POST['checkusername1'];
    $temprestaurant = $_POST['temprestaurant'];
    if($temprestaurant == '')
    {
        $password = md5($_POST['password']);
    } else {
        $password = $_POST['password'];
    }

    if($email != '')
    {
        if($password != '')
        {
            $query1 = mysqli_query($sql, "SELECT * FROM `cr_users` WHERE `email` = '$email' and `password` = '$password' 
            and `active` = 1 and id != 1 and `registertype` = 1");
            $count = mysqli_num_rows($query1);
            if($count == 1) 
            {
                echo 1;
            } else {
                echo 0;
            }            
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}

?>