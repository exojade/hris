  <footer class="main-footer no-print">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">City Administrator's Office - I.T. Section</a>.</strong> All rights
    reserved.
  </footer>
</div>
<script>
$('.generic_form').submit(function(e) {
      e.preventDefault();
      swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
      var url = $(this).data('url');
      // alert(url);
      $.ajax({
        type: 'post',
        url: url,
        data: $(this).serialize(),
        success: function (results) {
            var o = jQuery.parseJSON(results);
            if(o.result == 'success'){
                location.reload();
            }
            else if(o.result == 'failed'){
                swal({
                    title: o.title,
                    text: o.message,
                    type: "error"
                }).then(function() {
                    swal.close();
                });
            }
        }
      });
    });


  $('.generic_form_trigger').submit(function(e) {
  var form = $(this)[0];
  var formData = new FormData(form);
  var url = $(this).data('url');
  e.preventDefault();
  Swal.fire({
  title: 'Do you want to submit the changes?',
  showCancelButton: true,
  confirmButtonText: 'Save',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
      $.ajax({
                type: 'post',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function (results) {
                var o = jQuery.parseJSON(results);
                console.log(o);
                if(o.status === "success") {
                    Swal.close();
                    Swal.fire({title: "Submit success",
                    text: o.message,
                    icon: 'success',})
                    .then(function () {
                    window.location.replace(o.link);
                    });
                }
                else {
                    Swal.fire({
                    title: "Error!",
                    text: o.message,
                    icon:"error"
                    });
                    console.log(results);
                }
                },
                error: function(results) {
                console.log(results);
                swal("Error!", "Unexpected error occur!", "error");
                }
            });
    } else if (result.isDenied) {
    
    }
  })
    });

  //   $(document).on("submit", ".generic_form_trigger", function(e){
  //     e.preventDefault();
  //     var url = $(this).data('url');
  //       var promptmessage = 'This form will be submitted. Are you sure you want to continue?';
  //       var prompttitle = 'Data submission';
  //       e.preventDefault();
  //       swal({
  //           title: prompttitle,
  //           text: promptmessage,
  //           type: 'info',
  //           showCancelButton: true,
  //           confirmButtonText: 'Yes',
  //           cancelButtonText: 'Cancel'
  //       }).then((result) => {
  //           if (result.value) {
  //               swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
  //           $.ajax({
  //               type: 'post',
  //               url: url,
  //               data: $(this).serialize(),
  //               success: function (results) {
  //               var o = jQuery.parseJSON(results);
  //               console.log(o);
  //               if(o.result === "success") {
  //                   swal.close();
                 
  //                   swal({title: "Submit success",
  //                   text: o.message,
  //                   type:"success"})
  //                   .then(function () {
  //                   window.location.replace(o.link);
  //                   });
  //               }
  //               else {
  //                   swal({
  //                   title: "Error!",
  //                   text: o.message,
  //                   type:"error"
  //                   });
  //                   console.log(results);
  //               }
  //               },
  //               error: function(results) {
  //               console.log(results);
  //               swal("Error!", "Unexpected error occur!", "error");
  //               }
  //           });
  //           }
  //       });
  // }); 

    $('.generic_form_pdf').submit(function(e) {
      e.preventDefault();
      var url = $(this).data('url');
        var promptmessage = 'This form will be submitted. Are you sure you want to continue?';
        var prompttitle = 'Data submission';
        e.preventDefault();
        swal({
            title: prompttitle,
            text: promptmessage,
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                success: function (results) {
                var o = jQuery.parseJSON(results);
                o = o.info["0"];
                console.log(o);
                if(o.result === "success") {
          swal({
            title: "Success!",
            text: "Successfully rendered List: " + o.filename,
            icon: "warning",
             showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'View',
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false,
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
                var fileName = o.path;
                    $("#dialog").dialog({
                        modal: true,
                        title: fileName,
                        width: 1200,
                        height: "auto",
                        resizable: false,
                        draggable: false,
                        closeOnEscape: true,
                        dialogClass: 'fixed-dialog',
                        buttons: {
                            Close: function () {
                                $(this).dialog('close');
                            },"Open Link": function (){
                          window.open(o.path);
                        },
                        },
                        open: function () {
                            var object = "<object data=\""+o.path+"\" type=\"application/pdf\" width=\"1200px\" height=\"500px\">";
                            object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
                            object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                            object += "</object>";
                            object = object.replace(/{FileName}/g, "Files/" + fileName);
                            $("#dialog").html(object);
                        }
                    });
             
              // console.log("confirmed");
              // window.open(o.path, '_blank');
        // window.location = parsed.path;
        swal.close();
            } else {
              console.log("cancelled");
        
        swal.close();
            }
          });
        }
                else {
                    swal({
                    title: "Error!",
                    text: o.message,
                    type:"error"
                    });
                    console.log(results);
                }
                },
                error: function(results) {
                console.log(results);
                swal("Error!", "Unexpected error occur!", "error");
                }
            });
            }
        });
    });











  $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>

