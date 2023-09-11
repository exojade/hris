<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
 <style>
 @font-face { 
	 font-family: 'Space Grotesk';
	 font-style: normal;
	 font-weight: 400;
	 font-display: swap;
	 src: url('file_folder/resources/fonts/SpaceGrotesk-Regular.ttf'); 
 }
 
 
 html *
 {
	 font-family: 'Space Grotesk', sans-serif;
 }
 
	 .tabular, .tabular th, .tabular td {
	border: 1px solid #8D8E8E !important;
	font-size: 11px;
 }
 
 #fordtr{font-size:12px;}
 #fordtr td{padding: 2px !important; font-size: 10px !important}
 #fordtr th{padding: 5px !important;}
 
 .header-table td{
  font-size: 12px;
  color: #000;
 }
 
 p{
   margin:0px;
 }
	 </style>
 
 <style>
 .watermarked {
   position: relative;
 }
 
 .watermarked:after {
   content: "";
   display: block;
   width: 100%;
   height: 100%;
   position: absolute;
   top: 0px;
   left: 0px;
   background:  url("file_folder/resources/backgrounder-sample.png");
   background-size: 360px 640px;
   background-position: 0px 150px;
   background-repeat: no-repeat;
   opacity: 0.1;
 }
 
 .tabular td{
	 font-weight: 800;
 }
 </style>
 <?php
 
 $from_date = date('Y-m-01', strtotime($_GET["from_date"]));
 $_GET["from_date"] = $from_date;
 $to_date = date('Y-m-t',strtotime($from_date));
 $_GET["to_date"] = $to_date;
 $from_date = date('M d, Y', strtotime($from_date));
 $to_date = date('M d, Y', strtotime($to_date));
 // dump($_GET["to_date"]);
 
 
 $date1=date_create($_GET["from_date"]);
 $date2=date_create($_GET["to_date"]);
 $diff=date_diff($date1,$date2);
 $diff = $diff->format('%a');
 $diff++;
 
 $date5 = new DateTime($_GET["from_date"]);
 $stringdatefrom = $date5->format('M d, Y');
 $date5 = new DateTime($_GET["to_date"]);
 $stringdateend = $date5->format('M d, Y');
 $school = getDatesFromRange($_GET["from_date"], $_GET["to_date"]);
 
 
 
 
 
 $the_employees = [];
 $Employees = [];
 
 $Department = [];
 $department = query("select * from tbldepartment");
 foreach($department as $d):
	 $Department[$d["Deptid"]] = $d;
 endforeach;
 
 
 
 
 // dump($_GET);
 if($_GET["category"] == "department"){
	 if($_GET["emp_status"] == 0):
		 $string = "select * from tblattendance where DeptAssignment = '".$_GET["option"]."' and print_remarks in ('DTR', 'BOTH') group by Employeeid order by LastName ASC, FirstName ASC limit 10 offset ".$_GET["offset"]."";
	 elseif($_GET["emp_status"] == 1):
		 $string = "select * from tblattendance where DeptAssignment = '".$_GET["option"]."' and print_remarks in ('DTR', 'BOTH') and JobType in ('PERMANENT','COTERMINOUS') group by Employeeid order by LastName ASC, FirstName ASC limit 10 offset ".$_GET["offset"]."";
	 elseif($_GET["emp_status"] == 2):
		 $string = "select * from tblattendance where DeptAssignment = '".$_GET["option"]."' and print_remarks in ('DTR', 'BOTH') and JobType in ('CASUAL','JOB ORDER', 'HONORARIUM') group by Employeeid order by LastName ASC, FirstName ASC limit 10 offset ".$_GET["offset"]."";
	 endif;
 
	 // if($_GET["emp_status"] == 0):
	 // 	$string = "select FirstName, LastName, print_remarks, DeptAssignment,Fingerid,Employeeid from tblemployee where DeptAssignment = '".$_GET["option"]."' and print_remarks in ('DTR', 'BOTH') and active_status = '1' group by Employeeid order by LastName ASC, FirstName ASC limit 10 offset ".$_GET["offset"]."";
	 // elseif($_GET["emp_status"] == 1):
	 // 	$string = "select FirstName, LastName, print_remarks, DeptAssignment,Fingerid,Employeeid from tblemployee from tblemployee where DeptAssignment = '".$_GET["option"]."' and print_remarks in ('DTR', 'BOTH') and active_status = '1' and JobType in ('PERMANENT','COTERMINOUS') group by Employeeid order by LastName ASC, FirstName ASC limit 10 offset ".$_GET["offset"]."";
	 // elseif($_GET["emp_status"] == 2):
	 // 	$string = "select FirstName, LastName, print_remarks, DeptAssignment,Fingerid,Employeeid from tblemployee from tblemployee where DeptAssignment = '".$_GET["option"]."' and print_remarks in ('DTR', 'BOTH') and active_status = '1' and JobType in ('CASUAL','JOB ORDER', 'HONORARIUM') group by Employeeid order by LastName ASC, FirstName ASC limit 10 offset ".$_GET["offset"]."";
	 // endif;
 
	 
 
 
	 // if($_GET["emp_status"] == 0):
	 // 	$string = "select * from tblemployee where DeptAssignment = '".$_GET["option"]."' and active_status = 1 and print_remarks in ('DTR', 'BOTH') order by LastName ASC, FirstName ASC limit 30 offset ".$_GET["offset"]."";
	 // elseif($_GET["emp_status"] == 1):
	 // 	$string = "select * from tblemployee where DeptAssignment = '".$_GET["option"]."' and active_status = 1 and print_remarks in ('DTR', 'BOTH') and JobType in ('PERMANENT','COTERMINOUS') order by LastName ASC, FirstName ASC limit 30 offset ".$_GET["offset"]."";
	 // elseif($_GET["emp_status"] == 2):
	 // 	$string = "select * from tblemployee where DeptAssignment = '".$_GET["option"]."' and active_status = 1 and print_remarks in ('DTR', 'BOTH') and JobType in ('CASUAL','JOB ORDER', 'HONORARIUM') order by LastName ASC, FirstName ASC limit 30 offset ".$_GET["offset"]."";
	 // endif;
	 
	 // dump($string);
	 $employee = query($string);
	 
	 $Employees = [];
 
	 // $employees = query("select * from tblemployee  where DeptAssignment = ? and active_status = 1", $_GET["option"]);
	 foreach($employee as $e):
		 $Employees[$e["Employeeid"]] = $e;
	 endforeach;
	 foreach($employee as $e):
		 array_push($the_employees, $e["Employeeid"]);
	 endforeach;
	 $string = implode('","', $the_employees);
	 $where_in_employees = '"' . $string . '"';
	 
 }
 
 if($_GET["category"] == "group"){
	 $group = query("select * from tbl_group where group_name = ?", $_GET["option"]);
	 $string = "select Employeeid from tblemployee where GroupName = '".$_GET["option"]."' and active_status = 1 order by LastName limit 30 offset ".$_GET["offset"]."";
	 // dump($string);
	 $employee = query($string);
	 $Employees = [];
	 $employees = query("select * from tblemployee where GroupName = ? and active_status = 1", $_GET["option"]);
	 foreach($employees as $e):
		 $Employees[$e["Employeeid"]] = $e;
	 endforeach;
	 foreach($employee as $e):
		 array_push($the_employees, $e["Employeeid"]);
	 endforeach;
	 $string = implode('","', $the_employees);
	 $where_in_employees = '"' . $string . '"';
 }
 
 else if($_GET["category"] == "employee"){
	 $string = "select Employeeid, DeptAssignment from tblemployee where Employeeid = '".$_GET["option"]."'";
	 $employee = query($string);
	 // dump($employee);
	 $department = query("select * from tbldepartment where Deptid = ?", $employee[0]["DeptAssignment"]);
 
	 
	 
	 $Employees = [];
	 $employees = query("select * from tblemployee  where Employeeid = ?", $_GET["option"]);
	 foreach($employees as $e):
		 $Employees[$e["Employeeid"]] = $e;
	 endforeach;
	 foreach($employee as $e):
		 array_push($the_employees, $e["Employeeid"]);
	 endforeach;
	 $string = implode('","', $the_employees);
	 $where_in_employees = '"' . $string . '"';
 }
 // dump($where_in_employees);
