<link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="AdminLTE_new/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/jquery-ui/jquery-ui.min.css">

<!-- 
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/ui.min.css"> -->
<style>
  .fixed-dialog{
  position: fixed;
  /* top: 50px !important;
  left: 250px !important; */
  height: 600px !important;
  z-index:1049 !important;
}
#scroll-wrap {
    max-height: 50vh;
    overflow-y: auto;
}

::-webkit-scrollbar { 
    display: none; 
}
</style>


  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        Attendance
        <small>Version 2.0</small>
        <button  type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#modal-primary">Upload Logs</button>
      </h1>
    </section>
    <section class="content">
    <div id="dialog" style="display: none"></div>


    <div class="modal fade" id="modal_google_drive">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="drive-fetched"></div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


    

    <div class="modal fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Upload Log</h3>
              </div>
              <div class="modal-body">
               
			  <form role="form" class="generic_form_trigger" data-url="attendance">
          
              <div class="box-body">

          <!-- <input type="hidden" name="action" value="upload_group"> -->
          <!-- <input type="hidden" name="action" value="upload_employees"> -->
          <input type="hidden" name="action" value="upload_bio">
          <!-- <input type="hidden" name="action" value="upload_salary"> -->
          <!-- <input type="hidden" name="action" value="upload_position"> -->
          <!-- <input type="hidden" name="action" value="upload_dtras"> -->
          <!-- <input type="hidden" name="action" value="upload_temp_employees"> -->
          <!-- <input type="hidden" name="action" value="upload_temp_employees2"> -->
          <!-- <input type="hidden" name="action" value="upload_temp_merged"> -->
			  
				<div class="form-group">
                  <label for="exampleInputFile">Upload Zip Only</label>
                  <input accept=".dat" type="file" name="logzips[]" multiple="multiple" id="exampleInputFile">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
          </div>
      </div>
      


    <div class="row">
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">



      <div class="card">
              <div class="card-header">
                <h5 class="m-0">PROCESS</h5>
              </div>
              <div class="card-body">
              <form class="generic_form_trigger" method="post" data-url="attendance">
              <input type="hidden" name="action" value="process_attendance">
              <?php
                $the_months = [];
                $the_months[0]["month"] = "January";
                $the_months[0]["date"] = "01";
                $the_months[1]["month"] = "February";
                $the_months[1]["date"] = "02";
                $the_months[2]["month"] = "March";
                $the_months[2]["date"] = "03";
                $the_months[3]["month"] = "April";
                $the_months[3]["date"] = "04";
                $the_months[4]["month"] = "May";
                $the_months[4]["date"] = "05";
                $the_months[5]["month"] = "June";
                $the_months[5]["date"] = "06";
                $the_months[6]["month"] = "July";
                $the_months[6]["date"] = "07";
                $the_months[7]["month"] = "August";
                $the_months[7]["date"] = "08";
                $the_months[8]["month"] = "September";
                $the_months[8]["date"] = "09";
                $the_months[9]["month"] = "October";
                $the_months[9]["date"] = "10";
                $the_months[10]["month"] = "November";
                $the_months[10]["date"] = "11";
                $the_months[11]["month"] = "December";
                $the_months[11]["date"] = "12";
              ?>

              <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                            <label>Month</label>
                            <select required name="month_process" class="form-control select2" style="width: 100%;">
                            <?php foreach($the_months as $m): ?>
                              <?php if(date("m") == $m["date"]): ?>
                                <option selected value="<?php echo($m["date"]); ?>" ><?php echo($m["month"]); ?></option>
                              <?php else: ?>
                                <option value="<?php echo($m["date"]); ?>" ><?php echo($m["month"]); ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Year</label>
                        <input required name="year_process" type="text" value="<?php echo(date("Y")); ?>" class="form-control">
                    
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                        <div class="form-group">
                            <label>Type of Process</label>
                            <select required name="type_dtr" class="form-control select2" style="width: 100%;">
                                <option value="" selected disabled>Please select Type of DTR</option>
                                <option value="normal"  >Normal</option>
                                <option value="with_overtime"  >With Overtime</option>
                            </select>
                        </div>
                  </div>
              </div>
              <div class="form-group">
								<button type="submit" class="btn btn-block btn-primary btn-flat">Convert Bio Logs to DTR</button>
							</div>
          </form>
              </div>
            </div>



            

      </div>
      <!-- <div class="col-md-6">


      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">2. DTRAS CONSOLIDATE</h3>
            </div>
            <div class="box-body">
              <form id="process_dtras_form" method="post">
              <input type="hidden" name="action" value="process_dtras">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>From Date:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="from_date" name="from_date" type="date" class="form-control pull-right">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>To Date:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="to_date" name="to_date" type="date" class="form-control pull-right">
                      </div>
                    </div>
                  </div>
              </div>
              <div class="form-group">
								<button type="submit" class="btn btn-block btn-primary btn-flat">DTRAS</button>
							</div>
          </form>
        </div>
          </div>
      </div> -->
    </div>


          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Print Attendance Data Sheet</h3>
            </div>

            <div class="card-body">
              <input type="hidden" name="action" value="process_attendance">
            <div class="row">

            <div class="col-md-12">
                        <div class="form-group">
                            <label>Employment Status</label>
                            <select name="employment_status" id="emp_status" class="form-control select2" style="width: 100%;">
                            <option value="0" selected>ALL</option>
                            <option value="1">PERMANENT/COTERMINOUS (FOR MONTHLY)</option>
                            <option value="2">JO/CASUAL/HONORARIUM (QUINCENA)</option>
                            </select>
                        </div>

            </div>

            <div class="col-md-6">
            <div class="form-group">
                            <label>Category</label>
                            <select name="category" id="category_select" class="form-control select2" style="width: 100%;">
                            <option value="" disabled selected>Please select a category</option>
                            <option value="department">Department</option>
                            <option value="employee">Employee</option>
                            <option value="group">Group</option>
                            <option value="schedule">Schedule</option>
                            </select>
                        </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                            <label>Options</label>
                            <select  name="option" id="options_select" class="form-control select2" style="width: 100%;">
                            <option value="" disabled selected>Please select option</option>
                            </select>
                        </div>
            </div>
            <div class="col-md-6">


            <div class="form-group">
              <label>From Date:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input id="from_info_date" type="date" class="form-control pull-right">
                  </div>
                  <!-- /.input group -->
                </div>
            </div>


            <div class="col-md-6">
            <div class="form-group">
              <label>To Date:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input id="to_info_date" type="date" class="form-control pull-right">
                  </div>
                </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                            <select id="report_option" name="report_option"  class="form-control select2" style="width: 100%;">
                            <option value="" disabled selected>Please select type of report</option>
                            <option value="dtr">Daily Time Recording - DTR</option>
                            <option value="timesheet">Timesheet</option>
                            </select>
                        </div>
            </div>



            <div class="col-md-6">
            <div class="form-group">
								<button onclick="print(this);" class="btn btn-primary btn-flat btn-block">Generate Report</button>
							</div>

            </div>
							</div>
        </div>
          </div>



          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">DOWNLOAD THROUGH LAN</h3>
            </div>
              <div class="card-body">
                <form id="download_lan_form" method="post">
                <input type="hidden" name="action" value="download_lan">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select id="awit" name="biometric_id"  class="form-control select2" style="width: 100%;">
                        <option value="" disabled selected>Please select biometric machine</option>
                        <?php foreach($biometric_machines as $bm): ?>
                          <option value="<?php echo($bm["biometric_id"]); ?>"><?php echo($bm["biometric_name"]); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>

              <div class="col-md-6 ">
              <div class="form-group pull-right">
                  <button type="submit" class="btn btn-primary btn-flat btn-block">Process Attendance Logs</button>
                </div>
              </div>
                </div>
            </form>
          </div>
          </div>


    </div>



       
      </div>

    </section>
