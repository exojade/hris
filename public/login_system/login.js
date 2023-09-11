$(function () {
	$('#login_form').submit(function(e) {
	  e.preventDefault();
	  swal({title: 'Please wait...', imageUrl: './public/images/loader/green-loader.gif', showConfirmButton: false});
	  $.ajax({
		type: 'post',
		url: 'login',
		data: $('#login_form').serialize(),
		success: function (results) {

			if(results == 'register_first')
				window.location.replace("register");
			else if(results == 'wrong_password'){
				swal({
					title: 'Information',
					text: 'Wrong Credentials',
					type: "error"
				}).then(function() {
					swal.close();
				});
			}
			else if(results == 'non_existing'){
				swal({
					title: 'Information',
					text: 'No ETRACS Account. Coordinate to IT Staff',
					type: "error"
				}).then(function() {
					swal.close();
				});
			}
			else if(results == 'proceed'){
				window.location.replace("pds");
			}


			
		}
	  });
	});
});