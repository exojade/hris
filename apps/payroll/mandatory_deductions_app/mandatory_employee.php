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
        Mandatory Deductions
        <small>Version 2.0</small>
      </h1>
    </section>
    <section class="content">
    <div id="dialog" style="display: none"></div>
      <div class="card">
              <div class="card-header">
                <h5 class="m-0">LOAN DASHBOARD of <?php echo("(".$employee["Fingerid"] . ") " . $employee["name"]); ?></h5>
              </div>
              <div class="card-body table-responsive">
              <form class="generic_form_trigger" data-url="mandatory">
              <input type="hidden" name="action" value="save_mandatory">
              <input type="hidden" name="employee_id" value="<?php echo($_GET["id"]); ?>">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">SSS PS</label>
                    <input value="<?php echo($mandatory["sss_ps"]); ?>" type="text" name="sss_ps" class="form-control" id="exampleInputEmail1" placeholder="---">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">HDMF PS</label>
                    <input min="100" step="0.01" value="<?php echo($mandatory["hdmf_ps"]); ?>" type="number" name="hdmf_ps" class="form-control" id="exampleInputEmail1" placeholder="---">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">HDMF MP2</label>
                    <input step="0.01" value="<?php echo($mandatory["hdmf_mp2"]); ?>" type="number" name="hdmf_mp2" class="form-control" id="exampleInputEmail1" placeholder="---">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Witholding Tax</label>
                    <input step="0.01" value="<?php echo($mandatory["witholding_tax"]); ?>" type="number" name="witholding_tax" class="form-control" id="exampleInputEmail1" placeholder="---">
                  </div>
                </div>
     
              </div>
              <button class="btn btn-primary" type="submit">Save</button>
              </form>
                
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



