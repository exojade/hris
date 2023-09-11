
<style>
  .sidebar-menu::-webkit-scrollbar {
  display: none;
}
</style>
  <aside class="main-sidebar" >
    <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree" style="overflow-y:auto; height:600px; ">
		<li><a href="index"><i class="fa fa-dashboard text-aqua"></i> <span>Main</span></a></li>
    <?php if(isset($_SESSION["hrmis_system"]["roles"]["appointment"])){ ?>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar text-aqua"></i>
            <span>Appointment</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="appointment?action=list"><i class="fa fa-circle-o"></i>Plantilla</a></li>
            <li><a href="appointment?action=contract_list"><i class="fa fa-circle-o"></i>Contract-Based</a></li>
            <li><a href="appointment_reports?action=length_service"><i class="fa fa-circle-o"></i>Length Service</a></li>
            <li><a href="appointment_reports?action=nosi"><i class="fa fa-circle-o"></i>NOSI</a></li>
          </ul>
      </li>
    <?php } ?>
    <?php if(isset($_SESSION["hrmis_system"]["roles"]["spms"])){ ?>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-file text-aqua"></i>
            <span>SPMS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="leave_panel?action=list"><i class="fa fa-circle-o"></i> Tardiness</a></li> -->
            <li><a href="spms_dashboard?action=list"><i class="fa fa-file-excel-o text-aqua"></i> <span>List</span></a></li>
            <li><a href="spms_dashboard?action=ipcr"><i class="fa fa-file-excel-o text-aqua"></i> <span>IPCR</span></a></li>
            <li><a href="spms_dashboard?action=review"><i class="fa fa-file-excel-o text-aqua"></i> <span>Review</span></a></li>
            <li><a href="spms_dashboard?action=ipcr"><i class="fa fa-file-excel-o text-aqua"></i> <span>Assess</span></a></li>
            <li><a href="spms_dashboard?action=mpor"><i class="fa fa-file-excel-o text-aqua"></i> <span>MPOR</span></a></li>
            <li><a href="spms_dashboard?action=support_functions"><i class="fa fa-file-excel-o text-aqua"></i> <span>Support Functions</span></a></li>
          </ul>
    </li>
    <?php } ?>
		<!-- <li><a href="spms_dashboard?action=list"><i class="fa fa-dashboard text-aqua"></i> <span>SPMS</span></a></li> -->
    <?php if(isset($_SESSION["hrmis_system"]["roles"]["lnd"])){ ?>
		<li><a href="spms_dashboard?action=list"><i class="fa fa-dashboard text-aqua"></i> <span>Trainings</span></a></li>
    <?php } ?>
    <li class="header">ADMIN NAVIGATION</li>
    <?php if(isset($_SESSION["hrmis_system"]["roles"]["payroll"])){ ?>
    <li><a href="employees"><i class="fa fa-users text-aqua"></i> <span>Employees</span></a></li>
    <?php } ?>

    <?php if(isset($_SESSION["hrmis_system"]["roles"]["setup"])){ ?>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-gear text-aqua"></i>
            <span>Setup</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="leave_panel?action=list"><i class="fa fa-circle-o"></i> Tardiness</a></li> -->
            <li><a href="department"><i class="fa fa-circle-o text-aqua"></i> <span>Department</span></a></li>
            <li><a href="group"><i class="fa fa-circle-o text-aqua"></i> <span>Group</span></a></li>
            <li><a href="position?action=list"><i class="fa fa-circle-o text-aqua"></i> <span>Position</span></a></li>
            <li><a href="salary_schedule?action=plantilla_list"><i class="fa fa-circle-o text-aqua"></i> Salary Grade for Plantilla</a></li>
            <li><a href="compensation?action=list"><i class="fa fa-circle-o"></i> Compensation</a></li>
            <li><a href="contributions?action=list"><i class="fa fa-circle-o"></i> Contributions</a></li>
            <li><a href="salary_schedule?action=list"><i class="fa fa-circle-o"></i> Salary Schedule</a></li>
            <li><a href="deductions?action=list"><i class="fa fa-circle-o"></i> Deductions</a></li>
            <li><a href="rules"><i class="fa fa-cogs text-aqua"></i> <span>Rules</span></a></li>
          </ul>
    </li>
    <?php } ?>
    <?php if(isset($_SESSION["hrmis_system"]["roles"]["payroll"])){ ?>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-hand-pointer-o text-aqua"></i>
            <span>Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="bio_logs"><i class="fa fa-circle-o"></i> Biometric Logs</a></li>
            <li><a href="attendance?action=dtras_locator"><i class="fa fa-circle-o"></i> Locator Slip</a></li>
            <li><a href="file_manager"><i class="fa fa-circle-o"></i> File Manager</a></li>
            <li><a href="leave_list?action=list"><i class="fa fa-circle-o"></i> Leave List</a></li>
            <li><a href="leave_panel?action=list"><i class="fa fa-circle-o"></i> Leave Ledger</a></li>
            <li><a href="schedule?action=list"><i class="fa fa-circle-o"></i> Scheduler</a></li>
          </ul>
    </li>
    

    <li class="treeview">
          <a href="#">
            <i class="fa fa-rouble text-aqua"></i>
            <span>Payroll</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="payroll_permanent?action=list"><i class="fa fa-circle-o"></i> Payroll Permanent</a></li>
            <li><a href="payroll?action=list"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="loans_management?action=list"><i class="fa fa-circle-o"></i> Loans</a></li>
            <li><a href="payroll?action=special_payroll"><i class="fa fa-circle-o"></i> Special Payroll</a></li>
            <li><a href="payroll?action=masterlist"><i class="fa fa-circle-o"></i> Masterlist</a></li>
          </ul>
    </li>
    <?php } ?>

    <li><a href="bio_logs"><i class="fa fa-cogs text-aqua"></i> <span>Group</span></a></li>
    <!-- <li><a href="leave_panel?action=list"><i class="fa fa-users"></i> <span>Leave Panel</span></a></li> -->
    <!-- <li><a href="tardiness?action=list"><i class="fa fa-users"></i> <span>Tardiness</span></a></li> -->
   
    </ul>
    </section>
  </aside>