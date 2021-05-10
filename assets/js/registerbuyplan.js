
// FIRSTNAME
$('.fname').on('change', function (e) 
{
	var validate=1;
	var msg='';
	var newlength = $('.fname').val().length;
    if(newlength == '')
    {
        validate = 0; 
        msg='<p style="position: absolute; margin-top: 0px;">Este campo é obrigatório.</p>';
	}
    //if(newlength< 3){ validate=0; msg='<p style="color: red; position: absolute; font-size: 13px; text-align: left;">Please insert Min 3 character</p>'; }
    //if(newlength > 30){ validate=0; msg='<p style="color: red; position: absolute; font-size: 13px; text-align: left;">Please insert Max 30 character</p>';  }
    if(validate == 0)
    { 
	    $('.creg1').html(msg);
        setTimeout(function(){ $('.creg1').html('');}, 5000);
	    $('.fname').val('');
	}
});

// LASTNAME
$('.lname').on('change', function (e) 
{
	var validate=1;
	var msg='';
    var newlength = $('.lname').val().length;
    if(newlength == '')
    {
        validate = 0; 
        msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
	}
    //if(newlength< 3){ validate=0; msg='<p style="color: red; position: absolute; font-size: 13px; text-align: left;">Please insert Min 3 character</p>'; }
	//if(newlength > 30){ validate=0; msg='<p style="color: red; position: absolute; font-size: 13px; text-align: left;">Please insert Max 30 character</p>';  }
    if(validate == 0)
    { 
	    $('.creg2').html(msg);
	    setTimeout(function(){ $('.creg2').html('');}, 5000);
	    $('.lname').val('');
	}
});

// PHONE
$('.phone').on('change', function (e) 
{
    var num = $('.phone').val().length;
    var cphone = $('.phone').val();
    if(num < 9)
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">São necessários 9 dígitos</p>';
        $('.creg3').html(msg);
        setTimeout(function(){ $('.creg3').html('');}, 5000);
        $('.phone').val('');
    } else {
        var dataString = 'checkmobile='+cphone;	
        $.ajax({
            type: "POST", 
            url: mainlink+"ajax_function.php", 
            data: dataString, 
            success: function(data)
            {
                if(data == 1) {
                    $('.phone').val('');
                    $('.creg3').html('<p style="position: absolute; margin-top: 0px;">Número de celular já cadastrado</p>');
                    setTimeout(function(){ $('.creg3').html('');}, 5000);
                }
            }
        });
    }
});

// EMAIL
$('#email').change(function()
{
	var logemail = $(this).val();
    if(logemail == '') 
    {
        $('.creg4').html('<p style="position: absolute; margin-top: 0px; ">Forneça um ID de e-mail válido</p>');
        $(this).val('');
        setTimeout(function(){ $('.creg4').html('');}, 5000);
    } else {
        if (!filter.test(logemail)) { 
            $('.creg4').html('<p style="position: absolute; margin-top: 0px;">Forneça um ID de e-mail válido</p>');
            $(this).val('');
            setTimeout(function(){ $('.creg4').html('');}, 5000);
        } else {
            $('.creg4').html('');
            var dataString = 'checkmail='+logemail;	
            $.ajax({
                type: "POST", 
                url: mainlink+"ajax_function.php", 
                data: dataString, 
                success: function(data)
                {
                    if(data == 1) {
                        $('#email').val('');
                        $('.creg4').html('<p style="position: absolute; margin-top: 0px;">ID de email já está registrado</p>');
                        setTimeout(function(){ $('.creg4').html('');}, 5000);
                    }
                }
            });
        }
    }
});

// PASSWORD
$('.password').on('change', function (e) 
{
    var validate=1;
    var msg='';
    var newlength = $('.password').val().length;
    if(newlength < 6){ validate=0; msg='<p style="position: absolute; margin-top: 0px;">Insira no mínimo 6 caracteres</p>'; }
    if(newlength > 30){ validate=0; msg='<p style="position: absolute; margin-top: 0px;">Insira no máximo 30 caracteres</p>';  }
    if(validate == 0)
    { 
        $('.creg5').html(msg);
        setTimeout(function(){ $('.creg5').html('');}, 5000);
        $('.password').val('');
    }
});

// RESTAURANT NAME
$('.restoname').on('change', function (e) 
{
    var msg='';
    var restoname = $('.restoname').val();
    if(restoname == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg6').html(msg);
        setTimeout(function(){ $('.creg6').html('');}, 5000);
        num=1;
        return false;
    } else {
        var dataString = 'checkrestaurantname='+restoname;	
        $.ajax({
            type: "POST", 
            url: mainlink+"ajax_function.php", 
            data: dataString, 
            success: function(data)
            {
                if(data == 1) {
                    $('.restoname').val('');
                    $('.creg6').html('<p style="position: absolute; margin-top: 0px;">O nome do restaurante já existe!</p>');
                    setTimeout(function(){ $('.creg6').html('');}, 5000);
                }
            }
        });
    }
});

$('#registersubmitplan').click(function()
{
    var fname = $('.fname').val();
    var lname = $('.lname').val();
    var restoname = $('.restoname').val();
	var phone = $('.phone').val();
	var email = $('#email').val();
	var password = $('.password').val();
	var num=0;
    
    if(fname == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg1').html(msg);
        setTimeout(function(){ $('.creg1').html('');}, 5000);
        num=1;
        return false;
    }

    if(lname == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg2').html(msg);
        setTimeout(function(){ $('.creg2').html('');}, 5000);
        num=1;
        return false;
    }

    if(restoname == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg6').html(msg);
        setTimeout(function(){ $('.creg6').html('');}, 5000);
        num=1;
        return false;
    }

    if(phone == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg3').html(msg);
        setTimeout(function(){ $('.creg3').html('');}, 5000);
        num=1;
        return false;
    }

    if(email == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg4').html(msg);
        setTimeout(function(){ $('.creg4').html('');}, 5000);
        num=1;
        return false;
    }

    if(password == '') 
    {
        var msg='<p style="position: absolute; margin-top: 0px; ">Este campo é obrigatório.</p>';
        $('.creg5').html(msg);
        setTimeout(function(){ $('.creg5').html('');}, 5000);
        num=1;
        return false;
    }

    // if(num == 0)
    // {
    //     $(".stripe-button-el").click();
    //     return false;
    // }
});