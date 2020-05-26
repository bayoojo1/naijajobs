<?php
include("template_pageLeft.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Naija Jobs Arena</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
  <link rel="icon" sizes="16x16" href="images/favicon_io/favicon.ico">
  <link rel="manifest" href="images/favicon_io/site.webmanifest">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script
  src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
</head>
<body>
  <?php include("templatePageTop.php"); ?>
  <br />
  <br />
  <br />
  <br />
  <?php echo $pageleft; ?>
 <?php if($isUser) { ?>
   <div class="col 9 col-sm-9">
       <!-- Modal for post -->
        <div class="modal fade" id="regModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Post a Job</h4>
              </div>
              <div class="modal-body" style="padding:40px 50px;">
                <form role="form">
                  <div class="form-group">
                    <label for="jbtitle"><i class="fas fa-briefcase"></i> Job Title</label>
                    <input type="text" class="form-control" id="jobtitle" placeholder="Job Title" required>
                  </div>
                  <div class="form-group">
                    <label for="jbdesc"><i class="fas fa-clipboard-list"></i> Job Description</label>
                      <textarea type="text" class="form-control" row="8" id="jobdesc" placeholder="Job Description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="jbreqmt"><i class="fas fa-toolbox"></i> Skill Requirement</label>
                      <textarea type="text" class="form-control" row="8" id="jobreqmt" placeholder="Job Requirement"></textarea>
                  </div>
                  <div style="border: 1px solid lightgray;"><i class="fas fa-object-group"></i><b> Job Categories</b>   
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Agriculture, Food and Natural Resources">Agriculture, Food and Natural Resources</label>&nbsp;&nbsp;&nbsp; <label><input type="radio" name="optradio" value="Architecture and Construction">Architecture and Construction</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Arts, Audio/Video Tech and Communications">Arts, Audio/Video Technology and Communications</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Business Management and Administration">Business Management and Administration</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Education and Training">Education and Training</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Banking, Finance">Banking, Finance</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Health Science">Health Science</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Hospitality and Tourism">Hospitality and Tourism</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Human Services">Human Services</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Information Technology">Information Technology</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Law, Public Safety, Corrections and Security">Law, Public Safety, Corrections and Security</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Manufacturing">Manufacturing</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Marketing, Sales and Service">Marketing, Sales and Service</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Science, Technology, Engineering">Science, Technology, Engineering</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="optradio" value="Transportation, Distribution and Logistics">Transportation, Distribution and Logistics</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="optradio" value="Others">Others</label>
                  </div></div> 
                  <br>
                  <div class="form-group">
                    <label for="jbedu"><i class="fas fa-user-graduate"></i> Educational Requirement</label>
                      <textarea type="text" class="form-control" row="8" id="jobedu" placeholder="Educational Requirement"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="jbrenu"><i class="fas fa-hand-holding-usd"></i> Renumeration</label>
                    <input type="text" class="form-control" id="jobrenu" placeholder="Renumeration">
                  </div>
                  <div class="form-group">
                    <label for="jbother"><i class="fas fa-gift"></i> Other Benefits</label>
                      <textarea type="text" class="form-control" row="8" id="jobother" placeholder="Other Benefits"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="jbloc"><i class="fas fa-map-marker-alt"></i> Location</label>
                      <input type="text" class="form-control" id="jobloc" placeholder="Job Location" required>
                  </div>
                  <div class="form-group">
                    <label for="jbhow"><i class="fas fa-question-circle"></i> How to Apply</label>
                      <br>
                    <?php if(isset($website) && !empty($website)) { ?> 
                    <div>Visit Our Website
                    <input id="website" name="website" type="checkbox" value="website"></div>
                    <?php } else { ?>
                      <div>Visit Our Website
                    <input id="website" name="website" type="checkbox" value="website" disabled></div>
                      <?php } ?>
                      Provide other means of application:
                      <textarea type="jbhow" class="form-control" row="2" id="jobhow" placeholder="How to Apply"></textarea>
                  </div>
                    <button type="submit" id="postJobbtn" class="btn btn-success btn-block"><i class="fas fa-paper-plane"></i> Post</button>
                    <p id="jobstatus" style="text-align:center;"></p>
                </form>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              </div>
            </div>

          </div>
        </div>
        <!-- Ends Here -->
     <?php include("userhomefeed.php"); ?>
   </div>
<?php } else if($isAdmin)  { ?>
    <div class="col 9 col-sm-9">
    <!-- Modal for admin post -->
        <div class="modal fade" id="admregModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Post a Job</h4>
              </div>
              <div class="modal-body" style="padding:40px 50px;">
                <form role="form">
                  <div class="form-group">
                    <label for="admjbtitle"><i class="fas fa-briefcase"></i> Job Title</label>
                    <input type="text" class="form-control" id="admjobtitle" placeholder="Job Title" required>
                  </div>
                  <div class="form-group">
                    <label for="admcompdesc"><i class="fas fa-clipboard-list"></i> About The Company</label>
                      <textarea type="text" class="form-control" row="8" id="admcompdesc" placeholder="About the company"></textarea>
                    </div>
                  <div class="form-group">
                    <label for="admjbdesc"><i class="fas fa-clipboard-list"></i> Job Description</label>
                      <textarea type="text" class="form-control" row="8" id="admjobdesc" placeholder="Job Description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="admjbreqmt"><i class="fas fa-toolbox"></i> Skill Requirement</label>
                      <textarea type="text" class="form-control" row="8" id="admjobreqmt" placeholder="Job Requirement"></textarea>
                  </div>
                  <div style="border: 1px solid lightgray;"><i class="fas fa-object-group"></i><b> Job Categories</b>   
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Agriculture, Food and Natural Resources">Agriculture, Food and Natural Resources</label>&nbsp;&nbsp;&nbsp; <label><input type="radio" name="admoptradio" value="Architecture and Construction">Architecture and Construction</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Arts, Audio/Video Tech and Communications">Arts, Audio/Video Technology and Communications</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Business Management and Administration">Business Management and Administration</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Education and Training">Education and Training</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Banking, Finance">Banking, Finance</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Health Science">Health Science</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Hospitality and Tourism">Hospitality and Tourism</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Human Services">Human Services</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Information Technology">Information Technology</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Law, Public Safety, Corrections and Security">Law, Public Safety, Corrections and Security</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Manufacturing">Manufacturing</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Marketing, Sales and Service">Marketing, Sales and Service</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Science, Technology, Engineering">Science, Technology, Engineering</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="admoptradio" value="Transportation, Distribution and Logistics">Transportation, Distribution and Logistics</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="admoptradio" value="Others">Others</label>
                  </div></div> 
                  <br>
                    
                  <div class="form-group">
                    <label for="admjbedu"><i class="fas fa-user-graduate"></i> Educational Requirement</label>
                      <textarea type="text" class="form-control" row="8" id="admjobedu" placeholder="Educational Requirement"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="admjbrenu"><i class="fas fa-hand-holding-usd"></i> Renumeration</label>
                    <input type="text" class="form-control" id="admjobrenu" placeholder="Renumeration">
                  </div>
                  <div class="form-group">
                    <label for="admjbother"><i class="fas fa-gift"></i> Other Benefits</label>
                      <textarea type="text" class="form-control" row="8" id="admjobother" placeholder="Other Benefits"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="admjbloc"><i class="fas fa-map-marker-alt"></i> Location</label>
                      <input type="text" class="form-control" id="admjobloc" placeholder="Job Location" required>
                  </div>
                  <div class="form-group">
                    <label for="admjbhow"><i class="fas fa-question-circle"></i> How to Apply</label>
                    <div>Enter Company Website:
                    <input type="text" class="form-control" id="admwebsite" placeholder="Company Website, e.g. www.example.com"></div>
                    Or provide other means of application:
                      <textarea type="admjbhow" class="form-control" row="2" id="admjobhow" placeholder="How to Apply"></textarea>
                  </div>
                    <button type="button" id="admPostJobbtn" onclick=admPostJob(); class="btn btn-success btn-block"><i class="fas fa-paper-plane"></i> Post</button>
                    <p id="admjobstatus" style="text-align:center;"></p>
                </form>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              </div>
            </div>

          </div>
        </div>
        <!-- Ends Here -->
  <?php include("admin.php"); ?>
    </div>
<?php } else if($isSupport) { ?>
  <div class="col 9 col-sm-9">
    <!-- Modal for admin post -->
        <div class="modal fade" id="sptregModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Post a Job</h4>
              </div>
              <div class="modal-body" style="padding:40px 50px;">
                <form role="form">
                  <div class="form-group">
                    <label for="sptjbtitle"><i class="fas fa-briefcase"></i> Job Title</label>
                    <input type="text" class="form-control" id="sptjobtitle" placeholder="Job Title" required>
                  </div>
                  <div class="form-group">
                    <label for="sptcompdesc"><i class="fas fa-clipboard-list"></i> About The Company</label>
                      <textarea type="text" class="form-control" row="8" id="sptcompdesc" placeholder="About the company"></textarea>
                    </div>
                  <div class="form-group">
                    <label for="sptjbdesc"><i class="fas fa-clipboard-list"></i> Job Description</label>
                      <textarea type="text" class="form-control" row="8" id="sptjobdesc" placeholder="Job Description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="sptjbreqmt"><i class="fas fa-toolbox"></i> Skill Requirement</label>
                      <textarea type="text" class="form-control" row="8" id="sptjobreqmt" placeholder="Job Requirement"></textarea>
                  </div>
                  <div style="border: 1px solid lightgray;"><i class="fas fa-object-group"></i><b> Job Categories</b>   
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Agriculture, Food and Natural Resources">Agriculture, Food and Natural Resources</label>&nbsp;&nbsp;&nbsp; <label><input type="radio" name="sptoptradio" value="Architecture and Construction">Architecture and Construction</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Arts, Audio/Video Tech and Communications">Arts, Audio/Video Technology and Communications</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Business Management and Administration">Business Management and Administration</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Education and Training">Education and Training</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Banking, Finance">Banking, Finance</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Health Science">Health Science</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Hospitality and Tourism">Hospitality and Tourism</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Human Services">Human Services</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Information Technology">Information Technology</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Law, Public Safety, Corrections and Security">Law, Public Safety, Corrections and Security</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Manufacturing">Manufacturing</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Marketing, Sales and Service">Marketing, Sales and Service</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Science, Technology, Engineering">Science, Technology, Engineering</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="sptoptradio" value="Transportation, Distribution and Logistics">Transportation, Distribution and Logistics</label>&nbsp;&nbsp;&nbsp;<label><input type="radio" name="sptoptradio" value="Others">Others</label>
                  </div></div> 
                  <br>
                  <div class="form-group">
                    <label for="sptjbedu"><i class="fas fa-user-graduate"></i> Educational Requirement</label>
                      <textarea type="text" class="form-control" row="8" id="sptjobedu" placeholder="Educational Requirement"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="sptjbrenu"><i class="fas fa-hand-holding-usd"></i> Renumeration</label>
                    <input type="text" class="form-control" id="sptjobrenu" placeholder="Renumeration">
                  </div>
                  <div class="form-group">
                    <label for="sptjbother"><i class="fas fa-gift"></i> Other Benefits</label>
                      <textarea type="text" class="form-control" row="8" id="sptjobother" placeholder="Other Benefits"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="sptjbloc"><i class="fas fa-map-marker-alt"></i> Location</label>
                      <input type="text" class="form-control" id="sptjobloc" placeholder="Job Location" required>
                  </div>
                  <div class="form-group">
                    <label for="sptjbhow"><i class="fas fa-question-circle"></i> How to Apply</label>
                    <div>Enter Company Website:
                    <input type="text" class="form-control" id="sptwebsite" placeholder="Company Website, e.g. www.example.com"></div>
                    Or provide other means of application:
                      <textarea type="sptjbhow" class="form-control" row="2" id="sptjobhow" placeholder="How to Apply"></textarea>
                  </div>
                    <button type="button" id="sptPostJobbtn" onclick=sptPostJob(); class="btn btn-success btn-block"><i class="fas fa-paper-plane"></i> Post</button>
                    <p id="sptjobstatus" style="text-align:center;"></p>
                </form>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              </div>
            </div>

          </div>
        </div>
        <!-- Ends Here -->
  <?php include("support.php"); ?>
    </div>
<?php } else if($isBilling) { ?>
  <?php echo 'I\'m a Billing'; ?>
<?php } else if($isSuperadmin) { ?>
    <?php include("superadmin.php"); ?>
<?php } ?>

  <?php //include_once("template_pageRight.php"); ?>

  <link rel="stylesheet" href="style/style.css">
  <script src="js/functions.js"></script>
</body>
