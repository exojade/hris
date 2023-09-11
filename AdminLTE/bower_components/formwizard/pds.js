 $(function () {
	  
	   $('#addmorebod').click(function(e) {
        e.preventDefault();
        var newform = $('#bodforminput').clone();
        $('#boddiv').append(newform);
      });
	    
	  
    $('#addmorechild').click(function(e) {
        e.preventDefault();
		var newform = $('#childinput').last().clone(true);
		newform.find(':input').val('');
		newform.prependTo($('#childform'));
		
      });
	  
	
      $("body").on("click","#removechildinput", function() {
        count = $('[id^=childinput]').length;
		if(count > 1)
			$(this).parents('#childinput').remove();
		else
			$('[id^=childinput]').find(':input').val('');
	
      });
	  
	  
	 //education 
	  $('#addmoreeduc').click(function(e) {
        e.preventDefault();
        var newform = $('#educationinput').last().clone(true);
		newform.find(':input').val('');
		newform.prependTo($('#educationform'));
      });
	  
	  
	   $("body").on("click","#removeeducinput", function() {
        count = $('[id^=educationinput]').length;
		if(count > 1)
			$(this).parents('#educationinput').remove();
		else
			$('[id^=educationinput]').find(':input').val('');
	
      });
	  
	  $('#addmorecs').click(function(e) {
        e.preventDefault();
		var newform = $('#csinput').last().clone(true);
		newform.find(':input').val('');
		newform.prependTo($('#csform'));
      });
	  
	  $("body").on("click","#removecsinput", function() {
        count = $('[id^=csinput]').length;
		if(count > 1)
			$(this).parents('#csinput').remove();
		else
			$('[id^=csinput]').find(':input').val('');
	
      });
	  
	  
	  $('#addmorework').click(function(e) {
        e.preventDefault();
        var newform = $('#workinput').last().clone();
		newform.find(':input').val('');
		newform.prependTo($('#workform'));
		
      });
	  
	  $("body").on("click","#removeworkinput", function() {
        count = $('[id^=workinput]').length;
		if(count > 1)
			$(this).parents('#workinput').remove();
		else
			$('[id^=workinput]').find(':input').val('');
	
      });
	  
	  
	  $('#addmorevol').click(function(e) {
        e.preventDefault();
		var newform = $('#volinput').last().clone();
		newform.find(':input').val('');
		newform.prependTo($('#volform'));
		
      });
	  
	  $("body").on("click","#removevolinput", function() {
        count = $('[id^=volinput]').length;
		if(count > 1)
			$(this).parents('#volinput').remove();
		else
			$('[id^=volinput]').find(':input').val('');
	
      });
	  
	 
	  
	  $('#addmoretrain').click(function(e) {
        e.preventDefault();
		
		var newform = $('#traininput').last().clone();
		newform.find(':input').val('');
		newform.prependTo($('#trainform'));
      });
	  
	  $("body").on("click","#removetraininput", function() {
        count = $('[id^=traininput]').length;
		if(count > 1)
			$(this).parents('#traininput').remove();
		else
			$('[id^=traininput]').find(':input').val('');
	
      });
	  
	  $('#addmoreskill').click(function(e) {
        e.preventDefault();
        var newform = $('#skillinput').last().clone(true);
		newform.find(':input').val('');
		newform.prependTo($('#skillform'));
      });
	  
	  $("body").on("click","#removeskillinput", function() {
        count = $('[id^=skillinput]').length;
		if(count > 1)
			$(this).parents('#skillinput').remove();
		else
			$('[id^=skillinput]').find(':input').val('');
	
      });
	
	  
	  
	  
	  $('#addmorenonacad').click(function(e) {
        e.preventDefault();
		var newform = $('#nonacadinput').last().clone(true);
		newform.find(':input').val('');
		newform.prependTo($('#nonacadform'));
      });
	  
	  $("body").on("click","#removenonacadinput", function() {
        count = $('[id^=nonacadinput]').length;
		if(count > 1)
			$(this).parents('#nonacadinput').remove();
		else
			$('[id^=nonacadinput]').find(':input').val('');
	
      });
	  
	  
	  $('#addmoreorg').click(function(e) {
        e.preventDefault();
		var newform = $('#orginput').last().clone(true);
		newform.find(':input').val('');
		newform.prependTo($('#orgform'));
      });
	  
	  $("body").on("click","#removeorginput", function() {
        count = $('[id^=orginput]').length;
		if(count > 1)
			$(this).parents('#orginput').remove();
		else
			$('[id^=orginput]').find(':input').val('');
	
      });
	
  });