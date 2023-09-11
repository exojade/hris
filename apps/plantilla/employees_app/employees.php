<?php   
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        if($_POST["action"] == "datatable"):
            

            // print_r($_REQUEST);
            $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = 10;
            $search = $_POST["search"]["value"];
            $sql = query("select * from tblemployee");
            $department = query("select * from tbldepartment");
            $Department = [];
            foreach($department as $d):
                $Department[$d["Deptid"]] = $d;
            endforeach;
            $position = query("select * from tblposition");
            $Position = [];
            foreach($position as $p):
                $Position[$p["Positionid"]] = $p;
            endforeach;
            $all_employees = $sql;
            if($search == ""){
                $query_string = "select * from tblemployee
                                order by LastName ASC
                                    limit ".$limit." offset ".$offset." ";
                $employees = query($query_string);
            }
            else{
                $query_string = "
                    select * from tblemployee
                    where 
                    concat(LastName, ', ', FirstName) like '%".$search."%' or
                    concat(FirstName, ' ', LastName) like '%".$search."%' or
                    Fingerid like '%".$search."%' or 
                    HRID like '%".$search."%'
                    order by LastName ASC
                    limit ".$limit." offset ".$offset."
                ";
                $employees = query($query_string);
                $query_string = "
                        select * from tblemployee
                        where 
                        concat(LastName, ', ', FirstName) like '%".$search."%' or
                        concat(FirstName, ' ', LastName) like '%".$search."%' or
                        Fingerid like '%".$search."%' or 
                        HRID like '%".$search."%'
                        order by LastName ASC
                ";
                $all_employees = query($query_string);
            }
            $i=0;
            foreach($employees as $row):
                // $employees[$i]["action"] = '
                // <div class="btn-group">
                //   <button type="button" class="btn btn-default btn-flat" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" style="margin-right: 20px;"></i><i class="fa fa-caret-down"></i></button>
                //   <ul class="dropdown-menu" role="menu">
                //     <li><a href="employees?employee_id='.$row["Employeeid"].'&action=information">Information</a></li>
                //     <li><a href="viewemployee?id='.$row["Employeeid"].'">Schedule</a></li>
                //   </ul>
                // </div>';



                $employees[$i]["action"] = '
                <a data-id="'.$row["Employeeid"].'" data-toggle="modal" data-target="#modal_edit_employees" class="btn btn-flat btn-warning"><i class="fas fa-edit"></i></a>
                <a href="employees?employee_id='.$row["Employeeid"].'&action=information"" class="btn btn-flat btn-success"><i class="fa fa-eye"></i></a>
                <a data-id="'.$row["Employeeid"].'" data-toggle="modal" data-target="#modal_update_payroll" class="btn btn-flat btn-info"><i class="fas fa-money-bill"></i></a>
                
                ';
            
            //   $bids[$i]["Title"] = "<a href='#' data-toggle='modal' data-id='".$row['ReferenceNumber']."' data-target='#modal-specific-bids'>".$row["Title"]."</a>";
            
                $employees[$i]["name"] = $row["LastName"] . ", " . $row["FirstName"];
                $employees[$i]["biometric_id"] = $row["Fingerid"];
                $employees[$i]["hr_id"] = $row["HRID"];
                if($row["Deptid"] != "")
                $employees[$i]["department"] = $Department[$row["Deptid"]]["DeptCode"];
                else
                $employees[$i]["department"] = "-";

                if($row["DeptAssignment"] != "")
                $employees[$i]["department_assigned"] = $Department[$row["DeptAssignment"]]["DeptCode"];
                else
                $employees[$i]["department_assigned"] = "-";

                if($row["Positionid"] != "")
                $employees[$i]["position"] = $Position[$row["Positionid"]]["PositionName"];
                else
                $employees[$i]["position"] = "-";


                if($row["active_status"] == 0)
                    $employees[$i]["active_status"] = '<p class="bg-red text-center" style="padding:5px;">NOT ACTIVE</p>';
                else
                    $employees[$i]["active_status"] = '<p class="bg-green text-center" style="padding:5px;">ACTIVE</p>';


                $i++;
            endforeach;
   
            $json_data = array(
                "draw" => $draw + 1,
                "iTotalRecords" => count($all_employees),
                "iTotalDisplayRecords" => count($all_employees),
                "aaData" => $employees
            );
            echo json_encode($json_data);

        elseif($_POST["action"] == "modal_edit_employees"):

            
            // dump($_POST);

            $department = query("select * from tbldepartment");
            $group = query("select * from tbl_group");

            $position = query("select * from tblposition");

            $employees = query("select * from tblemployee where Employeeid = ?", $_POST["employee_id"]);
            // dump($employees);
            $e = $employees[0];
            // dump($e["Gender"]);
            $hint = '
            <input type="hidden" name="action" value="edit_employee">
            <input type="hidden" name="employee_id" value="'.$_POST["employee_id"].'">
                  <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Biometric Number</label>
                      <input required value="'.$e["Fingerid"].'" name="biometric_number" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Active Status</label>
                      <select name="active_status" required class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="'.$e["active_status"].'">'.$e["active_status"].'</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Birth Date</label>
                      <input value="'.$e["BirthDate"].'" name="birthdate" type="date" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>First Name</label>
                      <input required value="'.$e["FirstName"].'" name="first_name" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input required value="'.$e["LastName"].'" name="last_name" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input value="'.$e["MiddleName"].'" name="middle_name" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Suffix</label>
                      <input value="'.$e["NameExtension"].'" name="suffix" type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">';
                                
                                if(!empty($e["Gender"])){
                                    $hint = $hint . '<option value="'.$e["Gender"].'">'.$e["Gender"].'</option>';
                                }    
                                else{
                                    $hint = $hint . '<option value="" selected disabled>Please select Gender</option>';
                                }
                                $hint = $hint .'<option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Department Asssign</label>
                        <select name="department" required class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled value="">Please Select Department</option>
                ';
               foreach($department as $d): 

                if($d["Deptid"] == $e["DeptAssignment"]){
                    $hint = $hint . '<option selected value="'.$d["Deptid"].'">'.$d["DeptCode"] . " - " . $d["DeptName"].'</option>';
                }
                else{
                    $hint = $hint . '<option value="'.$d["Deptid"].'">'.$d["DeptCode"] . " - " . $d["DeptName"].'</option>';
                }
                endforeach;
                $hint = $hint . '
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Department Fund</label>
                        <select name="department_fund" required class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled value="">Please Select Department</option>
                ';
               foreach($department as $d): 

                if($d["Deptid"] == $e["Deptid"]){
                    $hint = $hint . '<option selected value="'.$d["Deptid"].'">'.$d["DeptCode"] . " - " . $d["DeptName"].'</option>';
                }
                else{
                    $hint = $hint . '<option value="'.$d["Deptid"].'">'.$d["DeptCode"] . " - " . $d["DeptName"].'</option>';
                }
                endforeach;
                $hint = $hint . '
                        </select>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Group</label>
                        <select name="group" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="">Please select Group</option>';
                foreach($group as $g):

                    if($g["group_id"] == $e["GroupName"]){
                        $hint = $hint . '<option selected value="'.$g["group_id"].'">'.$g["group_name"].'</option>';
                    }
                    else{
                        $hint = $hint . '<option value="'.$g["group_id"].'">'.$g["group_name"].'</option>';
                    }
                endforeach;
                
                $hint = $hint . '
                   
                        </select>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Print Remarks</label>
                        <select name="print_remarks" class="form-control select2" style="width: 100%;">
                            <option selected value="'.$e["print_remarks"].'">'.$e["print_remarks"].'</option>
                            <option value="DTR">DTR</option>
                            <option value="TIMESHEET">TIMESHEET</option>
                            <option value="BOTH">BOTH</option>
                            <option value="NONE">NONE</option>
                            ';
                $hint = $hint . '
                        </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Employment Status</label>
                        <select required name="employment" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="'.$e["JobType"].'">'.$e["JobType"].'</option>
                            <option value="JOB ORDER">JOB ORDER</option>
                            <option value="HONORARIUM">HONORARIUM</option>
                            <option value="CASUAL">CASUAL</option>
                            <option value="COTERMINOUS">COTERMINOUS</option>
                            <option value="ELECTIVE">ELECTIVE</option>
                            <option value="PERMANENT">PERMANENT</option>
                        </select>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Position</label>
                        <select name="position" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="">Please select Position</option>';
                            foreach($position as $p):
                                if($p["Positionid"] == $e["Positionid"]){
                                    $hint = $hint . '<option selected value="'.$p["Positionid"].'">'.$p["PositionName"].'</option>';
                                }
                                else{
                                    $hint = $hint . '<option value="'.$p["Positionid"].'">'.$p["PositionName"].'</option>';
                                }
                            endforeach;
                            $hint = $hint . '
                        </select>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Original Appointment</label>
                        <input value="'.$e["original_appointment"].'" name="original_appointment" type="date" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Date Started</label>
                        <input value="'.$e["date_started"].'" name="date_started" type="date" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Latest Promotion</label>
                        <input value="'.$e["last_promotion"].'" name="last_promotion" type="date" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                </div>
                <script>
                $(".select2").select2()
                </script>
            ';
            echo($hint);
            elseif($_POST["action"] == "modal_update_payroll"):
                // dump($_POST);
            $employees = query("select payroll_method,JobType, salary_class, salary_grade, salary, salary_step, lbp_number, sss_personal, hdmf_personal, witholding_tax from tblemployee where Employeeid = ?", $_POST["employee_id"]);
            $e = $employees[0];
            if($e["JobType"] == "PERMANENT" || $e["JobType"] == "COTERMINOUS" || $e["JobType"] == "CASUAL" || $e["JobType"] == "ELECTIVE"){
            // dump($e);
            $salary_scheds = query("select * from tbl_salary_sched");
            $hint = '
            <input type="hidden" name="action" value="update_payroll_employee">
            <input type="hidden" name="employee_id" value="'.$_POST["employee_id"].'">
            <input type="hidden" name="options" value="not_jo">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Salary Grade</label>
                      <input required value="'.$e["salary_grade"].'" name="salary_grade" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Salary Step</label>
                      <input required value="'.$e["salary_step"].'" name="salary_step" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-md-12">
                  <div class="form-group">
                  <label>Salary Class</label>
                  <input required value="'.$e["salary_class"].'" name="salary_class" type="text" class="form-control" placeholder="Enter ...">
                </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Payroll Method</label>
                  <select class="form-control" name="payroll_method">
                    <option value="'.$e["payroll_method"].'">'.$e["payroll_method"].'</option>
                    <option value="ATM">ATM</option>
                    <option value="ATM">OVER-THE-COUNTER</option>
                  </select>
                </div>
                  </div>
                
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Land Bank Account Number (for PACS)</label>
                  <input required value="'.$e["lbp_number"].'" name="lbp_number" type="number" class="form-control" placeholder="Enter ...">
                </div>
                  </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Witholding Tax</label>
                            <input step=0.01 value="'.$e["witholding_tax"].'" name="wtax" type="number" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SSS Personal</label>
                            <input step=0.01 value="'.$e["sss_personal"].'" name="sss_personal" type="number" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>HDMF Personal </label>
                            <input step=0.01 value="'.$e["hdmf_personal"].'" name="hdmf_personal" type="number" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>HDMF MP2</label>
                            <input step=0.01 value="'.$e["hdmf_mp2"].'" name="hdmf_mp2" type="number" class="form-control" placeholder="Enter ...">
                        </div>
                    </div>
                </div>
            <script>';

            if($payroll_settings != ""){
                if($gsis_government != 0)
                $hint = $hint . '$("#gsis_gov").prop("checked", true);';
                if($phic_government != 0)
                $hint = $hint . '$("#phic_gov").prop("checked", true);';
                if($phic_personal != 0)
                $hint = $hint . '$("#phic_personal").prop("checked", true);';
                if($hdmf_government != 0)
                $hint = $hint . '$("#hdmf_government").prop("checked", true);';
            }

            // $(".ios8-switch").prop("checked", true);

            $hint = $hint . '
            </script>
                
                ';
            }

            else if($e["JobType"] == "JOB ORDER" || $e["JobType"] == "HONORARIUM"){
                $hint = '
            <input type="hidden" name="action" value="update_payroll_employee">
            <input type="hidden" name="employee_id" value="'.$_POST["employee_id"].'">
            <input type="hidden" name="options" value="jo">
            <div class="box-body">
            
           
                <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                  <label>Salary</label>
                <input required value="'.$e["salary"].'" name="salary" type="number" step="0.01" class="form-control" placeholder="---">
                </div>
                </div>
                 

                  <div class="col-md-12">
                  <div class="form-group">
                  <label>Land Bank Account Number (for PACS)</label>
                  <input value="'.$e["lbp_number"].'" name="lbp_number" type="number" class="form-control" placeholder="Enter ...">
                </div>
                  </div>
                </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>HDMF Personal </label>
                        <input step=0.01 value="'.$e["hdmf_personal"].'" name="hdmf_personal" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>SSS Personal</label>
                        <input step=0.01 value="'.$e["sss_personal"].'" name="sss_personal" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Witholding Tax</label>
                        <input step=0.01 value="'.$e["witholding_tax"].'" name="wtax" type="number" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <script>';

            if($payroll_settings != ""){
                if($gsis_government != 0)
                $hint = $hint . '$("#gsis_gov").prop("checked", true);';
                if($phic_government != 0)
                $hint = $hint . '$("#phic_gov").prop("checked", true);';
                if($phic_personal != 0)
                $hint = $hint . '$("#phic_personal").prop("checked", true);';
                if($hdmf_government != 0)
                $hint = $hint . '$("#hdmf_government").prop("checked", true);';
            }

            // $(".ios8-switch").prop("checked", true);

            $hint = $hint . '
            </script>
                
                ';
            }
            echo($hint);

        endif;

 
      


    }
    else
    {

        // dump("yawa");

        if(isset($_GET["action"])):
         
        else:
            render("apps/plantilla/employees_app/employees_form.php", 
                ["title" => "Employees",],"plantilla");

        endif;
       


        
    }
?>