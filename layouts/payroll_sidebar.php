<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" class="text-center">
      <img src="resources/panabologo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HRIS Payroll</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 text-center">
        <div class="image" style="display:block;">
          <?php if($_SESSION["mariphil"]["profile_image"] == ""): ?>
            <img style="width: 6rem;" src="resources/default.jpg" class="img-circle elevation-2" alt="User Image">
          <?php else: ?>
            <img style="width: 6rem;" src="<?php echo($_SESSION["mariphil"]["profile_image"]); ?>" class="img-circle elevation-2" alt="User Image">
          <?php endif; ?>
          
        </div>
        <div class="info" style="display:block;">
          <a href="#" class="d-block"><?php echo($_SESSION["mariphil"]["fullname"]); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  <li class="nav-header">ADMIN</li>
  <li class="nav-item">
      <a href="mandatory" class="nav-link">
        <i class="nav-icon fas fa-check"></i>
        <p>
          Mandatory
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>
  <li class="nav-item">
      <a href="rataca" class="nav-link">
        <i class="nav-icon fas fa-money-check"></i>
        <p>
          RATACA
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>
 
  <li class="nav-header">PCHGEA</li>
  <li class="nav-item">
      <a href="pchgea" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Dues
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>
  <li class="nav-item">
      <a href="pchgea?action=pchgea_burial" class="nav-link">
        <i class="nav-icon fas fa-cross"></i>
        <p>
          Burial Generator
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>
  <li class="nav-header">LOANS MANAGEMENT</li>
  <li class="nav-item">
      <a href="loans_management" class="nav-link">
        <i class="nav-icon fas fa-credit-card"></i>
        <p>
          Loans
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>
  <li class="nav-item">
      <a href="loans_management?action=lenders_list" class="nav-link">
        <i class="nav-icon fas fa-landmark"></i>
        <p>
          Lender
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>

  <li class="nav-header">PAYROLL</li>
  <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-money-bill-wave"></i>
        <p>
          Payroll
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>
  <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-receipt"></i>
        <p>
          Generate Payslip
          <span class="right badge badge-danger"></span>
        </p>
      </a>
  </li>

  
  

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <div class="modal fade" id="changePassword">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="generic_form_trigger" data-url="profile">
                <input type="hidden" name="action" value="changePassword">
                <input type="hidden" name="user_id" value="<?php echo($_SESSION["mariphil"]["userid"]) ?>">
                <div class="form-group">
                  <label>Current Password</label>
                  <input name="current_password" required type="password" class="form-control"  placeholder="---">
                </div>

                <div class="form-group">
                  <label>New Password</label>
                  <input name="new_password" required type="password" class="form-control"  placeholder="---">
                </div>

                <div class="form-group">
                  <label>Repeat New Password</label>
                  <input name="repeat_password" required type="password" class="form-control"  placeholder="---">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
          </div>
        </div>
      </div>