<link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">

<!-- <link rel="stylesheet" href="layouts/ios.css"> -->
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        Employees
        <small>Version 2.0</small>
        <a href="#" data-toggle="modal" data-target="#modal-add_employee" class="btn btn-primary btn-flat pull-right">Register Employee</a>
      </h1>

      
    </section>
    <section class="content">
    <div class="modal fade" id="modal-add_employee">
          <div class="modal-dialog modal-lg">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title text-center">Register New Employee</h3>
              </div>
              <div class="modal-body">
                <form id="addemp" autocomplete="off">
                <input type="hidden" name="action" value="add_employee">
                  <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Biometric Number</label>
                      <input required name="biometric_number" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>First Name</label>
                      <input required name="first_name" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input required name="last_name" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input  name="middle_name" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Suffix</label>
                      <input name="suffix" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                </div>

               

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Department Asssign</label>
                        <select name="department" required class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled value="">Please Select Department</option>
                            <?php foreach($department as $d): ?>
                              <option value="<?php echo($d["Deptid"]); ?>"><?php echo($d["DeptCode"] . " - " . $d["DeptName"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Group</label>
                        <select name="group" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="">Please select Group</option>
                            <?php foreach($group as $g): ?>
                              <option value="<?php echo($g["group_id"]); ?>"><?php echo($g["group_name"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label>Employment Status</label>
                        <select required name="employment" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="">Select Employment Status</option>
                            <option value="JOB ORDER">JOB ORDER</option>
                            <option value="HONORARIUM">HONORARIUM</option>
                            <option value="CASUAL">CASUAL</option>
                            <option value="COTERMINOUS">COTERMINOUS</option>
                            <option value="ELECTIVE">ELECTIVE</option>
                            <option value="PERMANENT">PERMANENT</option>
                           
                        </select>
                    </div>
                  </div>
                </div>
                    </div>
                    <div class="box-footer">
                      <button class=" btn btn-primary btn-flat pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                      <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="modal_edit_employees">
          <div class="modal-dialog modal-xl">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
					    <h3 class="modal-title text-center">Update Employee</h3>
              </div>
              <div class="modal-body">
                    <form id="editemp" autocomplete="off">
                      <div class="fetch-data-emp"></div>
                    <div class="box-footer">
                      <button class=" btn btn-primary btn-flat pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                      <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal_update_payroll">
          <div class="modal-dialog modal-xl">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
					    <h3 class="modal-title text-center">Update Employee's Payroll Settings</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <form class="generic_form" url="employees" autocomplete="off">
                    <div class="fetched-payroll"></div>
                      <div class="box-footer">
                        <button class=" btn btn-primary btn-flat pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button>
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
    <style>
      .table tr td {
        font-size:14px !important;
      }

      .table tr td i{
        font-size:12px !important;
      }
    </style>
    <div class="card">
            <!-- /.box-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="employees-datatable" style="width:100%">
                      <thead>
                          <tr>
                              <th width="14%"></th>
                              <th>ID</th>
                              <th>First</th>
                              <th>Middle</th>
                              <th>Last</th>
                              <th>Suffix</th>
                              <th>Fund</th>
                              <th>Assigned</th>
                              <th>Position</th>
                              <th>Job Type</th>
                              <th>Print</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                  </table>
            </div>
            </div>
          </div>
    </section>
</div>
   
  </div>
  <?php 
    require("layouts/footer.php");
  ?>
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


<script src="AdminLTE_new/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script>
  <script src="AdminLTE_new/dist/js/adminlte.min.js"></script>
  <script src="AdminLTE_new/dist/js/demo.js"></script>

  <script>


$(function () {
    var datatable = 
            $('#employees-datatable').DataTable({
                // "searching": false,
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Enter Filter"
                },
                "bLengthChange": false,
                "ordering": false,
                // "info":     false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'employees',
                     'type': "POST",
                     "data": function (data){
                        data.action = "datatable";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'biometric_id', "orderable": false },
                    { data: 'FirstName', "orderable": false  },
                    { data: 'MiddleName', "orderable": false  },
                    { data: 'LastName', "orderable": false  },
                    { data: 'NameExtension', "orderable": false  },
                    { data: 'department', "orderable": false  },
                    { data: 'department_assigned', "orderable": false  },
                    { data: 'position', "orderable": false  },
                    { data: 'JobType', "orderable": false  },
                    { data: 'print_remarks', "orderable": false  },
                    { data: 'active_status', "orderable": false  },
                ],
                "footerCallback": function (row, data, start, end, display) {
                    // var api = this.api(), data;
                    

                    // Remove the formatting to get integer data for summation
                    // var intVal = function (i) {
                    //     return typeof i === 'string' ?
                    //         i.replace(/[\$,]/g, '') * 1 :
                    //         typeof i === 'number' ?
                    //             i : 0;
                    // };

                    // // Total over all pages
                    // received = api
                    //     .column(5)
                    //     .data()
                    //     .reduce(function (a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0);
                    //     console.log(received);

                    // $('#currentTotal').html('$ ' + received.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                }
            });
  })



  $('.select2').select2()


  $(function () {
    var datatable = 
            $('#datatable').DataTable({
                // "searching": false,
                "pageLength": 30,
                language: {
                    searchPlaceholder: "Enter Filter"
                },
                "bLengthChange": false,
                // "ordering": false,
                // "info":     false,
                'processing': true,
                // 'serverSide': true,
                'serverMethod': 'post',
                
              
                "footerCallback": function (row, data, start, end, display) {
                    
                }
            });
   
  })

function dialog_trigger(ele){
    $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
    });

}




$(document).ready(function(){
  $('#modal_edit_employees').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
      $.ajax({
          type : 'post',
          url : 'employees', //Here you will fetch records 
          data: {
              employee_id: rowid, action: "modal_edit_employees"
          },
          success : function(data){
              $('.fetch-data-emp').html(data);
              Swal.close();
              // $(".select2").select2();//Show fetched data from database
          }
      });
   });
});