</div>
   
  </div>
  <?php 
    require("layouts/footer.php");
  ?>

  <script src="AdminLTE_new/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script>
  <script src="AdminLTE_new/dist/js/adminlte.min.js"></script>
  <script src="AdminLTE_new/dist/js/demo.js"></script>


  <!-- <script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/assets/js/jquery-1.12.0.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script> -->

  <script src="AdminLTE_new/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- <script src="AdminLTE/dist/js/adminlte.min.js"></script> -->
  <!-- <script src="AdminLTE/dist/js/demo.js"></script> -->
  <!-- <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script> -->
  <!-- <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script> -->
  <script>
function deleterow(d){
	var thing = d.getAttribute("data-id");
	Swal.fire({
    title: 'Please wait...', 
    imageUrl: 'AdminLTE/dist/img/loader.gif', 
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false
  });
	$.ajax({
		type: 'post',
		url: 'attendance',
		data: 'id=' + thing + '&action=delete_console' ,
		success: function (results) {
			swal({title: results, imageUrl: "dist/img/like.png", showConfirmButton: true});
			location.reload();
		},
		error: function(xhr, ajaxOptions, thrownError){
			swal({title: results, imageUrl: "dist/img/like.png", showConfirmButton: true});
		}
	});
}

function goDoSomething(d){
	var thing = d.getAttribute("data-id");
	swal({
    title: 'Please wait...', 
    imageUrl: 'AdminLTE/dist/img/loader.gif', 
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false
  });
    $.ajax({
        type: 'post',
        url: 'bio_logs',
        data: 'id=' + thing + '&action=consolidate' ,
        success: function (results) {
          var o = jQuery.parseJSON(results);
          if(o.status === "success") {
            swal({title: "Submit success",
              text: o.message,
              type:"success"})
            .then(function () {
              //window.location.replace('./applicant.php?page=list');
              window.location.replace(o.link);
            });
          }
          else {
            swal({
              title: "Error!",
              text: o.message,
              type:"error"
            });
          }
        },
        error: function(results) {
          swal("Error!", "Unexpected error occur!", "error");
        }
      });
}


