<?php   
// dump($_REQUEST);
    include('apps/attendance/attendance_app/attendance_functions.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["action"] == "add_loan_type"):
            $loantype_id = create_uuid("LOANTYPE");
            if (query("insert into lenders_management (lenders_id,lender,loan_name) 
				VALUES(?,?,?)", 
				$loantype_id,$_POST["lender"],$_POST["loans_name"]) === false)
				{
					dump("error");
				}
                $res_arr = [
                    "message" => "Successfully Processed",
                    "status" => "success",
                    "link" => "loans_management?action=lenders_list",
                    ];
                    echo json_encode($res_arr); exit();
        
        elseif($_POST["action"] == "mandatory_employees"):
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

            $mandatory = query("select * from employee_mandatory");
            // dump($Salary);
            $Mandatory = [];
            foreach($mandatory as $row):
                $Mandatory[$row["employee_id"]] = $row;
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
            foreach($employees as $row):
                // $employees[$i]["action"] = '
                // <div class="btn-group">
                //   <button type="button" class="btn btn-default btn-flat" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" style="margin-right: 20px;"></i><i class="fa fa-caret-down"></i></button>
                //   <ul class="dropdown-menu" role="menu">
                //     <li><a href="employees?employee_id='.$row["Employeeid"].'&action=information">Information</a></li>
                //     <li><a href="viewemployee?id='.$row["Employeeid"].'">Schedule</a></li>
                //   </ul>
                // </div>';
                $employees[$i]["sss_ps"] = 0;
                $employees[$i]["hdmf_ps"] = 0;
                $employees[$i]["hdmf_mp2"] = 0;
                $employees[$i]["witholding_tax"] = 0;
                if(isset($Mandatory[$row["Employeeid"]])):
                    $employees[$i]["sss_ps"] = to_peso($Mandatory[$row["Employeeid"]]["sss_ps"]);
                    $employees[$i]["hdmf_ps"] = to_peso($Mandatory[$row["Employeeid"]]["hdmf_ps"]);
                    $employees[$i]["hdmf_mp2"] = to_peso($Mandatory[$row["Employeeid"]]["hdmf_mp2"]);
                    $employees[$i]["witholding_tax"] = to_peso($Mandatory[$row["Employeeid"]]["witholding_tax"]);
                endif;


             
                $employees[$i]["name"] = "<a href='mandatory?action=mandatory_employee&id=".$row["Employeeid"]."'>".$row["LastName"] . ", " . $row["FirstName"] . "</a>";
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
        
        elseif($_POST["action"] == "save_mandatory"):
            query("delete from employee_mandatory where employee_id = ?", $_POST["employee_id"]);
            $queryFormat = '("%s","%s","%s","%s","%s")';
                    $inserts[] = sprintf( 
                        $queryFormat, 
                        $_POST["employee_id"], $_POST["sss_ps"], $_POST["hdmf_ps"], 
                        $_POST["hdmf_mp2"], $_POST["witholding_tax"]
                    );
            $query = implode( ",", $inserts );
            query('insert into employee_mandatory(employee_id, sss_ps, hdmf_ps, hdmf_mp2, witholding_tax) VALUES '.$query);
            $res_arr = [
                "message" => "Successfully Processed",
                "status" => "success",
                "link" => "mandatory?action=mandatory_employee&id=".$_POST["employee_id"],
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
            render("apps/payroll/mandatory_deductions_app/mandatory_list.php", 
                ["title" => "Mandatory Deductions",],"payroll");

        endif;
       


        
    }
?>