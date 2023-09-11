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
</style>
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        RATACA Masterlist
        <small>Version 2.0</small>
      </h1>
    </section>
    <section class="content">

    <div class="modal fade" id="modal_allowance">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">Update PCHGEA Settings</h3>
              </div>
              <div class="modal-body">
                  <form class="generic_form_trigger" data-url="rataca" autocomplete="off">
                    <input type="hidden" name="action" value="save_rataca_settings">
                    <div class="fetched-data"></div>
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
                <h5 class="m-0">EMPLOYEES LIST (PERMANENT, COTERMINOUS)</h5>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered" id="loans_employee">
                  <thead>
                    <th>Employee</th>
                    <th>Plantilla | Assigned</th>
                    <th>Position</th>
                    <th>Representation</th>
                    <th>Travel</th>
                    <th>Communication</th>
                  </thead>
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
                    'url':'rataca',
                     'type': "POST",
                     "data": function (data){
                        data.action = "rataca_employees";
                     }
                },
                'columns': [
                    { data: 'name', "orderable": false },
                    { data: 'department', "orderable": false  },
                    { data: 'position', "orderable": false  },
                    { data: 'representation_allowance', "orderable": false  },
                    { data: 'travel_allowance', "orderable": false  },
                    { data: 'communication_allowance', "orderable": false  },
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


  $(document).ready(function(){
    $('#modal_allowance').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'rataca', //Here you will fetch records 
            data: {
                employee_id: rowid, action: "modal_allowance"
            },
            success : function(data){
                $('#modal_allowance .fetched-data').html(data);
            }
        });
     });
});

</script>
