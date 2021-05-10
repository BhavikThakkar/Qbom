var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var chara = /^[a-zA-Z\.\s]+$/;
var charast = /^[a-zA-Z\s]+$/;	

// NO SPACE 
$('.nospace').on('keypress', function(e) {
	if (e.which == 32)
		return false;
});

// ONLY NUMBER
$('.onlynumber').on('keypress', function (e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});

// ONLY TEXT
$('.textonly').keydown(function (e) 
{
	if (e.ctrlKey || e.altKey) {
		e.preventDefault();
	} else {
		var key = e.keyCode;
		if (key == 190  && this.value.split('.').length === 2) 
		{
			return false;
		} else {
			if (!((key == 8) || (key == 9) || (key == 46) || (key == 32) || (key == 190)  || (key >= 65 && key <= 90))) {
				e.preventDefault();
			}
		}
	}
});

// MOBILE KEYDOWN
$("#mobile").keydown(function (e) {
	// Allow: backspace, delete, tab, escape, enter and .
	var code = (e.keyCode ? e.keyCode : e.which);
	
	if ($.inArray(code, [46, 8, 9, 27, 13, 110]) !== -1 ||
		 // Allow: Ctrl+A, Command+A
		(code === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
		 // Allow: home, end, left, right, down, up
		(code >= 35 && code <= 40)) {
			 // let it happen, don't do anything
			 return;
	}
	// Ensure that it is a number and stop the keypress
	if ((e.shiftKey || (code < 48 || code > 57)) && (code < 96 || code > 105)) {
		e.preventDefault();
	}
});