$('#upload_form').submit(function(e) {
	var form = $('#upload_form')[0];
	var formData = new FormData(form);
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
      swal({
        title: 'Please wait...', 
        imageUrl: 'AdminLTE/dist/img/loader.gif', 
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false
      });
      $.ajax({
        type: 'post',
        url: 'bio_logs',
        data: formData,
		processData: false,
    	contentType: false,
        success: function (results) {
          swal.close();
          var o = jQuery.parseJSON(results);
          if(o.status === "success") {
            swal({title: "Submit success",
              text: o.message,
              type:"success"})
            .then(function () {
              //window.location.replace('./applicant.php?page=list');
              window.location.replace(o.link);
            });
          }
          else {
            swal({
              title: "Error!",
              text: o.message,
              type:"error"
            });
          }
        },
        error: function(results) {
          swal("Error!", "Unexpected error occur!", "error");
        }
      });
      // --- end of ajax
    }
  });
});

$('.select2').select2()


$('#process_form').submit(function(e) {
    var promptmessage = 'This Logs will be processed...';
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
      swal({
        title: 'Please wait...', 
        imageUrl: 'AdminLTE/dist/img/loader.gif', 
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false
      });
      $.ajax({
        type: 'post',
        url: 'bio_logs',
        data: $('#process_form').serialize(),
        success: function (results) {
          swal.close();
          var o = jQuery.parseJSON(results);
          if(o.status === "success") {
            swal({title: "Submit success",
              text: o.message,
              type:"success"})
            .then(function () {
              //window.location.replace('./applicant.php?page=list');
              window.location.replace(o.link);
            });
          }
          else {
            swal({
              title: "Error!",
              text: o.message,
              type:"error"
            });
          }
        },
        error: function(results) {
          swal("Error!", "Unexpected error occur!", "error");
        }
      });
    }
  });
});


$('#process_dtras_form').submit(function(e) {
  var promptmessage = 'This Logs will be processed...';
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
    swal({
      title: 'Please wait...', 
      imageUrl: 'AdminLTE/dist/img/loader.gif', 
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: false
    });
    $.ajax({
      type: 'post',
      url: 'bio_logs',
      data: $('#process_dtras_form').serialize(),
      success: function (results) {
        swal.close();
        var o = jQuery.parseJSON(results);
        if(o.status === "success") {
          swal({title: "Submit success",
            text: o.message,
            type:"success"})
          .then(function () {
            //window.location.replace('./applicant.php?page=list');
            window.location.replace(o.link);
          });
        }
        else {
          swal({
            title: "Error!",
            text: o.message,
            type:"error"
          });
        }
      },
      error: function(results) {
        swal("Error!", "Unexpected error occur!", "error");
      }
    });
  }
});
});



