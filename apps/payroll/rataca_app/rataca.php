<?php   
// dump($_REQUEST);
    include('apps/attendance/attendance_app/attendance_functions.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        
        if($_POST["action"] == "rataca_employees"):
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
                $employees[$i]["representation_allowance"] = to_peso($employees[$i]["representation_allowance"]);
                $employees[$i]["travel_allowance"] = to_peso($employees[$i]["travel_allowance"]);
                $employees[$i]["communication_allowance"] = to_peso($employees[$i]["communication_allowance"]);
                $employees[$i]["name"] = "<a href='#' data-id='".$row["Employeeid"]."' data-toggle='modal' data-target='#modal_allowance'>".$row["LastName"] . ", " . $row["FirstName"] . "</a>";
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

        elseif($_POST["action"] == "modal_allowance"):
            $employee = query("select representation_allowance, 
                                travel_allowance, communication_allowance
                                from tblemployee where Employeeid = ?", $_POST["employee_id"]);
            $echo = '
            <input type="hidden" name="employee_id" value="'.$_POST["employee_id"].'"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Representation Allowance</label>
                <input value="'.$employee[0]["representation_allowance"].'" type="number" name="representation_allowance" step="0.01" class="form-control" placeholder="---">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Travel Allowance</label>
                <input value="'.$employee[0]["travel_allowance"].'" type="number" name="travel_allowance" step="0.01" class="form-control" placeholder="---">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Communication Allowance</label>
                <input value="'.$employee[0]["communication_allowance"].'" type="number" name="communication_allowance" step="0.01" class="form-control" placeholder="---">
            </div>
            
            ';
            echo($echo);
            
        elseif($_POST["action"] == "save_rataca_settings"):
            // dump($_POST);
           query("update tblemployee set representation_allowance = ?, 
                    travel_allowance = ?, communication_allowance = ?
                    where Employeeid = ?", 
                    $_POST["representation_allowance"], $_POST["travel_allowance"], 
                    $_POST["communication_allowance"], $_POST["employee_id"]);
            $res_arr = [
                "message" => "Successfully Processed",
                "status" => "success",
                "link" => "rataca",
                ];
                echo json_encode($res_arr); exit();
        endif;
    }
    else
    {

        if(isset($_GET["action"])):
            if($_GET["action"] == "lenders_list"):
                $lenders = query("select * from lenders_management");
                render("apps/payroll/loans_app/lenders_form.php", 
                [
                    "title" => "Loans Management", 
                    "lenders" => $lenders, 
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
            render("apps/payroll/rataca_app/rataca_list.php", 
                ["title" => "RATACA LIST",],"payroll");

        endif;
       


        
    }
?>