$(document).ready(function(){
    
    $('#modal_update_payroll').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        Swal.fire({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type : 'post',
            url : 'employees', //Here you will fetch records 
            data: {
                employee_id: rowid, action: "modal_update_payroll"
            },
            success : function(data){
                $('.fetched-payroll').html(data);
                Swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });


     $('#modal_edit_deduction').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        var deduction = $(e.relatedTarget).data('deduction');
        swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type : 'post',
            url : 'employees', //Here you will fetch records 
            data: {
                employee_id: rowid, deduction: deduction ,action: "modal_edit_deduction"
            },
            success : function(data){
                $('.fetched_edit_deduction').html(data);
                swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });


     $('#modal_update_record').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type : 'post',
            url : 'employees', //Here you will fetch records 
            data: {
                service_record_id: rowid ,action: "modal_update_record"
            },
            success : function(data){
                $('.fetched_record_data').html(data);
                swal.close();
                // $(".select2").select2();//Show fetched data from database
            }
        });
     });




  });






$(document).ready(function(){
    $('#modal_appointment_specific').on('show.bs.modal', function (e) {
        var dataURL = $(e.relatedTarget).data('id');
        console.log(dataURL);
        $('.modal-body').load(dataURL,function(){
            $('#modal_appointment_specific').modal({show:true});
            
        });
     
     });
});


$('#select_option').click(function(){
    var method_select = $('#method_select').find(":selected").val();
    if(method_select == "")
        alert("Please Select a method for adding a service record");
    else{
        if(method_select == "appointment_record")
            $('#modal_add_appointment').modal({show:true});
        else if (method_select == "step_increment")
            $('#modal_step_increment').modal({show:true});
        else if (method_select == "salary_adjustment")
            $('#modal_salary_adjustment').modal({show:true});




    }
});