$('#download_lan_form').submit(function(e) {
  var promptmessage = 'This Logs will be processed...';
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
    swal({
      title: 'Please wait...', 
      imageUrl: 'AdminLTE/dist/img/loader.gif', 
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: false
    });
    $.ajax({
      type: 'post',
      url: 'bio_logs',
      data: $('#download_lan_form').serialize(),
      success: function (results) {
        swal.close();
        var o = jQuery.parseJSON(results);
        if(o.status === "success") {
          swal({title: "Success",
            text: o.message,
            type:"success"})
          .then(function () {
            window.location.replace(o.link);
          });
        }
        else {
          swal({
            title: "Error!",
            text: o.message,
            type:"error"
          });
        }
      },
      error: function(results) {
        swal("Error!", "Unexpected error occur!", "error");
      }
    });
  }
});
});



$('body').on('change', '#category_select', function(){
  $("#options_select").empty();
    $('#options_select').select2('destroy');
    $('#options_select').select2();
    $('#options_select').append(
      '<option value="" selected disabled>Please select option</option>'
    );
    var selected = $('#category_select').select2("val");
    if(selected == "employee"){
      $('#options_select').select2({
        minimumInputLength: 3,
        placeholder: "Search by ID, Username, First Name, Last Name",
        ajax: {
            url: 'ajax_employees',
            dataType: 'json',
            data : function(params) {
              return {
                  q : params.term,
                  page : params.page,
              };
            },
            processResults: function (data) {
            return {
              results: $.map(data.results, function (item) {
                return {
                  text: item.name,
                                id: item.Employeeid,
                                }
                })
              }
            }
          },
        });
    }

    else{
      $.ajax({
        type: 'post',
        url: 'attendance',
        data: { 
            action: "fetch_option", 
            selected_option: $('#category_select').select2("val"),
        },
        success: function (results) {
            var option = JSON.parse(results);
            option = option.option;
            $.each(option, function(index, value) {
                $('#options_select').append(
                  '<option value="' + option[index].option_id + '">' + option[index].option_name + '</option>'
                );
              });
              $('#options_select').select2();
        }
      });
    }


  
});


function print(ele) {

  var emp_status = $('#emp_status').select2("val");
  var category = $('#category_select').select2("val");
  var option = $('#options_select').select2("val");
  var report = $('#report_option').select2("val");
  var from_date = $("#from_info_date").val();
  var to_date = $("#to_info_date").val();

  Swal.fire({
    title: 'Please wait...', 
    imageUrl: 'AdminLTE/dist/img/loader.gif', 
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false
  });

  $.ajax({
    type: 'post',
    url: 'attendance',
    data: {
      category: category, 
      option: option, 
      report: report, 
      from_date: from_date, 
      to_date: to_date, 
      emp_status: emp_status, 
      action: "print_attendance", 
    },
    success: function (results) {
      var o = jQuery.parseJSON(results);
      o = o.info["0"];
      console.log(o);
      if(o.result === "success") {
  Swal.fire({

    title: "Success!",
          text: "Successfully rendered List: " + o.filename,
          icon: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          closeOnCancel: false,
          dangerMode: true,
          confirmButtonText: 'View',
          cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {

      var fileName = o.path;
                  $("#dialog").dialog({
                      modal: true,
                      title: fileName,
                      width: 1200,
                      height: "auto",
                      resizable: true,
                      draggable: false,
                      closeOnEscape: true,
                      dialogClass: 'fixed-dialog',
                      buttons: {
                        "Upload Google Drive": function (){
                          Swal.fire({
                            title: 'Sending Email. Please Wait...', 
                            imageUrl: 'AdminLTE/dist/img/loader.gif', 
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false
                          });
                          $.ajax({
                            type: 'post',
                            url: 'attendance',
                            data: { 
                                action: "google_drive", 
                                file_name: fileName,
                            },
                            success: function (results) {
                              Swal.close();
                              $('#modal_google_drive').modal('show');
                              // $("#modal_google_drive").modal();
                           
                              
                              $('.drive-fetched').html(results);
                            }
                          });
                        },
                        "Open Link": function (){
                          window.open(o.path);
                        },
                        Close: function () {
                            $(this).dialog('close');
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
    } else if (result.isDenied) {
      Swal.close();
    }
  });
      }
      else{
        Swal.Fire({
          title: "Failed",
          text: o.message,
          icon: "error"
      }).then(function() {
          Swal.close();
      });
      }
    }
    });
  }

  </script>
