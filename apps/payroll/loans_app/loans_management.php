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
        
        elseif($_POST["action"] == "loans_employee"):
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

            $salary = query("select * from tbl_salary_sched sched
                                left join tbl_salary_grade grade
                                on grade.salary_schedule_id = sched.salary_schedule_id");
            $Salary = [];
            foreach($salary as $row):
                $Salary[$row["schedule"]][$row["salary_grade"]][$row["step"]]["salary"] = $row["salary"];
            endforeach;

            $loans = query("SELECT employee_id, COUNT(*) AS loans, SUM(loans_amount) amount FROM loans_management GROUP BY employee_id");
            // dump($Salary);
            $Loans = [];
            foreach($loans as $row):
                $Loans[$row["employee_id"]] = $row;
            endforeach;



            $all_employees = $sql;
            if($search == ""){
                $query_string = "select * from tblemployee " . $where . "
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
                $employees[$i]["loans"] = 0;
                $employees[$i]["amount"] = 0;
                if(isset($Loans[$row["Employeeid"]])):
                    $employees[$i]["loans"] = $Loans[$row["Employeeid"]]["loans"];
                    $employees[$i]["amount"] = to_peso($Loans[$row["Employeeid"]]["amount"]);
                endif;


             
                $employees[$i]["salary_amount"] = "<a href='#' data-id='".$row["Employeeid"]."' data-toggle='modal' data-target='#modal_salary'>".to_peso($Salary[$row["salary_class"]][$row["salary_grade"]][$row["salary_step"]]["salary"])."</a>";
                $employees[$i]["name"] = "<a href='loans_management?action=loans_employee&id=".$row["Employeeid"]."'>".$row["LastName"] . ", " . $row["FirstName"] . "</a>";
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

        elseif($_POST["action"] == "modal_salary"):
            // dump($_POST);
            $employee = query("select * from tblemployee where Employeeid = ?", $_POST["employee_id"]);
            $echo = '
            <input type="hidden" name="employee_id" value="'.$_POST["employee_id"].'"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Salary Grade</label>
                <input value="'.$employee[0]["salary_grade"].'" type="number" name="salary_grade" class="form-control" placeholder="---">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Representation Allowance</label>
                <input value="'.$employee[0]["salary_step"].'" type="number" name="salary_step" class="form-control" placeholder="---">
            </div>
            <div class="form-group">
                <label>Salary Class</label>
                <select class="form-control" name="salary_class">
                    <option value="'.$employee[0]["salary_class"].'">'.$employee[0]["salary_class"].'</option>
                    <option value="1st class">1st class</option>
                    <option value="3rd class">3rd class</option>
                </select>
            </div>
            ';
            echo($echo);

            elseif($_POST["action"] == "save_salary"):
                // dump($_POST);
                query("update tblemployee set salary_grade = ?, salary_step = ?, salary_class = ?
                    where Employeeid = ?", 
                    $_POST["salary_grade"], $_POST["salary_step"], $_POST["salary_class"], 
                    $_POST["employee_id"]);
            $res_arr = [
                "message" => "Successfully Processed",
                "status" => "success",
                "link" => "loans_management",
                ];
                echo json_encode($res_arr); exit();



        
        elseif($_POST["action"] == "save_loan"):
            // dump($_POST);
            query("delete from loans_management where employee_id = ?", $_POST["employee_id"]);
            $inserts = array();
            $queryFormat = '("%s","%s","%s","%s","%s")';
            $lenders = query("select * from lenders_management");
            foreach($lenders as $row):
                if($_POST[$row["lenders_id"]] != ""):
                    $loans_id = create_uuid("LOAN");
                    $inserts[] = sprintf( 
                        $queryFormat, 
                        $loans_id, $row["loan_name"], $_POST["employee_id"], 
                        $_POST[$row["lenders_id"]], $row["lenders_id"]
                    );
                endif;
            endforeach;
            $query = implode( ",", $inserts );
            query('insert into loans_management(loans_id, loan_title, employee_id, loans_amount, lenders_id) VALUES '.$query);
            $res_arr = [
                "message" => "Successfully Processed",
                "status" => "success",
                "link" => "loans_management?action=loans_employee&id=".$_POST["employee_id"],
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
            endif;
            if($_GET["action"] == "loans_employee"):
                $lenders = query("select * from lenders_management order by lender ASC");
                $loans_employee = query("select * from loans_management where employee_id = ?", $_GET["id"]);
                
                $LoansEmployee = [];
                foreach($loans_employee as $row):
                    $LoansEmployee[$row["lenders_id"]] = $row;
                endforeach;

                $employee = query("select Employeeid, Fingerid, concat(LastName, ', ', FirstName, ' ' , NameExtension) as name from tblemployee
                                    where Employeeid = ?", $_GET["id"]);
                $employee = $employee[0];

                render("apps/payroll/loans_app/loans_employee.php", 
                [
                    "title" => "Loans Employee", 
                    "lenders" => $lenders, 
                    "LoansEmployee" => $LoansEmployee, 
                    "employee" => $employee, 
            
                ],"payroll");
            endif;

          
        else:
            render("apps/payroll/loans_app/loans_management_form.php", 
                ["title" => "Loans Management",],"payroll");

        endif;
       


        
    }
?>