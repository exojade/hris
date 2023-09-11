<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
        <a href="#" data-toggle="modal" data-target="#modal_siteoptions" class="btn btn-info pull-right btn-flat">Site Options</a>
        <a href="#" data-toggle="modal" data-target="#modal_initial_email" class="btn btn-success pull-right btn-flat">Google Drive Mail</a>
      </h1>
      
    </section>
    <section class="content">
    <div class="modal fade" id="modal_initial_email">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">SEND INITIAL EMAIL TO THE AO's</h3>
              </div>
              <div class="modal-body">
              <form class="generic_form_trigger" url="main">
                <input type="hidden" name="action" value="initial_email">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Date From</label>
                  <input required type="date" placeholder="---" name="date_from"  class="form-control">
                </div>

                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Date To</label>
                  <input required type="date" placeholder="---" name="date_to"  class="form-control">
                </div>
                  </div>
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-social pull-right" ><i class="fa fa-edit"></i>Save Changes</button>
              </div>
            </form>
            
              </div>
            </div>
          </div>
        </div>


    <div class="modal fade" id="modal_siteoptions">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Update Site Options</h3>
              </div>
              <div class="modal-body">
              <form class="generic_form" url="main">
                <input type="hidden" name="action" value="update_site_options">
                <div class="form-group">
                  <label>Site Url</label>
                  <input required type="text" placeholder="---" value="<?php echo($site_options["site_url"]); ?>" name="site_url"  class="form-control">
                </div>
                <div class="form-group">
                  <label>Google Client ID</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["google_clientID"]); ?>" name="google_clientID"  class="form-control">
                </div>
                <div class="form-group">
                  <label>Google Client Secret</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["google_clientSecret"]); ?>" name="google_clientSecret"  class="form-control">
                </div>
                <div class="form-group">
                  <label>Google Redirect URI</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["google_redirectUri"]); ?>" name="google_redirectUri"  class="form-control">
                </div>
                <div class="form-group">
                  <label>Google Folder ID</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["google_folder_id"]); ?>" name="google_folder_id"  class="form-control">
                </div>

                <div class="form-group">
                  <label>Google Folder Link</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["google_full_id"]); ?>" name="google_full_id"  class="form-control">
                </div>

                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>From Email</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["email_from"]); ?>" name="email_from"  class="form-control">
                </div>

                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Email Secret Password</label>
                  <input  type="text" placeholder="---" value="<?php echo($site_options["email_password"]); ?>" name="email_password"  class="form-control">
                </div>

                  </div>
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-social pull-right" ><i class="fa fa-edit"></i>Save Changes</button>
              </div>
            </form>
            
              </div>
            </div>
          </div>
        </div>



    <div class="row">
      <div class="col-md-4">

      <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Birthdays This Month <i class="fa fa-birthday-cake"></i></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                  <ul class="products-list product-list-in-box">
               <?php foreach($birth_month as $m): ?>
                <li class="item">
                  <div class="product-img">
                    <img src="AdminLTE/dist/img/avatar5.png" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title"><?php echo($m["fullname"]); ?> <span class="label label-danger pull-right"><?php echo($m["Fingerid"]); ?></span></a>
                    <span class="product-description">
                    <?php
                    $newDate = date("F d", strtotime($m["BirthDate"]));
                    
                    echo($newDate); ?>
                        </span>
                  </div>
                </li>
                <?php endforeach; ?>
                <!-- /.item -->
              
                <!-- /.item -->
              
                <!-- /.item -->
              </ul>
                  </div>
                </div>
                <div class="box-footer">
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
  <script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>

  <script src="public/dashboard_system/main.js"></script>
  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>