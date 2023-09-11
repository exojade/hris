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
        Lenders
        <small>Version 2.0</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-7">
        <div class="card">
              <div class="card-header">
                <h5 class="m-0">LENDERS LIST</h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered sample_datatable">
                  <thead>
                    <th>Action</th>
                    <th>Full</th>
                    <th>Alias</th>
                  </thead>
                  <tbody>
                    <?php foreach($lenders as $row): ?>
                      <tr>
                        <td>
                          <a data-id="<?php echo($row["lenders_id"]); ?>" href="#" class="btn btn-primary btn-block">VIEW</a>
                       
                        </td>
                        <td><?php echo($row["lender"]); ?></td>
                        <td><?php echo($row["loan_name"]); ?></td>
                      </tr>

                    <?php endforeach; ?>
                  </tbody>


                </table>


          
              </div>
            </div>

        </div>
        <div class="col-md-5">
        <div class="card">
              <div class="card-header">
                <h5 class="m-0">LENDERS Form</h5>
              </div>
              <div class="card-body">
                <form class="generic_form_trigger" data-url="loans_management">
                  <input type="hidden" name="action" value="add_loan_type">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Lender / Bank Name</label>
                    <input required type="text" name="lender" class="form-control" id="exampleInputEmail1" placeholder="Bank Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Loans Name</label>
                    <input required type="text" name="loans_name" class="form-control" id="exampleInputEmail1" placeholder="Ex. Salary Loan">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>


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
  $(".sample_datatable").DataTable();

</script>
