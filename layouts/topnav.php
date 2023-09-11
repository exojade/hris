<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index">Dashboard</a></li>
            <?php if(isset($_SESSION["hrmis_system"]["roles"]["appointment"])){ ?>
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Appointment <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="appointment?action=list">Plantilla</a></li>
                <li><a href="appointment?action=contract_list">Contract-Based</a></li>
                <li><a href="appointment_reports?action=length_service">Length Service</a></li>
                <li><a href="appointment_reports?action=nosi">NOSI</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if(isset($_SESSION["hrmis_system"]["roles"]["spms"])){ ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">SPMS <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="spms_dashboard?action=list">List</a></li>
                <li><a href="spms_dashboard?action=ipcr">IPCR</a></li>
                <li><a href="spms_dashboard?action=review">Review</a></li>
                <li><a href="spms_dashboard?action=ipcr">Assess</a></li>
                <li><a href="spms_dashboard?action=mpor">MPOR</a></li>
                <li><a href="spms_dashboard?action=support_functions">Support Functions</a></li>
              </ul>
            </li>
            <?php } ?>


            <?php if(isset($_SESSION["hrmis_system"]["roles"]["lnd"])){ ?>
              <li><a href="spms_dashboard?action=list">Trainings</a></li>
            <?php } ?>

            <?php if(isset($_SESSION["hrmis_system"]["roles"]["payroll"])){ ?>
              <li><a href="employees">Employees</a></li>
            <?php } ?>

            <?php if(isset($_SESSION["hrmis_system"]["roles"]["setup"])){ ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setup <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="department">Department</a></li>
                  <li><a href="group">Group</a></li>
                  <li><a href="position?action=list">Position</a></li>
                  <li><a href="salary_schedule?action=plantilla_list">Salary Grade for Plantilla</a></li>
                  <li><a href="loans_management?action=list">Loans</a></li>
                  <li><a href="compensation?action=list">Compensation</a></li>
                  <li><a href="contributions?action=list">Contributions</a></li>
                  <li><a href="salary_schedule?action=list">Salary Schedule</a></li>
                  <li><a href="deductions?action=list">Deductions</a></li>
                  <li><a href="rules">Rules</a></li>
                </ul>
              </li>
            <?php } ?>


            <?php if(isset($_SESSION["hrmis_system"]["roles"]["payroll"])){ ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Attendance <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="bio_logs">Biometric Logs</a></li>
                  <li><a href="attendance?action=dtras_locator">Locator Slip</a></li>
                  <li><a href="file_manager">File Manager</a></li>
                  <li><a href="leave_list?action=list">Leave List</a></li>
                  <li><a href="leave_panel?action=list">Leave Ledger</a></li>
                  <li><a href="schedule?action=list">Scheduler</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payroll <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="payroll_permanent?action=list">Payroll Permanent</a></li>
                  <li><a href="payroll_casual?action=list">Payroll Casual</a></li>
                  <li><a href="payroll_jo?action=list">Payroll Job Order</a></li>
                  <li><a href="payslip?action=list">Generate Payslip</a></li>
                  <li><a href="payroll?action=list">List</a></li>
                  <li><a href="loans_management?action=pchgea">PCHGEA</a></li>
                  <li><a href="payroll?action=special_payroll">Special Payroll</a></li>
                  <li><a href="payroll?action=masterlist">Masterlist</a></li>
                </ul>
              </li>
            <?php } ?>          
          </ul>
</div>