//  $attendance = query("select Employeeid, Date ,max(AMArrival), max(AMDeparture),max(PMArrival),max(PMDeparture), number_lates, minutes_late from tblattendance where Employeeid in (".$where_in_employees.") and Date between ? and ?
//  GROUP BY Employeeid, Date ORDER BY DATE, AMArrival", $_GET["from_date"], $_GET["to_date"]);


 $attendance = query("select Employeeid, Date ,max(AMArrival), max(AMDeparture),max(PMArrival),max(PMDeparture),max(overtime_in),max(overtime_out), number_lates, minutes_late from tblattendance where Employeeid in (".$where_in_employees.") and Date between ? and ?
 GROUP BY Employeeid, Date ORDER BY DATE, AMArrival", $_GET["from_date"], $_GET["to_date"]);
 // dump($attendance);
 
 // $Dtras = [];
 // $Dtras_Date = [];
 // $dtras = query("select * from tblemployee_dtras where employee_id in (".$where_in_employees.")");
 // $dtras_date = query("select * from tblemployee_dtras_dates where date_info between ? and ? order by date_info ASC", $_GET["from_date"], $_GET["to_date"]);
 // foreach($dtras as $d):
 // 	$Dtras[$d["dtras_id"]] = $d;
 // endforeach;
 
 // foreach($dtras_date as $d):
 // 	$Dtras_Date[$d["dtras_id"]][$d["date_info"]] = $d;
 // 	$Dtras_Date[$d["dtras_id"]][$d["date_info"]]["AMArrival"] = $Dtras[$d["dtras_id"]]["AMArrival"];
 // 	$Dtras_Date[$d["dtras_id"]][$d["date_info"]]["AMDeparture"] = $Dtras[$d["dtras_id"]]["AMDeparture"];
 // 	$Dtras_Date[$d["dtras_id"]][$d["date_info"]]["PMArrival"] = $Dtras[$d["dtras_id"]]["PMArrival"];
 // 	$Dtras_Date[$d["dtras_id"]][$d["date_info"]]["PMDeparture"] = $Dtras[$d["dtras_id"]]["PMDeparture"];
 // endforeach;
 
 // dump($Dtras_Date);
 $Attendance = [];
 
 foreach($attendance as $a):
   $Attendance[$a["Employeeid"]][$a["Date"]] = $a;
 endforeach;
 ?>
 
 <?php

 foreach($employee as $e): ?>
	 <?php if(isset($Attendance[$e["Employeeid"]])) {?>
	 <div class="col-md-6 col-xs-6 col-sm-6" style="page-break-inside: avoid; page-break-after: always; height: 900px;">
 <?php
 $qrTempDir = 'file_folder/resources';
 $filePath = $qrTempDir.'/'.uniqid();
 
 QRcode::png($Employees[$e["Employeeid"]]["Employeeid"], $filePath);
 $qrImage = file_get_contents($filePath);
 unlink($filePath);
 ?>
		 <div class="watermarked">
		 <!-- <img style="position: absolute;" src="pdf/background.png" /> -->
			 <div class="box-body">
			 <p class="text-center" style="margin-top:30px;">DAILY TIME RECORD</p>
			 <br>
			 
			 <table class="table header-table" style="border: none !important; width:100%; " >
			 <style>
				 td{
					 border:none !important;
					 padding:1px !important;
				 }
			 </style>
				 <tr>
					 <td width="25%"><b>EMP No</b></td>
					 <td>: <?php echo($Employees[$e["Employeeid"]]["Fingerid"]); ?></td>
				 </tr>
				 <tr>
					 <td><b>EMP Name</b></td>
					 <td>: <?php
					 $Employees[$e["Employeeid"]]["LastName"] = str_replace("?","Ñ",$Employees[$e["Employeeid"]]["LastName"]);
					 $Employees[$e["Employeeid"]]["FirstName"] = str_replace("?","Ñ",$Employees[$e["Employeeid"]]["FirstName"]);
					 echo($Employees[$e["Employeeid"]]["LastName"] . ", " . $Employees[$e["Employeeid"]]["FirstName"] . " " .  $Employees[$e["Employeeid"]]["MiddleName"]) ?></td>
				 </tr>
				 <tr>
					 <td><b>Directorate</b></td>
					 <td>: <?php 
					 
					 if(isset($Department[$Employees[$e["Employeeid"]]["DeptAssignment"]]))
						 echo($Department[$Employees[$e["Employeeid"]]["DeptAssignment"]]["DeptCode"]);
					 ?></td>
				 </tr>
			 </table>
			 <div>
			 <!-- <div style="padding-right:70px;"> -->
			   <table class="table tabular" id="fordtr" >
				 <thead>
					 <tr>
						 <th class="text-center" colspan="7"><?php
						 $from_date_timestamp = strtotime($from_date);
						 $from_date_new_date = date('F Y', $from_date_timestamp); 
						 
						 echo("For the Month of " . $from_date_new_date) ?></th>
					 </tr>
				 <tr>
				   <th width="4%" rowspan="2" class="text-center">Day</th>
				   <th colspan="2" style="text-align:center;">AM</th>
				   <th colspan="2" style="text-align:center;">PM</th>
				   <th colspan="2" style="text-align:center;">OT</th>
				 </tr>
				 <tr>
					 <th width="15%" style="text-align:center;">IN</th>
					 <th width="15%" style="text-align:center;">OUT</th>
					 <th width="15%" style="text-align:center;">IN</th>
					 <th width="15%" style="text-align:center;">OUT</th>
					 <th width="15%" style="text-align:center;">IN</th>
					 <th width="15%" style="text-align:center;">OUT</th>
				 </tr>
				 </thead>
				 <tbody>
		 <?php
		 $i= 0;
		 $number_lates = 0;
		 $minutes_late = 0;
		 // dump($Attendance);
		 for ($i = 0; $i<sizeof($school); $i++)
		 {
			 if (isset($Attendance[$e["Employeeid"]][$school[$i]]))
			 {
				//  $number_lates = $number_lates + $Attendance[$e["Employeeid"]][$school[$i]]["number_lates"];
				//  $minutes_late = $minutes_late + $Attendance[$e["Employeeid"]][$school[$i]]["minutes_late"];
				 ?>
				 <tr>
				   <td class="text-center"><?php
				  $old_date_timestamp = strtotime($school[$i]);
				  $new_date = date('d', $old_date_timestamp); 
				 
				  $am_arrival_date = "";
				  $am_departure_date = "";
				  $pm_arrival_date = "";
				  $pm_departure_date = "";
				  $overtime_in = "";
				  $overtime_out = "";
				 //  if($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				 // if($Attendance[$e["Employeeid"]][$school[$i]]["max(AMDeparture)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				 // if($Attendance[$e["Employeeid"]][$school[$i]]["max(PMArrival)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				 // if($Attendance[$e["Employeeid"]][$school[$i]]["max(PMDeparture)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				  
					 
				 $am_arrival_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i])) : "";
				  $am_departure_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(AMDeparture)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMDeparture)"] . ":00 " . $school[$i])) : "";
				  $pm_arrival_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(PMArrival)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(PMArrival)"] . ":00 " . $school[$i])) : "";
				  $pm_departure_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(PMDeparture)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(PMDeparture)"] . ":00 " . $school[$i])) : "";
 

				  $overtime_in = $Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_in)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_in)"] . ":00 " . $school[$i])) : "";
				  $overtime_out = $Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_out)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_out)"] . ":00 " . $school[$i])) : "";

				  
				  $am_arrival_date = rtrim($am_arrival_date, "M");
				  $am_departure_date = rtrim($am_departure_date, "M");
				  $pm_arrival_date = rtrim($pm_arrival_date, "M");
				  $pm_departure_date = rtrim($pm_departure_date, "M");
				  $overtime_in = rtrim($overtime_in, "M");
				  $overtime_out = rtrim($overtime_out, "M");
 
				 //  echo date('h:i:s a m/d/Y', strtotime($date));
				  echo($new_date) ?></td>
				   <td><?php echo($am_arrival_date) ?></td>
				   <td><?php echo($am_departure_date) ?></td>
				   <td><?php echo($pm_arrival_date) ?></td>
				   <td><?php echo($pm_departure_date) ?></td>
				   <td><?php echo($overtime_in) ?></td>
				   <td><?php echo($overtime_out) ?></td>
				 </tr>
				 
				 <?php
			 }
			 else
			 {
				 $old_date_timestamp = strtotime($school[$i]);
				 $new_date = date('d', $old_date_timestamp); 
 
				 $data = isweekend($school[$i]);
				 if($data == "false"):
				 ?>
				 <tr>
				 <td class="text-center"><?php 
				 echo($new_date) ?></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 </tr>
				 <?php
				 else:
				 ?>
				 <tr>
				 <td class="text-center"><?php echo($new_date) ?></td>
				 <td colspan="6"><b><?php echo($data); ?></b></td>
				 </tr>
				 <?php
				 endif;
			 }
		 }
		 ?>
		  </tfoot>
			   </table>
	 </div>
		 <div class="row">
			 <div class="col-xs-6">
				 <p style="font-size:11px;"># of Lates : <?php echo($number_lates); ?></p>
			 </div>
			 <div class="col-xs-6">
				 <p style="font-size:11px;">Minutes of Lates : <?php echo($minutes_late); ?></p>
			 </div>
		 </div>
		 <p class="text-justify" style="font-size:11px;">I certify on my honor that the above is a true and correct
		 report of the hours of work performed, record of which was made daily at the time of arrival
		 and departure from office.</p>
		 <div class="row">
			 <div class="col-md-8 col-xs-8 col-sm-8">
			 <p style="font-size:11px; font-weight: 600; margin-top: 40; border-top: 2px solid black;"> Signature of the Employee</p>
			 <p style="font-size:11px; font-weight: 600; margin-top: 55px; border-top: 2px solid black;"> Signature of the Office-in-charge</span>
			 </div>
			 <div class="col-md-4 col-xs-4 col-sm-4">
				 <img style="margin-top:40;" class="pull-right" src="data:image/png;base64,<?php echo base64_encode($qrImage) ?>" width="80" height="80"/>
			 </div>
		 </div>
		 <br>
		   <p style="font-size: 7px;"><i>This report is computer generated by the HRMIS v2.0</i></p>
		   <p style="font-size: 7px;"><i>Copyright: CHRMO / CADO -IT</i></p>
			 </div>
			 <!-- /.box-body -->
		   </div>
		   
   </div>

   <div class="col-md-6 col-xs-6 col-sm-6" style="page-break-inside: avoid; page-break-after: always; height: 900px;">
 <?php
 $qrTempDir = 'file_folder/resources';
 $filePath = $qrTempDir.'/'.uniqid();
 
 QRcode::png($Employees[$e["Employeeid"]]["Employeeid"], $filePath);
 $qrImage = file_get_contents($filePath);
 unlink($filePath);
 ?>
		 <div class="watermarked">
		 <!-- <img style="position: absolute;" src="pdf/background.png" /> -->
			 <div class="box-body">
			 <p class="text-center" style="margin-top:30px;">DAILY TIME RECORD</p>
			 <br>
			 
			 <table class="table header-table" style="border: none !important; width:100%; " >
			 <style>
				 td{
					 border:none !important;
					 padding:1px !important;
				 }
			 </style>
				 <tr>
					 <td width="25%"><b>EMP No</b></td>
					 <td>: <?php echo($Employees[$e["Employeeid"]]["Fingerid"]); ?></td>
				 </tr>
				 <tr>
					 <td><b>EMP Name</b></td>
					 <td>: <?php
					 $Employees[$e["Employeeid"]]["LastName"] = str_replace("?","Ñ",$Employees[$e["Employeeid"]]["LastName"]);
					 $Employees[$e["Employeeid"]]["FirstName"] = str_replace("?","Ñ",$Employees[$e["Employeeid"]]["FirstName"]);
					 echo($Employees[$e["Employeeid"]]["LastName"] . ", " . $Employees[$e["Employeeid"]]["FirstName"] . " " .  $Employees[$e["Employeeid"]]["MiddleName"]) ?></td>
				 </tr>
				 <tr>
					 <td><b>Directorate</b></td>
					 <td>: <?php 
					 
					 if(isset($Department[$Employees[$e["Employeeid"]]["DeptAssignment"]]))
						 echo($Department[$Employees[$e["Employeeid"]]["DeptAssignment"]]["DeptCode"]);
					 ?></td>
				 </tr>
			 </table>
			 <div>
			 <!-- <div style="padding-right:70px;"> -->
			   <table class="table tabular" id="fordtr" >
				 <thead>
					 <tr>
						 <th class="text-center" colspan="7"><?php
						 $from_date_timestamp = strtotime($from_date);
						 $from_date_new_date = date('F Y', $from_date_timestamp); 
						 
						 echo("For the Month of " . $from_date_new_date) ?></th>
					 </tr>
				 <tr>
				   <th width="4%" rowspan="2" class="text-center">Day</th>
				   <th colspan="2" style="text-align:center;">AM</th>
				   <th colspan="2" style="text-align:center;">PM</th>
				   <th colspan="2" style="text-align:center;">OT</th>
				 </tr>
				 <tr>
					 <th width="15%" style="text-align:center;">IN</th>
					 <th width="15%" style="text-align:center;">OUT</th>
					 <th width="15%" style="text-align:center;">IN</th>
					 <th width="15%" style="text-align:center;">OUT</th>
					 <th width="15%" style="text-align:center;">IN</th>
					 <th width="15%" style="text-align:center;">OUT</th>
				 </tr>
				 </thead>
				 <tbody>
		 <?php
		 $i= 0;
		 $number_lates = 0;
		 $minutes_late = 0;
		 // dump($Attendance);
		 for ($i = 0; $i<sizeof($school); $i++)
		 {
			 if (isset($Attendance[$e["Employeeid"]][$school[$i]]))
			 {
				//  $number_lates = $number_lates + $Attendance[$e["Employeeid"]][$school[$i]]["number_lates"];
				//  $minutes_late = $minutes_late + $Attendance[$e["Employeeid"]][$school[$i]]["minutes_late"];
				 ?>
				 <tr>
				   <td class="text-center"><?php
				  $old_date_timestamp = strtotime($school[$i]);
				  $new_date = date('d', $old_date_timestamp); 
				 
				  $am_arrival_date = "";
				  $am_departure_date = "";
				  $pm_arrival_date = "";
				  $pm_departure_date = "";
				  $overtime_in = "";
				  $overtime_out = "";
				 //  if($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				 // if($Attendance[$e["Employeeid"]][$school[$i]]["max(AMDeparture)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				 // if($Attendance[$e["Employeeid"]][$school[$i]]["max(PMArrival)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				 // if($Attendance[$e["Employeeid"]][$school[$i]]["max(PMDeparture)"] == "")
				 //  	$am_arrival_date = date('h:i a',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i]));
				  
					 
				 $am_arrival_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMArrival)"] . ":00 " . $school[$i])) : "";
				  $am_departure_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(AMDeparture)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(AMDeparture)"] . ":00 " . $school[$i])) : "";
				  $pm_arrival_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(PMArrival)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(PMArrival)"] . ":00 " . $school[$i])) : "";
				  $pm_departure_date = $Attendance[$e["Employeeid"]][$school[$i]]["max(PMDeparture)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(PMDeparture)"] . ":00 " . $school[$i])) : "";
 

				  $overtime_in = $Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_in)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_in)"] . ":00 " . $school[$i])) : "";
				  $overtime_out = $Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_out)"] != "" ? date('h:iA',  strtotime($Attendance[$e["Employeeid"]][$school[$i]]["max(overtime_out)"] . ":00 " . $school[$i])) : "";

				  
				  $am_arrival_date = rtrim($am_arrival_date, "M");
				  $am_departure_date = rtrim($am_departure_date, "M");
				  $pm_arrival_date = rtrim($pm_arrival_date, "M");
				  $pm_departure_date = rtrim($pm_departure_date, "M");
				  $overtime_in = rtrim($overtime_in, "M");
				  $overtime_out = rtrim($overtime_out, "M");
 
				 //  echo date('h:i:s a m/d/Y', strtotime($date));
				  echo($new_date) ?></td>
				   <td><?php echo($am_arrival_date) ?></td>
				   <td><?php echo($am_departure_date) ?></td>
				   <td><?php echo($pm_arrival_date) ?></td>
				   <td><?php echo($pm_departure_date) ?></td>
				   <td><?php echo($overtime_in) ?></td>
				   <td><?php echo($overtime_out) ?></td>
				 </tr>
				 
				 <?php
			 }
			 else
			 {
				 $old_date_timestamp = strtotime($school[$i]);
				 $new_date = date('d', $old_date_timestamp); 
 
				 $data = isweekend($school[$i]);
				 if($data == "false"):
				 ?>
				 <tr>
				 <td class="text-center"><?php 
				 echo($new_date) ?></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 <td></td>
				 </tr>
				 <?php
				 else:
				 ?>
				 <tr>
				 <td class="text-center"><?php echo($new_date) ?></td>
				 <td colspan="6"><b><?php echo($data); ?></b></td>
				 </tr>
				 <?php
				 endif;
			 }
		 }
		 ?>
		  </tfoot>
			   </table>
	 </div>
		 <div class="row">
			 <div class="col-xs-6">
				 <p style="font-size:11px;"># of Lates : <?php echo($number_lates); ?></p>
			 </div>
			 <div class="col-xs-6">
				 <p style="font-size:11px;">Minutes of Lates : <?php echo($minutes_late); ?></p>
			 </div>
		 </div>
		 <p class="text-justify" style="font-size:11px;">I certify on my honor that the above is a true and correct
		 report of the hours of work performed, record of which was made daily at the time of arrival
		 and departure from office.</p>
		 <div class="row">
			 <div class="col-md-8 col-xs-8 col-sm-8">
			 <p style="font-size:11px; font-weight: 600; margin-top: 40; border-top: 2px solid black;"> Signature of the Employee</p>
			 <p style="font-size:11px; font-weight: 600; margin-top: 55px; border-top: 2px solid black;"> Signature of the Office-in-charge</span>
			 </div>
			 <div class="col-md-4 col-xs-4 col-sm-4">
				 <img style="margin-top:40;" class="pull-right" src="data:image/png;base64,<?php echo base64_encode($qrImage) ?>" width="80" height="80"/>
			 </div>
		 </div>
		 <br>
		   <p style="font-size: 7px;"><i>This report is computer generated by the HRMIS v2.0</i></p>
		   <p style="font-size: 7px;"><i>Copyright: CHRMO / CADO -IT</i></p>
			 </div>
			 <!-- /.box-body -->
		   </div>
		   
   </div>


		 <?php } ?>
 <?php endforeach; ?>
 <script>
 $(".select2").select2();
 </script>
