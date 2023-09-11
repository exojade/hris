<?php   
// dump($_REQUEST);
    include('apps/attendance/attendance_app/attendance_functions.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        
        if($_POST["action"] == "pchgea_employees"):
            $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = 10;
            $search = $_POST["search"]["value"];
            $where = " where active_status = 1 and JobType in ('PERMANENT', 'COTERMINOUS')";
            $sql = query("select * from tblemployee" . $where);
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
                $query_string = "select * from tblemployee ". $where . "
                                order by LastName ASC
                                    limit ".$limit." offset ".$offset." ";
                $employees = query($query_string);
            }
            else{
                $query_string = "
                    select * from tblemployee
                    ".$where." and
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
                        ".$where." and 
                        concat(LastName, ', ', FirstName) like '%".$search."%' or
                        concat(FirstName, ' ', LastName) like '%".$search."%' or
                        Fingerid like '%".$search."%' or 
                        HRID like '%".$search."%'
                        order by LastName ASC
                ";
                $all_employees = query($query_string);
            }
            $i=0;

            $settings = query("select * from tbl_settings");
            $settings = $settings[0];

            foreach($employees as $row):
                $employees[$i]["dues"] = 0;
                $employees[$i]["burial"] = 0;
                if($row["pchgea_dues"] != "INACTIVE"):
                    $employees[$i]["dues"] = $settings["pchgea_dues"];
                endif;
                if($row["pchgea_burial"] != "INACTIVE"):
                    $employees[$i]["burial"] = $settings["pchgea_burial"];
                endif;
                
                $employees[$i]["name"] = "<a href='#' data-id='".$row["Employeeid"]."' data-toggle='modal' data-target='#modal_pchgea'>".$row["LastName"] . ", " . $row["FirstName"] . "</a>";
                $employees[$i]["biometric_id"] = $row["Fingerid"];
                $employees[$i]["hr_id"] = $row["HRID"];
                $employees[$i]["department"] = "";
                if($row["Deptid"] != "")
                $employees[$i]["department"] = $employees[$i]["department"] . $Department[$row["Deptid"]]["DeptCode"];
           

                if($row["DeptAssignment"] != "")
                $employees[$i]["department"] = $employees[$i]["department"] . " | " . $Department[$row["DeptAssignment"]]["DeptCode"];
              

                

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

        elseif($_POST["action"] == "modal_pchgea"):
            $employee = query("select pchgea_dues, pchgea_burial, Employeeid from tblemployee where Employeeid = ?", $_POST["employee_id"]);
            $echo = '
            <input type="hidden" name="employee_id" value="'.$_POST["employee_id"].'"> 
            <div class="form-group">
                <label>PCHGEA Monthly Dues</label>
                <select class="form-control" name="monthly_dues">
                    <option value="'.$employee[0]["pchgea_dues"].'">'.$employee[0]["pchgea_dues"].'</option>
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                </select>
            </div>
            <div class="form-group">
                <label>PCHGEA Burial Assistance</label>
                <select class="form-control" name="burial">
                    <option value="'.$employee[0]["pchgea_burial"].'">'.$employee[0]["pchgea_burial"].'</option>
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                </select>
            </div>
            ';
            echo($echo);
            
        elseif($_POST["action"] == "save_pchgea_settings"):
           query("update tblemployee set pchgea_dues = ?, pchgea_burial = ?
                    where Employeeid = ?", $_POST["monthly_dues"], $_POST["burial"], $_POST["employee_id"]);
            $res_arr = [
                "message" => "Successfully Processed",
                "status" => "success",
                "link" => "pchgea",
                ];
                echo json_encode($res_arr); exit();
        elseif($_POST["action"] == "save_burial"):
            $month_full = date('F', strtotime(date("Y-".$_POST["month"] . "-d")));
            $settings = query("select * from tbl_settings");
            $burial_id = create_uuid("PBUR");
            if (query("insert into pchgea_burial (burial_id,month,year,amount_fee,dependents,month_name) 
				VALUES(?,?,?,?,?,?)", 
				$burial_id,$_POST["month"],
                $_POST["year"],$settings[0]["pchgea_burial"],
                $_POST["dependents"],$month_full) === false)
				{
					dump("error");
				}
                $res_arr = [
                    "message" => "Successfully Processed",
                    "status" => "success",
                    "link" => "pchgea?action=pchgea_burial",
                    ];
                    echo json_encode($res_arr); exit();
            
            
        endif;
    }
    else
    {

        if(isset($_GET["action"])):
            if($_GET["action"] == "pchgea_burial"):
                $burial = query("select * from pchgea_burial order by year desc, month desc");
                render("apps/payroll/pchgea_app/pchgea_burial.php", 
                [
                    "title" => "Loans Management", 
                    "burial" => $burial, 
                ],"payroll");
            elseif($_GET["action"] == "mandatory_employee"):
                    $employee = query("select Employeeid, Fingerid, concat(LastName, ', ', FirstName, ' ' , NameExtension) as name from tblemployee
                                        where Employeeid = ?", $_GET["id"]);
                    $employee = $employee[0];
                    $mandatory = query("select * from employee_mandatory where employee_id = ?", $_GET["id"]);
                    $mandatory = $mandatory[0];
                    render("apps/payroll/mandatory_deductions_app/mandatory_employee.php", 
                    [
                        "title" => "Mandatory Employee", 
                        "employee" => $employee, 
                        "mandatory" => $mandatory, 
                
                    ],"payroll");
            endif;
        else:
            render("apps/payroll/pchgea_app/pchgea_list.php", 
                ["title" => "PCHGEA LIST",],"payroll");

        endif;
       


        
    }
?>