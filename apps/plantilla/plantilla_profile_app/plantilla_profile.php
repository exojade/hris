<?php   
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["action"] == "datatable"):
            $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = 10;
            $search = $_POST["search"]["value"];
            $sql = query("select * from tblemployee where JobType in ('PERMANENT', 'COTERMINOUS')");
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
                where JobType in ('PERMANENT', 'COTERMINOUS')
                  order by LastName ASC
                                    limit ".$limit." offset ".$offset." ";
                $employees = query($query_string);
            }
            else{
                // dump($search);
                $query_string = "
                    select * from tblemployee
                    where 
                    JobType in ('PERMANENT', 'COTERMINOUS') and (
                    concat(LastName, ', ', FirstName) like '%".$search."%' or
                    concat(FirstName, ' ', LastName) like '%".$search."%' or
                    Fingerid like '%".$search."%' or 
                    HRID like '%".$search."%')
                    order by LastName ASC
                    limit ".$limit." offset ".$offset."
                ";
                $employees = query($query_string);
                $query_string = "
                        select * from tblemployee
                        where 
                        JobType in ('PERMANENT', 'COTERMINOUS') and (
                        concat(LastName, ', ', FirstName) like '%".$search."%' or
                        concat(FirstName, ' ', LastName) like '%".$search."%' or
                        Fingerid like '%".$search."%' or 
                        HRID like '%".$search."%')
                        order by LastName ASC
                ";
                $all_employees = query($query_string);
            }
            $i=0;
            foreach($employees as $row):
                $employees[$i]["action"] = '
                <a href="plantilla_profile?employee_id='.$row["Employeeid"].'&action=details"" class="btn btn-flat btn-success btn-block"><i class="fa fa-eye"></i></a>
                ';
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
        
        elseif($_POST["action"] == "update_name"):
          query("update tblemployee SET FirstName=?,MiddleName=?,LastName=?,NameExtension=?
                    where Employeeid=?", $_POST["FirstName"],$_POST["MiddleName"],
                                        $_POST["LastName"],$_POST["NameExtension"],
                                        $_POST["employee_id"]);
          $res_arr = [
            "status" => "success",
            "title" => "Success",
            "message" => "Success on Updating",
            "link" => "plantilla_profile?action=details&employee_id=".$_POST["employee_id"],
            ];
            echo json_encode($res_arr); exit();

        elseif($_POST["action"] == "update_others"):
            // dump($_POST);
            query("update tblemployee SET 
                        BirthDate=?,BirthPlace=?,CivilStatus=?,Height=?,Weight=?,
                        BloodType=?,CellphoneNumber=?,email_address=?,
                        GSIS=?,SSS=?,TIN=?,Pagibig=?,PHIC=?,Religion=?,
                        Nationality=?,details_dual=?
                        where Employeeid=?", 
                        $_POST["BirthDate"],$_POST["BirthPlace"],$_POST["CivilStatus"],
                        $_POST["Height"],$_POST["Weight"],$_POST["BloodType"],$_POST["CellphoneNumber"],
                        $_POST["email_address"],$_POST["GSIS"],$_POST["SSS"],$_POST["TIN"],$_POST["Pagibig"],
                        $_POST["PHIC"],$_POST["Religion"],$_POST["Nationality"],$_POST["details_dual"],
                        $_POST["employee_id"]);
                $res_arr = [
                  "status" => "success",
                  "title" => "Success",
                  "message" => "Success on Updating",
                  "link" => "plantilla_profile?action=details&employee_id=".$_POST["employee_id"],
                  ];
                  echo json_encode($res_arr); exit();

        elseif($_POST["action"] == "update_family"):
            query("update tblemployee_spouseparent SET 
                        FFname=?,FMname=?,FLname=?,FNameExtension=?,
                        MFname=?,MMname=?,MLname=?,
                        SFname=?,SMname=?,SLname=?,SNameExtension=?,
                        SOccupation=?,SEmployer=?,SEmployerAddress=?,SEmployerContact=?
                        where Employeeid=?", 
                        $_POST["FFname"],$_POST["FMname"],$_POST["FLname"],$_POST["FNameExtension"],
                        $_POST["MFname"],$_POST["MMname"],$_POST["MLname"],
                        $_POST["SFname"],$_POST["SMname"],$_POST["SLname"],$_POST["SNameExtension"],
                        $_POST["SOccupation"],$_POST["SEmployer"],$_POST["SEmployerAddress"],$_POST["SEmployerContact"],
                        $_POST["employee_id"]);

            $res_arr = [
                "status" => "success",
                "title" => "Success",
                "message" => "Success on Updating",
                "link" => "plantilla_profile?action=details&employee_id=".$_POST["employee_id"],
                ];
                echo json_encode($res_arr); exit();

        elseif($_POST["action"] == "update_address"):
            // dump($_POST);
                    query("update tblemployee SET 
                                HBLNo=?,Street=?,Subd=?,
                                brgy_code=?,Brgy=?,
                                city_mun_code=?,City=?,
                                province_code=?,Province=?
                                where Employeeid=?", 
                                $_POST["HBLNo"],$_POST["Street"],$_POST["Subd"],
                                $_POST["Brgy"],$_POST["brgy_text"],
                                $_POST["City"],$_POST["city_mun_text"],
                                $_POST["province"],$_POST["province_text"],
                                $_POST["employee_id"]);
        
                    $res_arr = [
                        "status" => "success",
                        "title" => "Success",
                        "message" => "Success on Updating",
                        "link" => "plantilla_profile?action=details&employee_id=".$_POST["employee_id"],
                        ];
                        echo json_encode($res_arr); exit();
        elseif($_POST["action"] == "modal_children"):
            $message = "";
            $child = query("select * from tblemployee_children where tbid = ?", $_POST["tblid"]);

            $message = $message . '
            <input type="hidden" name="tblid" value="'.$child[0]["tbid"].'">
            <input type="hidden" name="employee_id" value="'.$child[0]["Employeeid"].'">
                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Full Name</label>
                    <input required name="FullName" value="'.$child[0]["FullName"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>
                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Full Name</label>
                    <input required name="DateOfBirth" value="'.$child[0]["DateOfBirth"].'" type="date" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>
            ';
            echo($message);


            elseif($_POST["action"] == "modal_educational"):
                $message = "";
                $educational = query("select * from tblemployee_educational where tbid = ?", $_POST["tblid"]);
                $message = $message . '
                <input type="hidden" name="tblid" value="'.$child[0]["tbid"].'">
                <input type="hidden" name="employee_id" value="'.$child[0]["Employeeid"].'">

                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Level</label>
                    <select name="Level" class="select  custom-select form-control-border">
                        <option value="'.$educational[0]["Level"].'">'.$educational[0]["Level"].'</option>
                        <option value="Elementary">Elementary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Vocational/Trade Course">Vocational/Trade Course</option>
                        <option value="College">College</option>
                        <option value="Graduate Studies">Graduate Studies</option>
                    </select>
                </div>


                
                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Name of School</label>
                    <input required name="NameOfSchool" value="'.$educational[0]["NameOfSchool"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>

                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Course</label>
                    <input name="Course" value="'.$educational[0]["Course"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">From</label>
                            <input name="FromYear" value="'.$educational[0]["FromYear"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputBorderWidth2">To</label>
                            <input name="ToYear" value="'.$educational[0]["ToYear"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Highest Level/ Units Earned if not graduate</label>
                    <input name="HighestLevel" value="'.$educational[0]["HighestLevel"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>
                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Year Graduated</label>
                    <input name="YearGraduated" value="'.$educational[0]["YearGraduated"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>
                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Scholarship / Academic Honors Received</label>
                    <input name="Honor" value="'.$educational[0]["Honor"].'" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                </div>
                    
                ';
                echo($message);

            elseif($_POST["action"] == "update_children"):
                query("update tblemployee_children set FullName = ?,
                        DateOfBirth = ? where tbid = ?",
                        $_POST["FullName"], $_POST["DateOfBirth"], $_POST["tblid"]);
                        $res_arr = [
                            "status" => "success",
                            "title" => "Success",
                            "message" => "Success on Updating",
                            "link" => "plantilla_profile?action=details&employee_id=".$_POST["employee_id"],
                            ];
                            echo json_encode($res_arr); exit();

            elseif($_POST["action"] == "add_child"):
                query("insert INTO tblemployee_children (Employeeid,FullName,DateOfBirth) 
                        VALUES(?,?,?)", 
                        $_POST["employee_id"],$_POST["FullName"],$_POST["DateOfBirth"]);
                $res_arr = [
                    "status" => "success",
                    "title" => "Success",
                    "message" => "Success on Updating",
                    "link" => "plantilla_profile?action=details&employee_id=".$_POST["employee_id"],
                    ];
                    echo json_encode($res_arr); exit();

        endif;

        

 
      


    }
    else
    {

        // dump("yawa");

        if(isset($_GET["action"])):

          if($_GET["action"] == "details"):

            $profile = query("select * from tblemployee where Employeeid = ?", $_GET["employee_id"]);
            $profile=$profile[0];
            $profile_spouseparent = query("select * from tblemployee_spouseparent where Employeeid = ?", $_GET["employee_id"]);
            $profile_spouseparent = $profile_spouseparent[0];
            $profile_children = query("select * from tblemployee_children where Employeeid = ?", $_GET["employee_id"]);
            $profile_voluntary = query("select * from tblemployee_voluntary where Employeeid = ?", $_GET["employee_id"]);
            $profile_skills = query("select * from tblemployee_otherinfo where Employeeid = ? and Type = 'skills'", $_GET["employee_id"]);
            $profile_nonacad = query("select * from tblemployee_otherinfo where Employeeid = ? and Type = 'nonacad'", $_GET["employee_id"]);
            $profile_org = query("select * from tblemployee_otherinfo where Employeeid = ? and Type = 'org'", $_GET["employee_id"]);
            $profile_educational = query("select * from tblemployee_educational where Employeeid = ?", $_GET["employee_id"]);
            $profile_civilservice = query("select * from tblemployee_civilservice where Employeeid = ?", $_GET["employee_id"]);
            $profile_reference = query("select * from tblemployee_references where Employeeid = ?", $_GET["employee_id"]);
            render("apps/plantilla/plantilla_profile_app/plantilla_details.php", 
                ["title" => "Employees",
                "profile" => $profile,
                "profile_spouseparent" => $profile_spouseparent,
                "profile_children" => $profile_children,
                "profile_voluntary" => $profile_voluntary,
                "profile_skills" => $profile_skills,
                "profile_nonacad" => $profile_nonacad,
                "profile_org" => $profile_org,
                "profile_educational" => $profile_educational,
                "profile_civilservice" => $profile_civilservice,
                "profile_reference" => $profile_reference,
            ],"plantilla");
          endif;

         
        else:
            render("apps/plantilla/plantilla_profile_app/plantilla_list.php", 
                ["title" => "Employees",],"plantilla");

        endif;
       


        
    }
?>