<?php

    require("includes/config.php");
    require("includes/uuid.php");
    require("includes/checkhit.php");
	require("includes/role.php");
	// require("PHPMailer/PHPMailerAutoload.php");
	
		$request = $_SERVER['REQUEST_URI'];

		// $activity = "Attempt visit page: " . $request;
    	// add_log($activity, "ATTEMPT VISIT");
		
		$constants = get_defined_constants();
		$request = explode('/hris',$request);
		// dump($request);
		$request = $request[1];
		$request = explode('?',$request);
		$request = $request[0];
		$request = explode('/',$request);
		$request = $request[1];
		// dump($request);
		// dump($_SESSION);
		$countering = array("login", "register", "payroll", "attendance", "print", "payroll_permanent", "payslip");
		if (!in_array($request, $countering)){
			if(empty($_SESSION["hris"]["userid"]) && empty($_SESSION["hris"]["application"])){
				require 'public/login_system/login.php';
			}
			else{
				if($request == 'index' || $request == ''){
					require 'apps/pds/pds_app/pds.php';
				}
				else if ($request == 'PC8934AA')
					require 'public/login_system/login.php';

				else if ($request == 'google_login')
					require 'public/google_login.php';


				//new redirects
				else if ($request == 'pds')
					require 'apps/pds/pds_app/pds.php';
				else if ($request == 'attendance')
					require 'apps/attendance/attendance_app/attendance.php';

				else if ($request == 'loans_management')
					require 'apps/payroll/loans_app/loans_management.php';
				else if ($request == 'mandatory')
					require 'apps/payroll/mandatory_deductions_app/mandatory.php';
				else if ($request == 'pchgea')
					require 'apps/payroll/pchgea_app/pchgea.php';
				else if ($request == 'rataca')
					require 'apps/payroll/rataca_app/rataca.php';



				else if ($request == 'employees')
					require 'apps/plantilla/employees_app/employees.php';


				else if ($request == 'plantilla_profile')
					require 'apps/plantilla/plantilla_profile_app/plantilla_profile.php';

				else if ($request == 'logs')
					require 'public/logs_system/logs.php';

				else if ($request == 'loans_management')
					require 'public/loans_system/loans.php';
				else if ($request == 'department')
					require 'public/department_system/department.php';
				else if ($request == 'group')
					require 'public/group_system/group.php';
				else if ($request == 'contributions')
					require 'public/contributions_system/contributions.php';
				else if ($request == 'leave_panel')
					require 'public/leave_panel_system/leave_panel.php';
				else if ($request == 'leave_list')
					require 'public/leave_list_system/leave_list.php';
				else if ($request == 'loans_contributions')
					require 'public/loans_contributions_system/loans_contributions.php';
				else if ($request == 'schedule')
					require 'public/schedule_system/schedule.php';

				//system for all related to biometrics uploads
				else if ($request == 'bio_logs')
					require 'public/bio_logs_system/bio_logs.php';

				// else if ($request == 'attendance')
				// 	require 'public/attendance_system/attendance.php';

				else if ($request == 'tardiness')
					require 'public/tardiness_system/tardiness.php';
				else if ($request == 'rules')
					require 'public/rules_system/rules.php';

				else if ($request == 'deductions')
					require 'public/deductions_system/deductions.php';

				else if ($request == 'compensation')
					require 'public/compensation_system/compensation.php';

				else if ($request == 'position')
					require 'public/position_system/position.php';

				else if ($request == 'appointment')
					require 'public/appointment_system/appointment.php';

				else if ($request == 'payroll')
					require 'public/payroll_system/payroll.php';




				else if ($request == 'payroll_permanent')
					require 'public/payroll_permanent_system/payroll_permanent.php';
				else if ($request == 'payroll_casual')
					require 'public/payroll_casual_system/payroll_casual.php';


				else if ($request == 'payslip')
					require 'public/payslip_system/payslip.php';

					
				

				else if ($request == 'dtr')
					require 'public/dtr_system/dtr.php';
				else if ($request == 'print')
					require 'public/print_system/print.php';
				else if ($request == 'salary_schedule')
					require 'public/salary_schedule_system/salary_schedule.php';
				else if ($request == 'publication')
					require 'public/publication_system/publication.php';

				else if ($request == 'spms_dashboard')
					require 'public/spms_dashboard_system/spms.php';
				else if ($request == 'file_manager')
					require 'public/file_manager_system/file_manager.php';

				else if ($request == 'leave')
					require 'public/leave_system/leave.php';



				//ajax
				else if ($request == 'ajax_employees')
					require 'public/ajax_system/ajax_employees.php';
				else if ($request == 'ajax_employeeIndividual')
					require 'public/ajax_system/ajax_employeeIndividual.php';
				else if ($request == 'ajax_service_position')
					require 'public/ajax_system/ajax_service_position.php';
				else if ($request == 'ajax_designation')
					require 'public/ajax_system/ajax_designation.php';
				else if ($request == 'ajax_position')
					require 'public/ajax_system/ajax_position.php';
				else if ($request == 'ajax_position_appointment')
					require 'public/ajax_system/ajax_position_appointment.php';
				else if ($request == 'ajax_assignment')
					require 'public/ajax_system/ajax_assignment.php';
				else if ($request == 'ajax_department_appointment')
					require 'public/ajax_system/ajax_department_appointment.php';
				else if ($request == 'ajax_appointment')
					require 'public/ajax_system/ajax_appointment.php';
				//logout
				else if ($request == 'logout'){
					require 'logout.php';
				}
				//404
				// else
					// require 'public/404_system/404.php';
			}
		}

		else{
			if ($request == 'login'){
				require 'public/login_system/login.php';
				exit();
			}

			else if ($request == 'payroll')
					require 'public/payroll_system/payroll.php';
			else if ($request == 'payroll_permanent')
					require 'public/payroll_permanent_system/payroll_permanent.php';
			else if ($request == 'attendance')
					require 'apps/attendance/attendance_app/attendance.php';
			else if ($request == 'print')
					require 'public/print_system/print.php';
			else if ($request == 'payslip')
					require 'public/payslip_system/payslip.php';

		}


		

		
	
		
		
			
		
?>
