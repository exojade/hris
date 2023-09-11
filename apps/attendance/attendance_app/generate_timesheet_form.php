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


	table, th, td {
   border: 1px solid black !important;
}

#fordtr{font-size:13px;}
#fordtr td{padding: 0px !important; font-size: 12px !important;font-weight:800;}
#fordtr th{padding: 4px !important; font-size: 12px !important;}

.col-md-12{
	padding-left: 0px !important;
	padding-right: 0px !important;
}

p{
  margin:0px;
}

@media print
{
	.awit {page-break-after:always}
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
  background:  url("pdf/bgtimesheet.png");
  background-size: 1100px 600px;
  background-position: 0px 80px;
  background-repeat: no-repeat;
  opacity: 0.1;
}
</style>

<?php

// dump($_GET);

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

if($_GET["category"] == "department"){
	$department = query("select * from tbldepartment where Deptid = ?", $_GET["option"]);
	$string = "select Fingerid from tblemployee where DeptAssignment = '".$_GET["option"]."' and active_status = 1 and print_remarks in ('TIMESHEET', 'BOTH') order by LastName limit 20 offset ".$_GET["offset"]."";
	$employee = query($string);
	$employees = query("select * from tblemployee where DeptAssignment = ? and active_status = 1", $_GET["option"]);
	foreach($employees as $e):
		$Employees[$e["Fingerid"]] = $e;
	endforeach;
	foreach($employee as $e):
		array_push($the_employees, $e["Fingerid"]);
	endforeach;
	$string = implode('","', $the_employees);
	$where_in_employees = '"' . $string . '"';
}

if($_GET["category"] == "employee"){
	$string = "select Fingerid, DeptAssignment from tblemployee where Employeeid = '".$_GET["option"]."'";
	$employee = query($string);
	$department = query("select * from tbldepartment where Deptid = ?", $employee[0]["DeptAssignment"]);
	$employees = query("select * from tblemployee where Employeeid = ?", $_GET["option"]);
	foreach($employees as $e):
		$Employees[$e["Fingerid"]] = $e;
	endforeach;
	foreach($employee as $e):
		array_push($the_employees, $e["Fingerid"]);
	endforeach;
	$string = implode('","', $the_employees);
	$where_in_employees = '"' . $string . '"';
}

