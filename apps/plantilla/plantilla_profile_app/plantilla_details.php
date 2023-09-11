<link rel="stylesheet" href="AdminLTE_new/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="AdminLTE_new/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">

<!-- <link rel="stylesheet" href="layouts/ios.css"> -->
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        Plantilla List
        <small>Version 2.0</small>
      </h1>

      
    </section>
    <section class="content">
    <div class="modal fade" id="modal_children">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h3 class="modal-title">Update Child</h3>
              </div>
              <div class="modal-body">
                <form role="form" class="generic_form_trigger" data-url="plantilla_profile">
                <input type="hidden" name="action" value="update_children">
                <div class="fetched-data"></div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                  </div>
                </form>
              </div>
        
            </div>
          </div>
      </div>


      <div class="modal fade" id="modal_educational">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h3 class="modal-title">Update Educational Background</h3>
              </div>
              <div class="modal-body">
                <form role="form" class="generic_form_trigger" data-url="plantilla_profile">
                <input type="hidden" name="action" value="modal_educational">
                <div class="fetched-data"></div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
        
            </div>
          </div>
      </div>

      <div class="modal fade" id="modal_add_child">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h3 class="modal-title">Add Child</h3>
              </div>
              <div class="modal-body">
                <form role="form" class="generic_form_trigger" data-url="plantilla_profile">
                  <input type="hidden" name="action" value="add_child">
                  <input type="hidden" name="employee_id" value="<?php echo($_GET["employee_id"]); ?>">
                  <div class="form-group">
                      <label for="exampleInputBorderWidth2">Full Name</label>
                      <input required name="FullName" type="text" class="form-control form-control-border border-width-2">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputBorderWidth2">Date of Birth</label>
                      <input required name="DateOfBirth" type="date" class="form-control form-control-border border-width-2">
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
        
            </div>
          </div>
      </div>
    <style>
      .table tr td {
        font-size:14px !important;
      }

      .table tr td i{
        font-size:12px !important;
      }
    </style>
   <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <img style="border:8px solid gray;" src="AdminLTE_new/dist/img/user2-160x160.jpg" alt="user-avatar" class=" img-fluid">
                </div>
                <h3 class="profile-username text-center"><?php echo($profile["FirstName"] . " " . $profile["LastName"] . " " . $profile["NameExtension"]); ?></h3>
                <hr>
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo($profile["JobType"]); ?></h5>
                      <span class="description-text">Employment Type</span>
                    </div>
                  </div>
                  <div class="col-sm-6 ">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo($profile["Fingerid"]); ?></h5>
                      <span class="description-text">Employee ID</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">

          <ul class="nav nav-pills" style="margin-bottom: 15px;">
                  <li class="nav-item"><a class="nav-link active" href="#pds" data-toggle="tab">Personal Information</a></li>
                  <li class="nav-item"><a class="nav-link" href="#current_employment" data-toggle="tab">Current Employment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#service_record" data-toggle="tab">Service Record</a></li>
                  <li class="nav-item"><a class="nav-link" href="#lnd" data-toggle="tab">Learning and Development</a></li>
                  <li class="nav-item"><a class="nav-link" href="#rnr" data-toggle="tab">Rewards and Recognition</a></li>
                  <li class="nav-item"><a class="nav-link" href="#work_experience" data-toggle="tab">Work Experience</a></li>
                </ul>
         
                <div class="tab-content" style="padding-right: 10px; max-height: 65vh; overflow-y: auto; width: 100%; overflow-x: hidden;">
                  <div class="active tab-pane" id="pds">
                    <!-- Start PDS -->
                    
                    <div class="row">
                      <div class="col-md-8">
                      <div class="card">
                      <form class="generic_form_trigger" id="pds_name" data-url="plantilla_profile">
                        <input type="hidden" name="action" value="update_name">
                        <input type="hidden" name="employee_id" value="<?php echo($_GET["employee_id"]); ?>">
                        <div class="card-header p-2">
                          <h3 class="card-title">Full Name</h3>
                          <div class="card-tools" style="margin-right:10px;">
                          <button class="btn btn-primary btn-update" type="button">Update</button>
                          <button style="display: none;" class="btn btn-success btn-save" type="submit">Save</button>
                          <button style="display: none;" class="btn btn-danger btn-cancel" type="button">Cancel</button>
                          </div>
                        </div>
                        <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Last Name</label>
                              <input readonly name="LastName" value="<?php echo($profile["LastName"]); ?>" type="text" class="form-control form-control-border border-width-2" >
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">First Name</label>
                              <input readonly name="FirstName" value="<?php echo($profile["FirstName"]); ?>" type="text" class="form-control form-control-border border-width-2" >
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Name Extension</label>
                              <input readonly name="NameExtension" value="<?php echo($profile["NameExtension"]); ?>" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Middle Name</label>
                              <input readonly name="MiddleName" value="<?php echo($profile["MiddleName"]); ?>" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Nickname</label>
                              <input readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                        </div>
                        </div>
                        </form>
                      </div>


                      
   




                      <div class="card">
                      <form class="generic_form_trigger" id="other_personal" data-url="plantilla_profile">
                        <input type="hidden" name="action" value="update_others">
                        <input type="hidden" name="employee_id" value="<?php echo($_GET["employee_id"]); ?>">
                        <div class="card-header p-2">
                          <h3 class="card-title">Other Personal Information</h3>
                          <div class="card-tools" style="margin-right:10px;">
                          <button class="btn btn-primary btn-update" type="button">Update</button>
                          <button style="display: none;" class="btn btn-success btn-save" type="submit">Save</button>
                          <button style="display: none;" class="btn btn-danger btn-cancel" type="button">Cancel</button>
                          </div>
                        </div>
                        <div class="card-body t">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Date of Birth</label>
                              <input name="BirthDate" value="<?php echo($profile["BirthDate"]); ?>" readonly type="date" class="form-control form-control-border border-width-2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Place of Birth</label>
                              <input name="BirthPlace" value="<?php echo($profile["BirthPlace"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleSelectBorder">Sex</label>
                            <select disabled class="select  custom-select form-control-border" id="exampleSelectBorder">
                              <option value="<?php echo($profile["Gender"]); ?>" selected><?php echo($profile["Gender"]); ?></option>
                              <option value="MALE">MALE</option>
                              <option value="FEMALE">FEMALE</option>
                            </select>
                          </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Civil Status</label>
                              <input name="CivilStatus" value="<?php echo($profile["CivilStatus"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Height (m)</label>
                              <input name="Height" value="<?php echo($profile["Height"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Weight (kg)</label>
                              <input name="Weight" value="<?php echo($profile["Weight"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Blood Type</label>
                              <input name="BloodType" value="<?php echo($profile["BloodType"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Mobile Number</label>
                              <input name="CellphoneNumber" value="<?php echo($profile["CellphoneNumber"]); ?>" readonly type="number" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Email Address (if any)</label>
                              <input name="email_address" value="<?php echo($profile["email_address"]); ?>" readonly type="email" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">GSIS</label>
                              <input name="GSIS" value="<?php echo($profile["GSIS"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">SSS</label>
                              <input name="SSS" value="<?php echo($profile["SSS"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">TIN</label>
                              <input name="TIN" value="<?php echo($profile["TIN"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">PAGIBIG</label>
                              <input name="Pagibig" value="<?php echo($profile["Pagibig"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">PHILHEALTH</label>
                              <input name="PHIC" value="<?php echo($profile["PHIC"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                        
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">RELIGION</label>
                              <input name="Religion" value="<?php echo($profile["Religion"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">CITIZENSHIP</label>
                              <input name="Nationality" value="<?php echo($profile["Nationality"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">DETAILS IF DUAL CITIZENSHIP</label>
                              <input name="details_dual" value="<?php echo($profile["details_dual"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                        </div>
                        </div>
                        </form>
                      </div>


                      <div class="card">
                      <form class="generic_form_trigger" id="family_background" data-url="plantilla_profile">
                        <input type="hidden" name="action" value="update_family">
                        <input type="hidden" name="employee_id" value="<?php echo($_GET["employee_id"]); ?>">
                        <div class="card-header p-2">
                          <h3 class="card-title">Family Background</h3>
                          <div class="card-tools" style="margin-right:10px;">
                          <button class="btn btn-primary btn-update" type="button">Update</button>
                          <button style="display: none;" class="btn btn-success btn-save" type="submit">Save</button>
                          <button style="display: none;" class="btn btn-danger btn-cancel" type="button">Cancel</button>
                          </div>
                        </div>
                        <div class="card-body t">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Last Name (Spouse)</label>
                              <input name="SLname" value="<?php echo($profile_spouseparent["SLname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">First Name (Spouse)</label>
                              <input name="SFname" value="<?php echo($profile_spouseparent["SFname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleSelectBorder">Middle Name (Spouse)</label>
                            <input name="SMname" value="<?php echo($profile_spouseparent["SMname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">

                          </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Name Extension (Spouse)</label>
                              <input name="SNameExtension" value="<?php echo($profile_spouseparent["SNameExtension"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Occupation</label>
                              <input name="SOccupation" value="<?php echo($profile_spouseparent["SOccupation"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Employer/Business Name</label>
                              <input name="SEmployer" value="<?php echo($profile_spouseparent["SEmployer"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Business Address</label>
                              <input name="SEmployerAddress" value="<?php echo($profile_spouseparent["SEmployerAddress"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Contact Number</label>
                              <input name="SEmployerContact" value="<?php echo($profile_spouseparent["SEmployerContact"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Last Name (Father)</label>
                              <input name="FLname" value="<?php echo($profile_spouseparent["FLname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">First Name (Father)</label>
                              <input name="FFname" value="<?php echo($profile_spouseparent["FFname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleSelectBorder">Middle Name (Father)</label>
                            <input name="FMname" value="<?php echo($profile_spouseparent["FMname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                          </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Name Extension (Father)</label>
                              <input name="FNameExtension" value="<?php echo($profile_spouseparent["FNameExtension"]); ?>" readonly type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Last Name (Mother)</label>
                              <input name="MLname" value="<?php echo($profile_spouseparent["MLname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">First Name (Mother)</label>
                              <input name="MFname" value="<?php echo($profile_spouseparent["MFname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleSelectBorder">Middle Name (Mother)</label>
                            <input name="MMname" value="<?php echo($profile_spouseparent["MMname"]); ?>" readonly type="text" class="form-control form-control-border border-width-2">
                          </div>
                          </div>
                        </div>
                        </div>
                        </form>
                      </div>





                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Educational Background</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th>Level</th>
                                  <th>School</th>
                                  <th>Basic Education/Degree/Course</th>
                                  <th>From</th>
                                  <th>To</th>
                                  <th>Highest Level Units Earned (if not Graduated)</th>
                                  <th>Year Graduated</th>
                                  <th>Academic Honors Received</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($profile_educational as $row): ?>
                                  <tr data-toggle="modal" data-id="<?php echo($row["tbid"]); ?>" data-target="#modal_educational">
                                    <td><?php echo($row["Level"]); ?></td>
                                    <td><?php echo($row["NameOfSchool"]); ?></td>
                                    <td><?php echo($row["Course"]); ?></td>
                                    <td><?php echo($row["FromYear"]); ?></td>
                                    <td><?php echo($row["ToYear"]); ?></td>
                                    <td><?php echo($row["HighestLevel"]); ?></td>
                                    <td><?php echo($row["YearGraduated"]); ?></td>
                                    <td><?php echo($row["Honor"]); ?></td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">CIVIL SERVICE ELIGIBILITY</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th>CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE BARANGAY ELIGIBILITY / DRIVER'S LICENSE</th>
                                  <th>RATING (If Applicable)</th>
                                  <th>DATE OF EXAMINATION/th>
                                  <th>PLACE OF EXAMINATION</th>
                                  <th>LICENSE NUMBER</th>
                                  <th>DATE of Validity</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($profile_civilservice as $row): ?>
                                  <tr data-toggle="modal" data-id="<?php echo($row["tbid"]); ?>" data-target="#modal_children">
                                    <td><?php echo($row["Title"]); ?></td>
                                    <td><?php echo($row["Rating"]); ?></td>
                                    <td><?php echo($row["DateExam"]); ?></td>
                                    <td><?php echo($row["PlaceExam"]); ?></td>
                                    <td><?php echo($row["License"]); ?></td>
                                    <td><?php echo($row["DateReleased"]); ?></td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>






                        <div class="card">
                        <form class="generic_form_trigger" id="other_background" data-url="plantilla_profile">
                        <input type="hidden" name="action" value="update_family">
                        <input type="hidden" name="employee_id" value="<?php echo($_GET["employee_id"]); ?>">
                        <div class="card-header p-2">
                          <h3 class="card-title">Other Background Information</h3>
                          <div class="card-tools" style="margin-right:10px;">
                          <button class="btn btn-primary btn-update" type="button">Update</button>
                          <button style="display: none;" class="btn btn-success btn-save" type="submit">Save</button>
                          <button style="display: none;" class="btn btn-danger btn-cancel" type="button">Cancel</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-2">
                          <p>1. Are you related by consanguinity or affinity to the appointing or recommending authority, or to 
                          chief of bureau or office or to the person who has immediate supervision over you in the 
                          Bureau or Department where you will be apppointed</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">within the third degree?</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">within the fourth degree?</label>
                              <select name="4consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>

                          </div>

                          <p>2. a. Have you ever been found guilty of any administrative offense?</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>

                          <p>2. a. Have you been criminally charged before any court?</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputBorderWidth2">Date Files (if Yes)</label>
                                <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputBorderWidth2">Status of Case/s</label>
                                <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                              </div>
                            </div>
                          </div>

                          <p>3. Have you ever been convicted of any crime or violation of any law, decree, ordinance or 
                              regulation by any court or tribunal?</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>


                          <p>4. Have you ever been separated from the service in any of the following modes: resignation, 
retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or 
phased out (abolition) in the public or private sector?</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>


                          <p>5 a. Have you ever been a candidate in a national or local election held within the last year 
(except Barangay election)?</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>


                          <p>5 b. Have you resigned from the government service during the three (3)-month period before 
the last election to promote/actively campaign for a national or local candidate?</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>
                          <p>6. Have you acquired the status of an immigrant or permanent resident of another country?</p>
                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>


                          <p>7. 
Have you acquired the status of an immigrant or permanent resident of another country?
Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons 
(RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following
<br>
<br>
a. Are you a member of any indigenous group?
</p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>


                          <p>
                            b. Are you a person with disability?
                          </p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>

                          <p>
                            c. Are you a solo-parent?
                          </p>

                          <div class="row">
                            <div class="col-md-4">

                            <div class="form-group">
                              <label for="exampleInputEmail1">(Yes / No)</label>
                              <select name="3consanguity" disabled required class="custom-select form-control-border select" id="province_select">
                                  <option value=""></option>
                            </select>
                            </div>

                            </div>
                            <div class="col-md-8">

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Details if Yes</label>
                              <input type="text" readonly class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            </div>
                          </div>


                        </div>
                                </form>
                        </div>


                      </div>

                      <div class="col-md-4">


                      <div class="card">
                      <form class="generic_form_trigger" id="pds_address" data-url="plantilla_profile">
                        <input type="hidden" name="action" value="update_address">
                        <input type="hidden" name="employee_id" value="<?php echo($_GET["employee_id"]); ?>">
                        <div class="card-header p-2">
                          <h3 class="card-title">Address</h3>
                          <div class="card-tools" style="margin-right:10px;">
                          <button class="btn btn-primary btn-update" type="button">Update</button>
                          <button style="display: none;" class="btn btn-success btn-save" type="submit">Save</button>
                          <button style="display: none;" class="btn btn-danger btn-cancel" type="button">Cancel</button>
                          </div>
                        </div>
                        <div class="card-body">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Province *</label>
                              <input type="hidden" id="province_text" value="<?php echo($profile["Province"]); ?>" name="province_text">
                              <select name="province" disabled required class="custom-select form-control-border select" id="province_select">
                                <option value="<?php echo($profile["province_code"]); ?>"><?php echo($profile["Province"]); ?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                            <input type="hidden" value="<?php echo($profile["City"]); ?>" id="city_mun_text" name="city_mun_text">
                              <label for="exampleInputEmail1">City | Municipality *</label>
                              <select name="City" disabled required class="custom-select form-control-border select" id="city_mun_select">
                                <option value="<?php echo($profile["city_mun_code"]); ?>"><?php echo($profile["City"]); ?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Barangay *</label>
                              <input  value="<?php echo($profile["Brgy"]); ?>" type="hidden" id="brgy_text" name="brgy_text">
                              <select name="Brgy" disabled required class="custom-select form-control-border select" id="barangay_select">
                                <option value="<?php echo($profile["brgy_code"]); ?>"><?php echo($profile["Brgy"]); ?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">House/Block/Lot No.</label>
                              <input readonly name="HBLNo" value="<?php echo($profile["HBLNo"]); ?>" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Street</label>
                              <input readonly name="Street" value="<?php echo($profile["Street"]); ?>" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Subdivision/Village</label>
                              <input readonly name="Subd" value="<?php echo($profile["Subd"]); ?>" type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                          </div>
                        </div>
                        </div>
                        </form>
                      </div>
                      <div class="card">
                        <div class="card-header ">
                          <h3 class="card-title">Contact in Case of Emergency</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Name</label>
                              <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Relationship</label>
                              <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Address</label>
                              <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputBorderWidth2">Contact Number</label>
                              <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2">
                            </div>
                        </div>
                      </div>


                      <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Children</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                          <tr>
                            <!-- <th>Order</th> -->
                            <th>Name</th>
                            <th>Date of Birth</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($profile_children as $c):
                            // dump($c);
                            ?>
                            <!-- <a href="google.com"> -->
                              <tr data-toggle="modal" data-id="<?php echo($c["tbid"]); ?>" data-target="#modal_children">
                                <td><?php echo($c["FullName"]); ?></td>
                                <td><?php echo($c["DateOfBirth"]); ?></td>
                              </tr>
                            <!-- </a> -->
                          <?php endforeach; ?>
                    
                        
                        </tbody>
                </table>

                      
                </div>
                        </div>





                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Voluntary Work</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                          <tr>
                            <!-- <th>Order</th> -->
                            <th>Name & Address of Organization</th>
                            <th>From</th>
                            <th>To</th>
                            <th># of Hours</th>
                            <th>Position / Nature of Work</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($profile_voluntary as $row):
                            ?>
                              <tr data-toggle="modal" data-id="<?php echo($row["tbid"]); ?>" data-target="#modal_children">
                                <td><?php echo($row["Organization"]); ?></td>
                                <td><?php echo($row["FromYear"]); ?></td>
                                <td><?php echo($row["ToYear"]); ?></td>
                                <td><?php echo($row["Hours"]); ?></td>
                                <td><?php echo($row["PositionWork"]); ?></td>
                              </tr>
                            <!-- </a> -->
                          <?php endforeach; ?>
                    
                        
                          </tbody>
                          </table>  
                        </div>
                        </div>


                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Special Skills and Hobbies</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($profile_skills as $row):
                            ?>
                              <tr data-toggle="modal" data-id="<?php echo($row["tbid"]); ?>" data-target="#modal_children">
                                <td><?php echo($row["Title"]); ?></td>
                              </tr>
                            <!-- </a> -->
                          <?php endforeach; ?>
                          </tbody>
                          </table>  
                        </div>
                        </div>


                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Non Academic Distinction</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($profile_nonacad as $row):
                            ?>
                              <tr data-toggle="modal" data-id="<?php echo($row["tbid"]); ?>" data-target="#modal_children">
                                <td><?php echo($row["Title"]); ?></td>
                              </tr>
                            <!-- </a> -->
                          <?php endforeach; ?>
                          </tbody>
                          </table>  
                        </div>
                        </div>


                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Non Academic Distinction</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($profile_org as $row):
                            ?>
                              <tr data-toggle="modal" data-id="<?php echo($row["tbid"]); ?>" data-target="#modal_children">
                                <td><?php echo($row["Title"]); ?></td>
                              </tr>
                            <!-- </a> -->
                          <?php endforeach; ?>
                          </tbody>
                          </table>  
                        </div>
                        </div>


                        <div class="card">
                        <div class="card-header p-2">
                          <h3 class="card-title">Reference</h3>
                          <div class="card-tools" style="margin-right:10px;">
                            <button data-toggle="modal" data-target="#modal_add_child" class="btn btn-primary btn-save" type="submit">Add</button>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Address</th>
                                  <th>Contact</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($profile_reference as $row): ?>
                                  <tr data-toggle="modal" data-id="<?php echo($row["tblid"]); ?>" data-target="#modal_children">
                                    <td><?php echo($row["FullName"]); ?></td>
                                    <td><?php echo($row["Address"]); ?></td>
                                    <td><?php echo($row["ContactNo"]); ?></td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>



                      </div>
                    </div>
                    <!-- End PDS -->
                  </div>
                  <div class="tab-pane" id="current_employment">
              
                  </div>
                  <div class="tab-pane" id="service_record">
                  
                  </div>
                  <div class="tab-pane" id="lnd">
                  
                  </div>
                  <div class="tab-pane" id="rnr">
                  
                  </div>
                  <div class="tab-pane" id="work_experience">
                  
                  </div>
                
        </div>
        </div>
    </section>
</div>
   
  </div>
  <?php 
    require("layouts/footer.php");
  ?>
<script src="AdminLTE_new/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE_new/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE_new/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE_new/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="AdminLTE_new/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="AdminLTE_new/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script src="node_modules/zipcodes-ph/build/index.umd.min.js"></script>
<script src="AdminLTE_new/dist/js/adminlte.min.js"></script>
  <!-- <script src="AdminLTE_new/dist/js/demo.js"></script> -->
  <script>
    $('.select2').select2()
    $('.datepicker').datepicker({
      autoclose: true
    })
    $(".btn-update").click(function(){
      var form = $(this).parents('form:first');
      $("#"+form.attr('id')+" :input").prop('readonly', false);
      $("#"+form.attr('id')+" .select").prop('disabled', false);
      $("#"+form.attr('id')+" .btn-save").show(); //Showing submit_text
      $("#"+form.attr('id')+" .btn-cancel").show(); //Showing submit_text
      $("#"+form.attr('id')+" .update-btn").hide(); //Showing submit_text
    });
    $(".btn-cancel").click(function(){
      var form = $(this).parents('form:first');
      $("#"+form.attr('id')+" :input").prop('readonly', true);
      $("#"+form.attr('id')+" .select").prop('disabled', true);
      $("#"+form.attr('id')+" .btn-save").hide(); //Showing submit_text
      $("#"+form.attr('id')+" .btn-cancel").hide(); //Showing submit_text
      $("#"+form.attr('id')+" .update-btn").show(); //Showing submit_text
    });



    var all_province = Philippines.sort(Philippines.provinces,"A");
    // html = "<option value='' disabled selected>Select Province</option>";
    var select = document.getElementById('province_select');
    for(var key in all_province) {
      // console.log(all_province[key].name);
      select.add(new Option(all_province[key].name,all_province[key].prov_code));
        // html += "<option value=" + all_province[key].prov_code  + ">" +all_province[key].name + "</option>"
    }
    // document.getElementById("province_select").innerHTML = html;


  $('#province_select').change(function(){
    $('#province_text').val($( "#province_select option:selected" ).text());
    city_mun = Philippines.getCityMunByProvince($(this).val(), 'A');
    console.log(city_mun);
    html = "<option value='' disabled selected>Select City / Municipality</option>";
    for(var key in city_mun) {
      // console.log(city_mun[key].name);
        html += "<option value=" + city_mun[key].mun_code  + ">" +city_mun[key].name + "</option>"
    }
    document.getElementById("city_mun_select").innerHTML = html;
});


$('#city_mun_select').change(function(){

  console.log(zipcodesPH.default.find("8119"));

    $('#city_mun_text').val($( "#city_mun_select option:selected" ).text());
    barangay = Philippines.getBarangayByMun($(this).val(), 'A');
    html = "<option value='' disabled selected>Select Barangay</option>";
    for(var key in barangay) {
      // console.log(city_mun[key].name);
        html += "<option value=" + barangay[key].mun_code  + ">" +barangay[key].name + "</option>"
    }
    document.getElementById("barangay_select").innerHTML = html;
});

$('#barangay_select').change(function(){
    $('#brgy_text').val($( "#barangay_select option:selected" ).text());

});


$(document).ready(function(){
    $('#modal_children').on('show.bs.modal', function (e) {
        var dataURL = $(e.relatedTarget).data('id');
        console.log(dataURL);
        $.ajax({
            type : 'post',
            url : 'plantilla_profile', //Here you will fetch records 
            data: {
                tblid: dataURL, action: "modal_children"
            },
            success : function(data){
              $('#modal_children .fetched-data').html(data);
               
            }
        });
     });


     $('#modal_educational').on('show.bs.modal', function (e) {
        var dataURL = $(e.relatedTarget).data('id');
        console.log(dataURL);
        $.ajax({
            type : 'post',
            url : 'plantilla_profile', //Here you will fetch records 
            data: {
                tblid: dataURL, action: "modal_educational"
            },
            success : function(data){
              $('#modal_educational .fetched-data').html(data);
               
            }
        });
     });


});





  </script>


  <?php
	require("layouts/footer_end.php");
  ?>