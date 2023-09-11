$(document).ready( function () {



    $('.datepicker').datepicker({
        autoclose: true
      });



});


$("#basic_checkbox_2").change(function(){
    $("#fileuploader").toggle();
    $(".linkuploader").toggle();
});

$('#add_place_input').click(function(e) {
    e.preventDefault();
    var newform = $('#place_input').last().clone(true);
    newform.find(':input').val('');
    newform.prependTo($('#places_form'));
  });
  
  $("body").on("click","#remove_place_input", function() {
    count = $('[id^=place_input]').length;
    if(count > 1)
        $(this).parents('#place_input').remove();
    else
        $('[id^=place_input]').find(':input').val('');
  });



  $(function () {
	$('#register_bid_form').submit(function(e) {
        var form = $('#register_bid_form')[0];
      var formData = new FormData(form);
	  e.preventDefault();
      
	//   console.log($('#register_form').serialize());
	  swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
	  
	  $.ajax({
		type: 'post',
		url: 'index',
		// data: $('#register_bid_form').serialize(),
		data: formData,
        processData: false,
        contentType: false,
		success: function (results) {
			swal.close();
			$(".new-data").html(results);
    		jQuery("#modal-show-final").modal({backdrop: 'static', keyboard: false}, 'show');
			if(results == 'proceed'){
				window.location.replace("index");
			}
			else if(results != 'wrong_password'){
				swal({
					title: 'Information',
					text: 'Wrong Credentials',
					type: "error",
				}).then(function() {
					swal.close();
				});
			}
		}
	  });
	
	});
});



function find_bid() {
	swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
	var search_query = $('#search_engine').val();
		$.ajax({
		  type : 'post',
		  url : 'find_bid',
		  data :  'q='+search_query,
		  success : function(data){
			$( "#results_table .rowings" ).remove();
			if(data == "not enough"){
			  swal({
				title: 'Information',
				text: 'Not Enough. Taasi gamay ang Search. < 2 characters.',
				type: "error"
			  }).then(function() {
				swal.close();
			  });
			}
			else{
			  data = JSON.parse(data);
			// console.log(data);
			$.each(data, function(i, item) {
			  console.log(data[i]);
			  $('.results-data').after('\
			  <tr class="rowings">\
			  <td><a target="_blank" href="edit_specific_bid?ref='+data[i].ReferenceNumber+'" class="btn btn-primary btn-flat btn-block">'+data[i].ReferenceNumber+'</a></td>\
			  <td>'+data[i].Title+'</td>\
			  <td>'+data[i].Record+'</td>\
			  <td>'+data[i].DatePublished+'</td>\
			  <td>'+data[i].ClosingDate+'</td>\
			  <td>'+data[i].amount+'</td>\
			  <td>'+data[i].rfqnumber+'</td>\
			  <td>'+data[i].supplier+'</td>\
			  <tr>');
			});
			swal.close();
		  }
		}
		});    
		  }