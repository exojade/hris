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

/* ::-webkit-scrollbar { 
    display: none; 
} */
</style>


  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        PCHGEA Burial Assistance Generator
        <small>Version 2.0</small>
        
      </h1>
      
    </section>
    <section class="content">

    <div class="modal fade" id="modal_burial">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">Register Burial Assistance</h3>
              </div>
              <div class="modal-body">
                  <form class="generic_form_trigger" data-url="pchgea" autocomplete="off">
                    <input type="hidden" name="action" value="save_burial">
                    <div class="form-group">
                        <label>Month</label>
                          <select class="form-control" name="month">
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "01"): $selected="selected"; endif; echo($selected); ?> value="01">January</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "02"): $selected="selected"; endif; echo($selected); ?> value="02">February</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "03"): $selected="selected"; endif; echo($selected); ?> value="03">March</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "04"): $selected="selected"; endif; echo($selected); ?> value="04">April</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "05"): $selected="selected"; endif; echo($selected); ?> value="05">May</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "06"): $selected="selected"; endif; echo($selected); ?> value="06">June</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "07"): $selected="selected"; endif; echo($selected); ?> value="07">July</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "08"): $selected="selected"; endif; echo($selected); ?> value="08">August</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "09"): $selected="selected"; endif; echo($selected); ?> value="09">September</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "10"): $selected="selected"; endif; echo($selected); ?> value="10">October</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "11"): $selected="selected"; endif; echo($selected); ?> value="11">November</option>
                            <option <?php $selected = ""; if(date("m", strtotime("-1 months")) == "12"): $selected="selected"; endif; echo($selected); ?> value="12">December</option>
                          </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Year</label>
                      <input name="year" type="number" value="<?php echo(date("Y")); ?>" class="form-control" placeholder="---">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Dependents</label>
                      <input name="dependents" type="number" class="form-control" placeholder="# of Employees to assist">
                    </div>
                    <hr>
                      <div class="box-footer">
                        <button class=" btn btn-default btn-flat pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat pull-right">Submit</button>
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>



    <div id="dialog" style="display: none"></div>
      <div class="card">
              <div class="card-header">
                <h5 class="m-0">PCHGEA Burial Assistance
                  <a href="#" data-toggle='modal' data-target='#modal_burial' class="btn btn-primary" style="float:right;">Generate Burial Assistance</a>
                </h5>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered datatable">
                  <thead>
                    <th>Action</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Fee</th>
                    <th>Dependent(s)</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    <?php foreach($burial as $row): ?>
                      <tr>
                        <td><?php echo($row["burial_id"]); ?></td>
                        <td><?php echo($row["month_name"]); ?></td>
                        <td><?php echo($row["year"]); ?></td>
                        <td><?php echo($row["amount_fee"]); ?></td>
                        <td><?php echo($row["dependents"]); ?></td>
                        <td><?php echo($row["dependents"] * $row["amount_fee"]); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
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
<script>
  // $("#loans_employee").DataTable();

</script>



<script>
  $('.datatable').DataTable();
 $(function () {
    var datatable = 
            $('#loans_employee').DataTable({
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
                    'url':'pchgea',
                     'type': "POST",
                     "data": function (data){
                        data.action = "pchgea_employees";
                     }
                },
                'columns': [
                    { data: 'name', "orderable": false },
                    { data: 'department', "orderable": false  },
                    { data: 'position', "orderable": false  },
                    { data: 'dues', "orderable": false  },
                    { data: 'burial', "orderable": false  },
                    // { data: 'department_assigned', "orderable": false  },
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

</script>
