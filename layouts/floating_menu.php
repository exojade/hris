<!-- <style>
#floatingdiv
{
	display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 31px; /* Place the button at the bottom of the page */
    right: 30px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    margin-right: 70px;

    background-color: rgba(0, 0, 0, 0.8);
	
	color:#fff;
    cursor: pointer; /* Add a mouse pointer on hover */
	border-radius: 5px; /* Rounded corners */
    
}

.floatingtext {
	position: relative;
	
	margin-top: 15px;
	padding-top: 10px;
	padding-left: 20px;
	padding-right: 20px;
	background-color: rgba(0, 0, 0, 0.6);
	border-radius: 3%;
	
	
	
}

.floatingtext p{
	font-size:11px;
	
}


.floatingdiv
{
	display: block; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 9px; /* Place the button at the bottom of the page */
    right: 5px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    
	
	padding:10px;
	color:#fff;
    cursor: pointer; /* Add a mouse pointer on hover */
	border-radius: 5px; /* Rounded corners */
    
}

.othermenus
{
	position: absolute;
	display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 80px; /* Place the button at the bottom of the page */
    right: 0; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    
	
	
	color:#fff;
    cursor: pointer; /* Add a mouse pointer on hover */
	border-radius: 5px; /* Rounded corners */
    
}

.othermenus .menu1
{
	margin-bottom:20px;
    
}



.othermenus .menu1 button
{ 
	
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 20px; /* Some padding */
    border-radius: 50%; /* Rounded corners */
	
    
}


.floatingdiv button {
	
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}




#myBtn {
    display: block; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 20px; /* Place the button at the bottom of the page */
    right: 30px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 20px; /* Some padding */
    border-radius: 50%; /* Rounded corners */
}






#mySearch {
    display: block; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 8px; /* Place the button at the bottom of the page */
    right: 100px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 10px; /* Some padding */
    border-radius: 50%; /* Rounded corners */
}



</style>


	  
	  <div class="othermenus" id="others">
		<div class="menu1">
			<div style="display: inline;">
				<a href="opensubject.php" style="padding:30px; 
				margin-left: 30px; padding-bottom: 50px; padding-top:50px;" onmouseover="document.getElementById('others').style.display = 'block';"
				onmouseout="document.getElementById('others').style.display = 'none';"><button class="btn btn-primary">
				<i class="fa fa-fw fa-plus"></i>
				</button></a>
			</div>
			
			<div style="float: left;">
				<div class="floatingtext pull-left">
					<p>Enroll Subject&nbsp;&nbsp;</p>
				</div>
			</div>
			
		</div>
		
		<div class="menu1">
		
			<a data-toggle="modal" data-target="#modalpopulation" style="padding:30px; margin-left: 30px; padding-bottom: 50px; padding-top:50px;" onmouseover="document.getElementById('others').style.display = 'block';"
			onmouseout="document.getElementById('others').style.display = 'none';"><button class="btn btn-primary">
			<i class="fa fa-fw fa-circle-o-notch" aria-hidden="true"></i>
			</button></a>
			
			<div style="float: left;">
				<div class="floatingtext pull-left">
					<p>Term Switch&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
				</div>
			</div>
			
		</div>
	  </div>
	  
	  
	  <div class="floatingdiv">
	  
		<a style="padding:10px;" onmouseover="document.getElementById('others').style.display = 'block';"
		onmouseout="document.getElementById('others').style.display = 'none';"><button  id="myBtn" class="btn btn-primary">
				<i class="fa fa-fw fa-bars" aria-hidden="true"></i>
			</button></a>
	  </div> -->


    <div class="modal fade" id="modal-add-bid">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
              <form id="register_bid_form" method="post" enctype="multipart/form-data" autocomplete="nope">
              <div class="box-body">
                  <div class="form-group">
                  <label>Title of Bid</label>
                    <input autocomplete="off" type="text" name="title_bid" class="form-control" placeholder="Enter title of bid">
                  </div>
                <div class="form-group">
                <label>Amount</label>
                  <input type="number" step="0.01" name="amount" class="form-control" placeholder="Enter Amount">
                </div>

                <div class="form-group">
                  <label>Supplier</label>
                    <input autocomplete="off" type="text" name="supplier" class="form-control" placeholder="Enter Supplier">
                  </div>

                <div class="form-group">
                  <label>Bid Doc Type</label>
                  <select name="doc_type" required class="form-control">
                    <option selected disabled value="">Please select Bid Doc Type</option>
                    <option value="RFQ">RFQ</option>
                    <option value="Invitation to Bid">Invitation to Bid</option>
                    <option value="NOA">Notice of Award</option>
                    <option value="Notices">Notices</option>
                    <option value="Procurement Plan">Procurement Plan</option>
                    <option value="Minutes">Minutes</option>
                    <option value="Abstract of Bid">Abstract of Bid</option>
                  </select>
                </div>


                <div class="form-group">
                  <label>Document Type</label>
                  <select class="form-control" name="type" required>
                    <option selected disabled value="">Document Type</option>
                          <option value="APP">Annual Procurement Plan</option>
                          <option value="Civil Works">Civil Works</option>
                          <option value="Goods and Services">Goods and Services</option>
                          <option value="Infrastructure">Infrastructure</option>
                          <option value="Notice of Award">Notice of Award</option>
                          <option value="Suplemental Procurement Plan">Suplemental Procurement Plan</option>
                          <option value="Others">Others</option>
                  </select>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date Published</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input autocomplete="off" type="text" name="published" class="form-control pull-right datepicker" >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Closing Date</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input autocomplete="off" type="text" name="closing" class="form-control pull-right datepicker" >
                      </div>
                    </div>
                  </div>
                </div>


                <div class="checkbox">
                  <label>
                    <input name="checker" value="1" id="basic_checkbox_2" type="checkbox"> Is this a Link?
                  </label>
                </div>

                <div class="form-group linkuploader" style="display:none;">
                        <input type="text" name="files" autocomplete="off"  class="form-control" placeholder="Please Enter the link of the document">
                </div>
														
                <div class="form-group linkuploader" style="display:none;">
                        <input type="text" name="rfqreference" autocomplete="off"  class="form-control" placeholder="Please Enter reference rfq">
                </div>

                <div id="fileuploader">
                <div class="box-header with-border">
                  <label>UPLOADER</label>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" id="add_place_input"><i class="fa fa-plus"></i></button>
                  </div>
                </div>


                <div id="places_form">
                    <div class="row" id="place_input">
                      <div class="col-sm-3">
                        <div class="form-group">
                            <a id="remove_place_input" class="btn btn-block btn-flat btn-danger">Remove</a>
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="form-group">
                            <input autocomplete="off" type="text" id="prepended-input" name="sub_title[]" autocomplete="off" class="form-control" placeholder="Please Enter title of document">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        
                      </div>
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <input accept="application/pdf" type="file" name="files[]" id="exampleInputFile">
                        </div>
                      </div>
                    </div>
                </div>	
              </div>	
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
              </div>
            </div>
          </div>
        </div>