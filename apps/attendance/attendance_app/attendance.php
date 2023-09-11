<?php   

    include('apps/attendance/attendance_app/attendance_functions.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if($_POST["action"] == "process_attendance"):
            // dump($_POST);

        $from_date = $_POST["year_process"] . "-" . $_POST["month_process"] . "-" . "01";
        $to_date = date("Y-m-t", strtotime($from_date));

        $_POST["from_date"] = $from_date;
        $_POST["to_date"] = $to_date;

        // dump($to_date);

        if($from_date == "" || $to_date == ""){


            $res_arr = [
                "message" => "Please provide date to be processed",
                "status" => "error",
                "link" => "bio_logs",
                ];
                echo json_encode($res_arr); exit();

        }

        $Attendance = [];
        $string_query = "select * from tblbiologs where Date between '".$from_date."' and '".$to_date."' order by Date ASC, Time ASC";
$attendance = query($string_query);
// dump($string_query);
if(empty($attendance)){
    $res_arr = [
        "message" => "NO BIOLOGS TO BE PROCESSED",
        "status" => "failed",
        "link" => "bio_logs",
        ];
        echo json_encode($res_arr); exit();
}
$bio_id = query("select Fingerid from tblbiologs where Date between '".$from_date."' and '".$to_date."' group by Fingerid");
$Employees = [];
$employees = query("select * from tblemployee");
foreach($employees as $e):
    $Employees[$e["Fingerid"]] = $e;
endforeach;

// dump($Employees);


// $Dtras = [];
// $Dtras_Date = [];
// $dtras = query("select * from tblemployee_dtras");
// $dtras_date = query("select * from tblemployee_dtras_dates where date_info between ? and ? order by date_info ASC", $from_date, $to_date);
// foreach($dtras as $d):
// 	$Dtras[$d["dtras_id"]] = $d;
// endforeach;

// foreach($dtras_date as $d):
//     $fingerid = $Dtras[$d["dtras_id"]]["Fingerid"];
// 	$Dtras_Date[$fingerid][$d["date_info"]] = $d;
//     $Dtras_Date[$fingerid][$d["date_info"]]["Fingerid"] = $fingerid;
// 	$Dtras_Date[$fingerid][$d["date_info"]]["AMArrival"] = $Dtras[$d["dtras_id"]]["AMArrival"];
// 	$Dtras_Date[$fingerid][$d["date_info"]]["AMDeparture"] = $Dtras[$d["dtras_id"]]["AMDeparture"];
// 	$Dtras_Date[$fingerid][$d["date_info"]]["PMArrival"] = $Dtras[$d["dtras_id"]]["PMArrival"];
// 	$Dtras_Date[$fingerid][$d["date_info"]]["PMDeparture"] = $Dtras[$d["dtras_id"]]["PMDeparture"];
// endforeach;

// dump($Dtras_Date);

$Schedules = [];


$schedules = query("select * from employee_schedule");
foreach($schedules as $s):
    $Schedules[$s["Fingerid"]][$s["day"]] = $s;
endforeach;
// dump($Schedules);


//  dump($Schedules);
foreach($attendance as $a):
    $Attendance[$a["Fingerid"]][$a["Date"]][$a["Time"]] = $a;
endforeach;
// dump($Attendance);

//time regular
$am_in = "08:00";
$am_limit = "10:00";
$am_out = "12:00";
$am_out_limit = "12:30";
$pm_in = "13:00";
$pm_out = "17:00";
$pm_in_limit = "15:00";

$sample_time_array = [];
$employee_involved = [];
// dump($Attendance[$a["Fingerid"]]);
foreach($bio_id as $b):
    array_push($employee_involved, $b);
    foreach($Attendance[$b["Fingerid"]] as $value => $a):
        if(isset($Schedules[$b["Fingerid"]])):
            $FixedAttendance = schedule($Schedules[$b["Fingerid"]], $a);
        else:
            $FixedAttendance = regular_schedule($a);
        endif;




            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["Fingerid"] = $b["Fingerid"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["Date"] = $FixedAttendance[0]["date"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["time_in_am"] = $FixedAttendance[0]["time_in_am"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["time_out_am"] = $FixedAttendance[0]["time_out_am"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["time_in_pm"] = $FixedAttendance[0]["time_in_pm"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["time_out_pm"] = $FixedAttendance[0]["time_out_pm"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["overtime_in"] = $FixedAttendance[0]["overtime_in"];
            $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["overtime_out"] = $FixedAttendance[0]["overtime_out"];
            // $sample_time_array[$finger_id][$date]["overtime_in"] = $overtime_in;
            // $sample_time_array[$finger_id][$date]["overtime_out"] = $overtime_out;
        //     if($time_in_am != ""){
        //         if($time_in_am > "08:00"){
        //             $number_lates++;
        //             $minutes_lates = $minutes_lates + get_minutes_difference("08:00", $time_in_am, $date);
        //         }
        //     }

        //     if($time_out_am != ""){
        //         if($time_out_am < "12:00"){
        //             $number_lates++;
        //             $minutes_lates = $minutes_lates + get_minutes_difference("12:00", $time_out_am, $date);
        //         }
        //     }

        //     if($time_in_pm != ""){
        //         if($time_in_pm > "13:00"){
        //             $number_lates++;
        //             $minutes_lates = $minutes_lates + get_minutes_difference("13:00", $time_in_pm, $date);
        //         }
        //     }

        //     if($time_out_pm != ""){
        //         if($time_out_pm < "17:00"){
        //             $number_lates++;
        //             $minutes_lates = $minutes_lates + get_minutes_difference("17:00", $time_out_pm, $date);
        //         }
        //     }
        $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["number_lates"] = $FixedAttendance[0]["number_lates"];
        $sample_time_array[$b["Fingerid"]][$FixedAttendance[0]["date"]]["minutes_lates"] = $FixedAttendance[0]["minutes_lates"];
    endforeach;
endforeach;

// dump($sample_time_array);

$inserts = array();
$queryFormat = '("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")';
foreach($employee_involved as $e):
    foreach($sample_time_array[$e["Fingerid"]] as $s):
        if(isset($Employees[$s["Fingerid"]])){
            $inserts[] = sprintf( $queryFormat, $Employees[$s["Fingerid"]]["Employeeid"], $s["Date"], $s["time_in_am"], $s["time_out_am"] , $s["time_in_pm"], $s["time_out_pm"], 
                        $s["overtime_in"],$s["overtime_out"],
            $Employees[$s["Fingerid"]]["DeptAssignment"], $Employees[$s["Fingerid"]]["print_remarks"], $Employees[$s["Fingerid"]]["JobType"], $Employees[$s["Fingerid"]]["LastName"], $Employees[$s["Fingerid"]]["FirstName"], $s["Fingerid"],
            $s["number_lates"],$s["minutes_lates"]
        );
        }
    endforeach;
endforeach;

$query = implode( ",", $inserts );
query("delete from tblattendance where Date between '".$from_date."' and '".$to_date."'");
query('insert into tblattendance(Employeeid, Date, AMArrival, AMDeparture, PMArrival, PMDeparture, overtime_in, overtime_out,DeptAssignment, print_remarks, JobType, LastName, FirstName, Fingerid, number_lates, minutes_late) VALUES '.$query);
// query('insert into tblattendance(Employeeid, Date, AMArrival, AMDeparture, PMArrival, PMDeparture,DeptAssignment, print_remarks, JobType, LastName, FirstName, Fingerid, number_lates, minutes_late) VALUES '.$query);




$inserts = array();
        $queryFormat = '("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")';
        $Dtras = [];
        $dtras = query("select * from tblemployee_dtras d
                        left join tblemployee_dtras_dates dd
                        on dd.dtras_id = d.dtras_id
                        where dd.date_info between ? and ?
                        ", $_POST["from_date"], $_POST["to_date"]);
        foreach($dtras as $d):
            $Dtras[$d["employee_id"]][$d["date_info"]] = $d;
        endforeach;


        $Attendance = [];
        $attendance = query("select * from tblattendance where Date between ? and ?", $_POST["from_date"], $_POST["to_date"]);
        foreach($attendance as $a):
            $Attendance[$a["Employeeid"]][$a["Date"]] = $a;
        endforeach;

        $for_delete = [];

        foreach($dtras as $d):
            if(isset($Attendance[$d["employee_id"]][$d["date_info"]])){

                $attendance = $Attendance[$d["employee_id"]][$d["date_info"]];
                $AMArrival = $d["AMArrival"] != "" ? $d["AMArrival"] : $attendance["AMArrival"];
                $AMDeparture = $d["AMDeparture"] != "" ? $d["AMDeparture"] : $attendance["AMDeparture"];
                $PMArrival = $d["PMArrival"] != "" ? $d["PMArrival"] : $attendance["PMArrival"];
                $PMDeparture = $d["PMDeparture"] != "" ? $d["PMDeparture"] : $attendance["PMDeparture"];
                
                $minutes_late =  $attendance["minutes_late"];
                $number_lates =  $attendance["number_lates"];
                // dump($PMDeparture);
                // if()

                $print_remarks = $Employees[$d["Fingerid"]]["print_remarks"];
                $dept_assignment = $Employees[$d["Fingerid"]]["DeptAssignment"];
                $job_type = $Employees[$d["Fingerid"]]["JobType"];
                $lastname = $Employees[$d["Fingerid"]]["LastName"];
                $firstname = $Employees[$d["Fingerid"]]["FirstName"];

                $for_delete[] = $Attendance[$d["employee_id"]][$d["date_info"]]["Attendanceid"];
                $inserts[] = sprintf( $queryFormat, $d["employee_id"], $d["date_info"], $AMArrival, $AMDeparture, $PMArrival, 
                $PMDeparture, $print_remarks, $dept_assignment, $job_type, $lastname, $firstname, $d["Fingerid"], $minutes_late, $number_lates);
            }
            else{

                $print_remarks = $Employees[$d["Fingerid"]]["print_remarks"];
                $dept_assignment = $Employees[$d["Fingerid"]]["DeptAssignment"];
                $job_type = $Employees[$d["Fingerid"]]["JobType"];
                $lastname = $Employees[$d["Fingerid"]]["LastName"];
                $firstname = $Employees[$d["Fingerid"]]["FirstName"];

                $AMArrival = $d["AMArrival"];
                $AMDeparture = $d["AMDeparture"];
                $PMArrival = $d["PMArrival"];
                $PMDeparture = $d["PMDeparture"];
                $inserts[] = sprintf( $queryFormat, $d["employee_id"], $d["date_info"], $AMArrival, $AMDeparture, $PMArrival, $PMDeparture, $print_remarks, 
                $dept_assignment, $job_type, $lastname, $firstname, $d["Fingerid"], $minutes_late, $number_lates);
            }
        endforeach;
        if(!empty($dtras)){
            $for_delete = "'" . implode("','", $for_delete) . "'";
            query("delete from tblattendance where Attendanceid in (".$for_delete.")");
    
            $query = implode( ",", $inserts );
            query('insert into tblattendance(Employeeid, Date, AMArrival, AMDeparture, PMArrival, PMDeparture, print_remarks, DeptAssignment, JobType, LastName, FirstName, Fingerid, number_lates, minutes_late) VALUES '.$query);
        }

        $res_arr = [
            "message" => "Successfully Processed",
            "status" => "success",
            "link" => "attendance",
            ];
            echo json_encode($res_arr); exit();
 
        elseif($_POST["action"] == "upload_bio"):
        $total_count = count($_FILES['logzips']['name']);
        for( $i=0 ; $i < $total_count ; $i++ ) {
            $filename = $_FILES["logzips"]["name"][$i];
            $source = $_FILES["logzips"]["tmp_name"][$i];
            $type = $_FILES["logzips"]["type"][$i];

            $name = explode(".", $filename);
            $rect = 0;
            $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed', 'application/octet-stream');
            foreach($accepted_types as $mime_type) {
                if($mime_type == $type) {
                    $rect = 1;
                    break;
                }
            }
            if ($rect != 1){
                $res_arr = [
                    "message" => "Must upload zip or .dat file for required DTR Logs",
                    "status" => "failed",
                    ];
                    echo json_encode($res_arr); exit();
            }
            if ($type=='application/octet-stream')
            {
                $target = "file_folder/attlogs/";
                $target = $target . basename( $_FILES['logzips']['name'][$i]);
                // dump($_FILES['logzips']['name']);
                if(move_uploaded_file($_FILES['logzips']['tmp_name'][$i], $target))
                     { 
                     copy($target, $target);
                        
                     }
            $bool = consolidate_attendance($_FILES['logzips']['name'][$i]);
            // $bool = 1;
            if($bool == 0){
                $res_arr = [
                    "message" => $_FILES['logzips']['name'][$i] . " is problematic",
                    "status" => "error",
                    "link" => "attendance",
                    ];
                    echo json_encode($res_arr); exit();
            }
            }
         }

         $res_arr = [
            "message" => "Successfully Uploaded and converted to RAW Attendance Data",
            "status" => "success",
            "link" => "attendance",
            ];
            echo json_encode($res_arr); exit();
        
            elseif($_POST["action"] == "fetch_option"):
                // dump($_POST);
        
        
                if($_POST["selected_option"] == "department"){
                    $department = query("select Deptid as option_id, concat(DeptCode, ' - ', DeptName) AS option_name from tbldepartment");
                    $res_arr = [
                        "option" => $department,
                        "status" => "success",
                        ];
                        echo json_encode($res_arr); exit();
                }
        
                if($_POST["selected_option"] == "group"){
                    $group = query("select group_id as option_id, concat(group_name) AS option_name from tbl_group");
                    $res_arr = [
                        "option" => $group,
                        "status" => "success",
                        ];
                        echo json_encode($res_arr); exit();
                }
                else{

                }

        elseif($_POST["action"] == "print_attendance"):

            
                    // dump($_POST);
                    $report = $_POST["report"];
                    $from_date = $_POST["from_date"];
                    $to_date = $_POST["to_date"];
                    $report = $_POST["report"];
                    $sql = query("select * from site_options");
                    $url = $sql[0]["new_site_url"];

                    if($_POST["category"] == "department"){
                        $dep = query("select * from tbldepartment where Deptid = ?", $_POST["option"]);
                        if($_POST["emp_status"] == 0):
                            $counter = query("select Employeeid from tblattendance where DeptAssignment = '".$_POST["option"]."' and print_remarks in ('DTR', 'BOTH') group by Employeeid order by LastName ASC, FirstName ASC ");
                        elseif($_POST["emp_status"] == 1):
                            $counter = query("select Employeeid from tblattendance where DeptAssignment = '".$_POST["option"]."' and print_remarks in ('DTR', 'BOTH') and JobType in ('PERMANENT','COTERMINOUS') group by Employeeid order by LastName ASC, FirstName ASC ");
                        elseif($_POST["emp_status"] == 2):
                            $counter = query("select Employeeid from tblattendance where DeptAssignment = '".$_POST["option"]."' and print_remarks in ('DTR', 'BOTH') and JobType in ('CASUAL','JOB ORDER', 'HONORARIUM') group by Employeeid order by LastName ASC, FirstName ASC ");
                        endif;

                        $the_filename = $dep[0]["DeptCode"];
                        $counter = count($counter);
                    }

                   

                    else if ($_POST["category"] == "employee"){
                        $counter = query("select count(Employeeid) as count, DeptAssignment, LastName, FirstName from tblemployee where Employeeid = ?", $_POST["option"]);
                        $dep = query("select * from tbldepartment where Deptid = ?", $counter[0]["DeptAssignment"]);
                        $the_filename = $counter[0]["LastName"]."_".$counter[0]["FirstName"]."_".$dep[0]["DeptCode"]."_IND";
                        $counter = $counter[0]["count"];
                    }

                    else if($_POST["category"] == "group"){
                        $dep = query("select * from tbl_group where group_id = ?", $_POST["option"]);
                        $counter = query("select count(Employeeid) as count from tblemployee where GroupName = ? and active_status = 1 order by LastName", $_POST["option"]);
                        $the_filename = $dep[0]["group_name"]."_GR";
                        $counter = $counter[0]["count"];
                        // dump($counter);


                    }

                    // dump($counter);
                    $the_files = [];
                    try{
                        if($report == "dtr"){
                            // dump($_POST);
                            $the_filename = "DTR_".$the_filename;
                            $orientation = "P";
                            $offsetter=1;
                            while($counter >= 10){
                                $offsetter++;
                                $counter = $counter - 10;
                            }

                            // dump($offsetter);
                            for($i=0; $i<$offsetter;$i++){
                                $the_offset = $i * 10;
                                $webpath = $url . "/attendance?action=generate_dtr&emp_status=".$_POST["emp_status"]."&category=".$_POST["category"]."&option=".$_POST["option"]."&from_date=".$from_date."&to_date=".$to_date."&offset=".$the_offset;
                            //    dump($webpath);
                                $filename = "TEMPDTR-".$_POST["category"]."-".$from_date."-".$to_date."_".$the_offset;
                                $path = "file_folder/DTR/".$filename.".pdf";
                                $exec = '"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe" -L 1mm -B 1mm -T 1mm -R 1mm --disable-smart-shrinking --page-size A4 -O Portrait --image-quality 1 --dpi 72 "'.$webpath.'" '.$path.'';
                                // dump($exec);
                                // $origFile = 'book.pdf';
                                exec($exec);
                                $origFile = "file_folder/DTR/".$filename.".pdf";
                                array_push($the_files, $origFile);
                            }
                        }
                        else{
                            $the_filename = "TS_".$the_filename;
                            $orientation = "L";
                            $offsetter=1;
                            while($counter >= 50){
                                $offsetter++;
                                $counter = $counter - 50;
                            }
                            for($i=0; $i<$offsetter;$i++){
                                $the_offset = $i * 50;
                                $webpath = $url . "/attendance?action=generate_timesheet&emp_status=".$_POST["emp_status"]."&category=".$_POST["category"]."&option=".$_POST["option"]."&from_date=".$from_date."&to_date=".$to_date."&offset=".$the_offset;
                                // dump($webpath);
                                $filename = "TEMPTIMESHEET-".$_POST["category"]."-".$from_date."-".$to_date."_".$the_offset;
                                // dump($filename);
                                $path = "file_folder/DTR/".$filename.".pdf";
                                $exec = '"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe"  -L 3mm -B 3mm -T 3mm -R 3mm --disable-smart-shrinking --page-size A4 -O Landscape --image-quality 1 --dpi 72 "'.$webpath.'" '.$path.'';
                                // dump($exec);
                                exec($exec);
                                $origFile = "file_folder/DTR/".$filename.".pdf";
                                array_push($the_files, $origFile);
                            }
                        }

                        // dump($the_filename);
                        $job_type = "";
                        if($_POST["category"] == "department"){
                            $job_type = "ALL";
                            if($_POST["emp_status"] == "1"):
                                $job_type = "_PERM_COTI_ELECTIVE";
                            elseif($_POST["emp_status"] == "2"):
                                $job_type = "_CASUAL_JO_HON";
                            endif;
                        }
                        
                        
                        $from = strtotime($from_date);
                        $to = strtotime($to_date);
                        $from = date("F_d_Y", $from);
                        $to = date("F_d_Y", $to);
                        $the_filename = $the_filename . "_" . $from . "_" . $to; 
                        $destFile ="file_folder/DTR/".$the_filename . $job_type .".pdf";
                        $password = $dep[0]["passcode"];
                        $email = $dep[0]["email_address"];
                        // dump($password);
                        pdfEncrypt_array($the_files, $password, $destFile, $orientation);
                        // dump();
                        $activity = $_SESSION["hris"]["fullname"] . " generated " . $destFile;
                        $action = "GENERATE PDF";
                        add_log($activity, $action, $_SESSION["hris"]["employee_id"]);
                        $load[] = array('path'=>$destFile, 'filename' => $destFile, 'result' => 'success', 'email'=> $email);
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
                        //continue outer try block code
                     }
                     catch (Exception $e){
                        $load[] = array('result' => 'failed', 'message' => $e->getMessage());
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
                     }

        elseif($_POST["action"] == "google_drive"):
            
        if(!isset($_SESSION["hris"]["accessToken"])){

            $hint = "";
            $hint = $hint . "
            <a target='_blank' class='btn btn-primary' href='google_login'>Login To Google Drive</a>
            ";

            echo($hint);
        }

        else{
            // dump($_POST);
            $google->setAccessToken($_SESSION["hris"]['accessToken']);
            $service = new Google_Service_Drive($google);
            $site_options = query("select google_folder_id from site_options");
            $folderId = $site_options[0]["google_folder_id"];
            $sheetsList = $service->files->listFiles([
                'q' => "mimeType='application/vnd.google-apps.folder' and '".$folderId."' in parents and trashed=false",
                'fields' => 'nextPageToken, files(id, name)'
              ]);

              $hint = $hint . '
              <table class="table table-striped">';
             foreach($sheetsList as $sheet):
                $hint = $hint .'
                    <tr>
                    <td><div class="box-body box-profile">
                    <h5 class="profile-username">';
                    $hint = $hint . $sheet["name"]. '</h5>';
                    $hint = $hint . '</div></td><td>';
                    $hint = $hint . '<form class="generic_form_trigger" data-url="bio_logs">';
                    $hint = $hint . '
                    <input type="hidden" name="file_id" value="'.$sheet["id"].'">
                    <input type="hidden" name="action" value="upload_google_drive">
                    <input type="hidden" name="file_path" value="'.$_POST["file_name"].'">
                        <button type="submit" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-upload"></i></button>
                    </form>
                    </td>
                </tr>';
                    endforeach;
                $hint = $hint .'</table>';


                $hint = $hint . "
                <script>
                $('.generic_form_trigger').submit(function(e) {
                    e.preventDefault();
                    var url = $(this).data('url');
                      var promptmessage = 'This form will be submitted. Are you sure you want to continue?';
                      var prompttitle = 'Data submission';
                      e.preventDefault();
                      swal({
                          title: prompttitle,
                          text: promptmessage,
                          type: 'info',
                          showCancelButton: true,
                          confirmButtonText: 'Yes',
                          cancelButtonText: 'Cancel'
                      }).then((result) => {
                          if (result.value) {
                              swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
                          $.ajax({
                              type: 'post',
                              url: url,
                              data: $(this).serialize(),
                              success: function (results) {
                              var o = jQuery.parseJSON(results);
                              console.log(o);
                              if(o.result === 'success') {
                                  swal.close();
                               
                                  swal({title: 'Submit success',
                                  text: o.message,
                                  type:'success'})
                                  .then(function () {
                                  //window.location.replace('./applicant.php?page=list');
                                  window.location.replace(o.link);
                                  });
                              }
                              else {
                                  swal({
                                  title: 'Error!',
                                  text: o.message,
                                  type:'error'
                                  });
                                  console.log(results);
                              }
                              },
                              error: function(results) {
                              console.log(results);
                              swal('Error!', 'Unexpected error occur!', 'error');
                              }
                          });
                          // --- end of ajax
                          }
                      });
                  });
                </script>
                ";
            echo $hint;
        }

        

        endif;
      


    }
    else
    {

        if(isset($_GET["action"])):
            if($_GET["action"] == "generate_dtr"):
                renderview("apps/attendance/attendance_app/generate_dtr_form.php", 
                [
                ]);
            elseif($_GET["action"] == "generate_timesheet"):
                renderview("apps/attendance/attendance_app/generate_timesheet_form.php", 
                [
                ]);
            endif;
        else:
            render("apps/attendance/attendance_app/attendance_form.php", 
                ["title" => "Attendance",],"attendance");

        endif;
       


        
    }
?>