else if($_GET["category"] == "group"){
	// dump($_GET);
	$group = query("select * from tbl_group where group_id = ?", $_GET["option"]);
	$string = "select Fingerid from tblemployee where GroupName = '".$_GET["option"]."' and active_status = 1 order by LastName limit 50 offset ".$_GET["offset"]."";
	// $string = "select Fingerid from tblemployee where GroupName = '".$_GET["option"]."' and active_status = 1 order by LastName";
	$employee = query($string);
	// dump($employee);
	$employees = query("select * from tblemployee where GroupName = ? and active_status = 1", $_GET["option"]);
	foreach($employees as $e):
		$Employees[$e["Fingerid"]] = $e;
	endforeach;
	foreach($employee as $e):
		array_push($the_employees, $e["Fingerid"]);
	endforeach;
	$string = implode('","', $the_employees);
	$where_in_employees = '"' . $string . '"';
	// dump($_GET["option"]);
}
$Biologs = [];
$biologs = query("select * from tblbiologs where Fingerid IN (".$where_in_employees.") 
					and Date between ? and ?
					group by Date, Time", $_GET["from_date"], $_GET["to_date"]);
foreach($biologs as $b):
	$Biologs[$b["Fingerid"]][$b["Date"]][$b["Time"]] = $b;
endforeach;	
// dump($employee);
?>

<?php foreach($employee as $e): 
	$qrTempDir = 'file_folder/resources/';
	$filePath = $qrTempDir.'/'.uniqid();
	QRcode::png($Employees[$e["Fingerid"]]["Employeeid"], $filePath);
	$qrImage = file_get_contents($filePath);
	unlink($filePath);

	?>

	<?php if(isset($Biologs[$e["Fingerid"]])){
		 ?>

	<div style="page-break-before: always;">
		<div class="watermarked">
            <div class="box-body">
			<p class="text-center">TIMESHEET REPORT</p>
			<br>
			<p>EMP NAME: <?php
			$Employees[$e["Fingerid"]]["LastName"] = str_replace("?","Ñ",$Employees[$e["Fingerid"]]["LastName"]);
			$Employees[$e["Fingerid"]]["FirstName"] = str_replace("?","Ñ",$Employees[$e["Fingerid"]]["FirstName"]);
			echo($Employees[$e["Fingerid"]]["LastName"] . ", " . $Employees[$e["Fingerid"]]["FirstName"] . " (".$e["Fingerid"].")") ?> 
			<span class="pull-right">
			<?php
				if(isset($Department[$Employees[$e["Fingerid"]]["DeptAssignment"]]))
				echo($Department[$Employees[$e["Fingerid"]]["DeptAssignment"]]["DeptCode"] . " - " . $Department[$Employees[$e["Fingerid"]]["DeptAssignment"]]["DeptName"]);
			?>


			</span></p>
			<!-- <p>DIRECTORATE:</p> -->
              <table class="table" id="fordtr">
                <thead>
                <tr>
                  <th width="12%">Date</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                  <th>LOG</th>
                </tr>
                </thead>
                <tbody>
		<?php
		//
		$i= 0;
		$size = 18;
		for ($i = 0; $i<sizeof($school); $i++)
		{
			if (isset($Biologs[$e["Fingerid"]][$school[$i]]))
			{
				$the_size = sizeof($Biologs[$e["Fingerid"]][$school[$i]]);
				// dump($the_size);
				?>
				<tr>
                  <td><b><?php 
				 $old_date_timestamp = strtotime($school[$i]);
				 $new_date = date('F d, Y', $old_date_timestamp);  
				 
				 echo($new_date) ?></b></td>
				  <?php
				 	$extends = 0; 
				  foreach($Biologs[$e["Fingerid"]][$school[$i]] as $b):
					if($extends > 18)
					break;
					?>
					<td><?php
						$b["Time"] = date('h:ia', strtotime($b["Time"]));
						$b["Time"] = rtrim($b["Time"], "m");
						echo($b["Time"]) ?></td>
				  <?php
					$extends++;
				endforeach; ?>
				  <?php for ($k = $the_size; $k<=$size; $k++): ?>
					<td></td>
				  <?php endfor; ?>
                </tr>
				<?php
			}
			else
			{
				?>
				<tr>
				<td><b><?php
				$old_date_timestamp = strtotime($school[$i]);
				$new_date = date('F d, Y', $old_date_timestamp);  
				echo($new_date) ?></b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				</tr>
				<?php
				
			}
		}
		?>
		 </tfoot>
              </table>
		<div class="row">
			<div class="col-md-10 col-xs-10 col-sm-10">
			<p class="text-justify" style="line-height: 12px; font-size:12px; font-weight: 600;">I certify on my honor that the above is a true and correct
				report of the hours of work performed, record of which was made daily at the of arrival
				and departure from office</p>

			<span style="font-size:12px; font-weight: 600; margin-top: 25px; border-top: 2px solid black; display: inline-block;"> Signature of the Employee</span>
			<span class="pull-right" style="font-size:12px; font-weight: 600; margin-top: 25px; border-top: 2px solid black; display: inline-block;"> Signature of the Office-in-charge</span>
			
			<p style="margin-top: 5px; line-height: 12px; font-size:12px; font-weight: 600;"><i>This report is computer generated by the HRMIS v2.0</i></p>
		  	<p style="line-height: 12px; font-size:12px; font-weight: 600;"><i>Copyright: CHRMO / CADO -IT</i></p>
		
			</div>
			<div class="col-md-2 col-xs-2 col-sm-2">
				<img src="data:image/png;base64,<?php echo base64_encode($qrImage) ?>" width="95" height="95" class="pull-right"/>
			</div>
            </div>
            <!-- /.box-body -->
          </div>
  </div>

  <?php } ?>
<?php endforeach; ?>






<script>
$(".select2").select2();
</script>
