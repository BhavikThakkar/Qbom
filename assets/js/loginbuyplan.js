
$('#loginsubmitplan').click(function()
{
    var username=$('.email').val();
    var password=$('.password').val();
	var planid=$('.planid').val();
	var temprestaurant=$('.temprestaurant').val();
	if(username == '')
    {
		$('.email').val('');
		$('.dreg1').html('<p style="margin-top:0px;position: absolute;">E-mail é obrigatório</p>');
		setTimeout(function(){ $('.dreg1').html('');}, 5000);
		return false;
	} else {
        var dataString = 'checkusername1='+username+"&password="+password+"&planid="+planid+"&temprestaurant="+temprestaurant;
        $.ajax({
			type: "POST", 
			url: mainlink+"ajax_function.php", 
			data: dataString, 
            success: function(data)
            {
				if(data == 0) 
                {
					$('.email').val('');
					$('.password').val('');
					$('.usrnmnotfnd').html('Nome de usuário e senha incorretos / conta não ativa');
					setTimeout(function(){ $('.usrnmnotfnd').html('');}, 5000);
					return false;
				} else {
					//window.location.href=mainlink+"auth-login.php?logflag=2&planid="+planid+"&username="+username+"&password="+password+"&temprestaurant="+temprestaurant+"";
					window.location.href=mainlink+"auth-login.php?logflag=2&planid="+planid+"&email="+username+"";
				}
			}
		});
    }
});