function print(ele) {
    var employee_id = $(ele).attr("data-id");
    var action = $(ele).attr("data-action");
    var from_date = "";
    var to_date = ""
    var url = "";

    if(action == "generate_individual_timesheet"){
        from_date = $("#from_date_timesheet").val();
        to_date = $("#to_date_timesheet").val();
        url = "dtr"
    }

    if(action == "generate_individual_dtr"){
        from_date = $("#from_date").val();
        to_date = $("#to_date").val();
        url = "dtr"
    }

    if(action == "print_appointment_form"){
      url = "print";
    }




    // console.log(transaction_type);
    swal({title: 'Please wait...', imageUrl: './public/images/loader/green-loader.gif', showConfirmButton: false});
    $.ajax({
      type: 'post',
      url: url,
      data: {
        employee_id: employee_id, 
        from_date: from_date, 
        to_date: to_date, 
        action: action, 
      },
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
                            }
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
      }
      });
    }




    $('#position_select').select2({
        minimumInputLength: 3,
        placeholder: "Search by Position Name or Title",
        ajax: {
            url: 'ajax_position',
            dataType: 'json',
            processResults: function (data) {
            return {
              results: $.map(data.results, function (item) {
                return {
                      text: item.supplier,
                      id: item.supplier,
                    }
                })
              }
            }
          },
        });

        $('#position_service').select2({
            minimumInputLength: 3,
            placeholder: "Search Position",
            ajax: {
                url: 'ajax_service_position',
                dataType: 'json',
                processResults: function (data) {
                return {
                  results: $.map(data.results, function (item) {
                    return {
                          text: item.supplier,
                          id: item.supplier,
                        }
                    })
                  }
                }
              },
            });


        $('#position_select_appointment').select2({
            minimumInputLength: 3,
            placeholder: "Search by Position Name or Title",
            ajax: {
                url: 'ajax_position_appointment',
                dataType: 'json',
                processResults: function (data) {
                return {
                  results: $.map(data.results, function (item) {
                    return {
                          text: item.name,
                          id: item.Positionid,
                        }
                    })
                  }
                }
              },
            });


            $('.department_select_appointment').select2({
                minimumInputLength: 3,
                placeholder: "Search by Department",
                ajax: {
                    url: 'ajax_department_appointment',
                    dataType: 'json',
                    processResults: function (data) {
                    return {
                      results: $.map(data.results, function (item) {
                        return {
                              text: item.name,
                              id: item.id,
                            }
                        })
                      }
                    }
                  },
                });

                $(document).ready(function(){
                    $('.appointment_select').select2({
                        minimumInputLength: 3,
                        placeholder: "Search Appointment",
                        ajax: {
                            url: 'ajax_appointment',
                            dataType: 'json',
                            processResults: function (data) {
                            return {
                              results: $.map(data.results, function (item) {
                                return {
                                      text: item.supplier,
                                      id: item.supplier,
                                    }
                                })
                              }
                            }
                          },
                        });
                });



       


        $('#place_select').select2({
            minimumInputLength: 2,
            placeholder: "Search place of assignment",
            ajax: {
                url: 'ajax_assignment',
                dataType: 'json',
                processResults: function (data) {
                return {
                  results: $.map(data.results, function (item) {
                    return {
                          text: item.supplier,
                          id: item.supplier,
                        }
                    })
                  }
                }
              },
            });



    $('#add_record_form').submit(function(e) {
        e.preventDefault();
        swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type: 'post',
            url: 'employees',
            data: $('#add_record_form').serialize(),
            success: function (results) {
                var o = jQuery.parseJSON(results);
                if(o.result == 'success'){
                    window.location.replace(o.link);
                }
                else if(o.result == 'failed'){
                    swal({
                        title: o.title,
                        text: o.message,
                        type: "error"
                    });
                }
            }
        });
        });


        $('.form_pass_general').submit(function(e) {
          e.preventDefault();
          swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
          $.ajax({
              type: 'post',
              url: 'employees',
              data: $('.form_pass_general').serialize(),
              success: function (results) {
                  var o = jQuery.parseJSON(results);
                  if(o.result == 'success'){
                      window.location.replace(o.link);
                  }
                  else if(o.result == 'failed'){
                      swal({
                          title: o.title,
                          text: o.message,
                          type: "error"
                      });
                  }
              }
          });
          });



          $('#employee_compensation_form').submit(function(e) {
            e.preventDefault();
            swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
            $.ajax({
                type: 'post',
                url: 'employees',
                data: $('#employee_compensation_form').serialize(),
                success: function (results) {
                    var o = jQuery.parseJSON(results);
                    if(o.result == 'success'){
                        window.location.replace(o.link);
                    }
                    else if(o.result == 'failed'){
                        swal({
                            title: o.title,
                            text: o.message,
                            type: "error"
                        });
                    }
                }
            });
            });



        $('#update_appointment_information').submit(function(e) {
            e.preventDefault();
            swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
            $.ajax({
                type: 'post',
                url: 'employees',
                data: $('#update_appointment_information').serialize(),
                success: function (results) {
                    var o = jQuery.parseJSON(results);
                    if(o.result == 'success'){
                        window.location.replace(o.link);
                    }
                    else if(o.result == 'failed'){
                        swal({
                            title: o.title,
                            text: o.message,
                            type: "error"
                        });
                    }
                }
            });
            });

         



            $('#register_deduction_form').submit(function(e) {
                e.preventDefault();
                swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
                $.ajax({
                  type: 'post',
                  url: 'employees',
                  data: $('#register_deduction_form').serialize(),
                  success: function (results) {
                      var o = jQuery.parseJSON(results);
                    //   alert(o.result);
                      if(o.result == 'success'){
                          window.location.replace(o.link);
                      }
                      else if(o.result == 'failed'){
                          swal({
                              title: o.title,
                              text: o.message,
                              type: "error"
                          });
                      }
                  }
                });
              });
            
            
            
            $('#deduction_select').on('change', function() {
            //   ( this.value );
              var rule_based = $(this).find(':selected').attr('data-id');
              var rule = $(this).find(':selected').attr('data-rule');
              if(rule_based == 1){
                $("#amount_group").css("display", "none");
                $("#rule").val(rule);
                $("#amount_input").val("");
              }
              else{
                $("#amount_group").css("display", "block");
                $("#rule").val("");
              }
            });


            $('.datepicker').datepicker({
                autoclose: true
              })
              
            //   $('.select2').select2()

  </script>


  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>