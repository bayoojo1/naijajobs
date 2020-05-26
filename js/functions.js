// Login function
function login() {
    var e = $('#usrname').val()
    var p = $('#psw').val()
    var r = $('#checkbx').is(':checked')
    if (e == '' || p == '') {
        $('#loginstatus').html('<span style="color:red;"><b>Fill out all of the form data</b></span>').fadeOut(20000);
        return false;
    } else {
        $('#logbtn').css('display','none');
            //$("#loginstatus").html('please wait ...');
        $('#loginstatus').html('<span style="color:#004080;">Please wait...</span><img src="images/loading2.gif" height="30", width="30">');
        var xhttp
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest()
        } else {
            // code for IE6, IE5
            xhttp = new ActiveXObject('Microsoft.XMLHTTP')
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'login_failed') {
                    $('#loginstatus').html('<span style="color:red;"><b>You did not provide either email or password!</b></span>').fadeOut(20000);
                    $('#logbtn').css('display','block');
                    return false;
                } else if(this.responseText == 'invalid') {
                  $('#loginstatus').html('<span style="color:red;"><b>You are yet to activate your account, or you provided a wrong password!</b></span>').fadeOut(20000);
                  $('#logbtn').css('display','block');
                  return false;
                } else {
                    window.location = 'user.php?u=' + this.responseText
                }
            }
        }
        xhttp.open('POST', 'index.php', true)
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.send('e=' + e + '&p=' + p + '&r=' + r)
    }
}

// To bring up the login modal
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
// To bring up the registration modal and hide the login modal
$(document).ready(function(){
  $("#regBtn").click(function(){
    $("#regModal").modal();
    $("#myModal").modal('hide');
  });
});

// To bring up the forgot password modal and hide the login modal
$(document).ready(function(){
  $("#forgotpassword").click(function(){
    $("#forgotModal").modal();
    $("#myModal").modal('hide');
  });
});
// To bring up the registration modal from the register button on the landing page
$(document).ready(function(){
  $("#provReg").click(function(){
    $("#regModal").modal();
  });
});

// To bring up the admin job posting modal
$(document).ready(function(){
  $("#admUserReg").click(function(){
    $("#admregModal").modal();
  });
});

// To bring up the support job posting modal
$(document).ready(function(){
  $("#sptUserReg").click(function(){
    $("#sptregModal").modal();
  });
});

// Function for user registration
function signup(){
    var e = $("#signupusrname").val();
    var p1 = $("#signuppsw").val();
    var p2 = $("#signuppsw1").val();
    var status = $("#regstatus");
    if(e == "" || p1 == "" || p2 == ""){
        status.html('<span style="color:red;"><b>Fill out all of the form data</b></span>').fadeOut(20000);
        return false;
    } else if(p1 != p2){
        status.html('<span style="color:red;"><b>Your password fields do not match</b></span>').fadeOut(20000);
        return false;
    } else if(!document.getElementById("checkbox_id").checked){
        status.html('<span style="color:red;"><b>You must accept the terms and condition to register</b></span>').fadeOut(20000);
        return false;
    } else {
        $("#signupbtn").css('display','none');
        status.html('Please wait...<img src="images/loading2.gif" height="30", width="30">');
        var xhttp
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest()
        } else {
            // code for IE6, IE5
            xhttp = new ActiveXObject('Microsoft.XMLHTTP')
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != 'signup_success') {
                    status.html(ajax.responseText).fadeOut(20000);
                    $("#signupbtn").css('display', 'block');
                    return false;
                } else {
                    $("#signupbtn").css('display', 'none');
                    //window.scrollTo(0,0);
                    status.html("<h3>OK, check your email inbox and junk mail box at <u>"+e+"</u> in a moment to complete the sign up process by activating your account. You need to do this within 24 hours. You will not be able to do anything on the site until you successfully activate your account.</h3>");
                }
            }
        }
        xhttp.open('POST', 'signup.php', true)
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.send('e=' + e + '&p=' + p1)
    }
}

function forgotpwd() {
    var e = $('#forgotmail').val();
    if (e == '') {
        $('#forgotstatus').html('Type in your email address').fadeOut(20000);
    } else {
        $('#forgotbtn').css('display', 'none');
        $('#forgotstatus').html('Please wait...<img src="images/loading2.gif" height="30", width="30">');
        var xhttp
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest()
        } else {
            // code for IE6, IE5
            xhttp = new ActiveXObject('Microsoft.XMLHTTP')
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'success') {
                    $('#forgotstatus').html('<h3>Check your email inbox in a few minutes</h3>').fadeOut(50000);
                } else if (this.responseText == 'no_exist') {
                    $('#forgotstatus').html('Sorry that email address is not in our system').fadeOut(20000);
                } else if (this.responseText == 'email_send_failed') {
                    $('#forgotstatus').html('Mail function failed to execute').fadeOut(20000);
                } else {
                    $('#forgotstatus').html('An unknown error occurred, please check the email you supplied!').fadeOut(20000);
                }
            }
        }
        xhttp.open('POST', 'forgot_pass.php', true)
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.send('e=' + e)
    }
}

$(document).ready(function() {
  $('#postJobbtn').click(function(event) {
    event.preventDefault()
    var jobtitle = $("#jobtitle").val();
    var jobdesc = $("#jobdesc").val();
    var jobreqmt = $("#jobreqmt").val();
    var jobcategory = $("input[name='optradio']:checked").val();
    var jobedu = $("#jobedu").val();
    var jobrenu = $("#jobrenu").val();
    var jobother = $("#jobother").val();
    var jobloc = $("#jobloc").val();
    var website = $("input[name='website']:checked").val();
    var jobhow = $("#jobhow").val();
    if (jobtitle == '' || jobloc == '' || jobcategory == '') {
        $('#jobstatus').html('Please fill the required fields').fadeOut(20000);
        return false;
    } else {
        $('#postJobbtn').css('display', 'none');
        $('#jobstatus').html('Please wait...<img src="images/loading2.gif" height="30", width="30">');
        var xhttp
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest()
        } else {
            // code for IE6, IE5
            xhttp = new ActiveXObject('Microsoft.XMLHTTP')
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'success') {
                    $('#jobstatus').html('<h3>Your job has been posted.</h3>').fadeOut(20000);
                } else {
                    $('#jobstatus').html('An unknown error occurred, please try again later.').fadeOut(20000);
                }
            }
        }
        xhttp.open('POST', 'functions/jobposting.php', true)
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.send('jobtitle=' + jobtitle + '&jobdesc=' + jobdesc + '&jobreqmt=' + jobreqmt + '&jobcategory=' + jobcategory + '&jobedu=' + jobedu + '&jobrenu=' + jobrenu + '&jobother=' + jobother + '&jobloc=' + jobloc + '&website=' + website + '&jobhow=' + jobhow)
      }
  })
})

function admPostJob() {
    var admjobtitle = $("#admjobtitle").val();
    var admcompdesc = $("#admcompdesc").val();
    var admjobdesc = $("#admjobdesc").val();
    var admjobreqmt = $("#admjobreqmt").val();
    var admjobcategory = $("input[name='admoptradio']:checked").val();
    var admjobedu = $("#admjobedu").val();
    var admjobrenu = $("#admjobrenu").val();
    var admjobother = $("#admjobother").val();
    var admjobloc = $("#admjobloc").val();
    var admwebsite = $("#admwebsite").val();
    var admjobhow = $("#admjobhow").val();
    if (admjobtitle == '' || admjobloc == '' || admjobcategory == '') {
        $('#admjobstatus').html('Please fill the required fields').fadeOut(20000);
        return false;
    } else {
        $('#admPostJobbtn').css('display', 'none');
        $('#admjobstatus').html('Please wait...<img src="images/loading2.gif" height="30", width="30">');
        var xhttp
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest()
        } else {
            // code for IE6, IE5
            xhttp = new ActiveXObject('Microsoft.XMLHTTP')
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'success') {
                    $('#admjobstatus').html('<h3>Your job has been posted.</h3>').fadeOut(20000);
                } else {
                    $('#admjobstatus').html('An unknown error occurred, please try again later.').fadeOut(20000);
                }
            }
        }
        xhttp.open('POST', 'functions/admjobposting.php', true)
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.send('admjobtitle=' + admjobtitle + '&admcompdesc=' + admcompdesc + '&admjobdesc=' + admjobdesc + '&admjobreqmt=' + admjobreqmt + '&admjobcategory=' + admjobcategory + '&admjobedu=' + admjobedu + '&admjobrenu=' + admjobrenu + '&admjobother=' + admjobother + '&admjobloc=' + admjobloc + '&admwebsite=' + admwebsite + '&admjobhow=' + admjobhow)
      }
}

function sptPostJob() {
    var sptjobtitle = $("#sptjobtitle").val();
    var sptcompdesc = $("#sptcompdesc").val();
    var sptjobdesc = $("#sptjobdesc").val();
    var sptjobreqmt = $("#sptjobreqmt").val();
    var sptjobcategory = $("input[name='sptoptradio']:checked").val();
    var sptjobedu = $("#sptjobedu").val();
    var sptjobrenu = $("#sptjobrenu").val();
    var sptjobother = $("#sptjobother").val();
    var sptjobloc = $("#sptjobloc").val();
    var sptwebsite = $("#sptwebsite").val();
    var sptjobhow = $("#sptjobhow").val();
    if (sptjobtitle == '' || sptjobloc == '' || sptjobcategory == '') {
        $('#sptjobstatus').html('Please fill the required fields').fadeOut(20000);
        return false;
    } else {
        $('#sptPostJobbtn').css('display', 'none');
        $('#sptjobstatus').html('Please wait...<img src="images/loading2.gif" height="30", width="30">');
        var xhttp
        if (window.XMLHttpRequest) {
            // code for modern browsers
            xhttp = new XMLHttpRequest()
        } else {
            // code for IE6, IE5
            xhttp = new ActiveXObject('Microsoft.XMLHTTP')
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'success') {
                    $('#sptjobstatus').html('<h3>Your job has been posted.</h3>').fadeOut(20000);
                } else {
                    $('#sptjobstatus').html('An unknown error occurred, please try again later.').fadeOut(20000);
                }
            }
        }
        xhttp.open('POST', 'functions/sptjobposting.php', true)
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhttp.send('sptjobtitle=' + sptjobtitle + '&sptcompdesc=' + sptcompdesc + '&sptjobdesc=' + sptjobdesc + '&sptjobreqmt=' + sptjobreqmt + '&sptjobcategory=' + sptjobcategory + '&sptjobedu=' + sptjobedu + '&sptjobrenu=' + sptjobrenu + '&sptjobother=' + sptjobother + '&sptjobloc=' + sptjobloc + '&sptwebsite=' + sptwebsite + '&sptjobhow=' + sptjobhow)
      }
}

function approve(id) {
  $(document).ready(function(){
    var conf = confirm('Are you sure you want to approve this job posting?')
    if (conf != true) {
        return false;
    }
    status = id.split('_')[1]
    profile_id = id.split('_')[2]
    $.ajax({
        url: 'functions/jobapprove.php',
        type: 'POST',
        data: { status: status, profile_id: profile_id },
        success: function(response) {
            if (response == "already_approved") {
                alert('You cannot approve a job posting twice! This is already approved.')
            } else if(response.indexOf('success') > -1) {
              alert('Successfully approved.')
            }
        }
    })
  });
}

$(document).ready(function() {
    $('#admwebsite').on('keyup', function() {
        if ($('#admwebsite').val() != '') {
            $('#admjobhow').prop('disabled', true)
        } else if ($('#admwebsite').val() == '') {
            $('#admjobhow').prop('disabled', false)
        }  
    })
})

$(document).ready(function() {
    $('#admjobhow').on('keyup', function() {
        if ($('#admjobhow').val() != '') {
            $('#admwebsite').prop('disabled', true)
        } else if ($('#admjobhow').val() == '') {
            $('#admwebsite').prop('disabled', false)
        }  
    })
})

$(document).ready(function() {
    $('#sptwebsite').on('keyup', function() {
        if ($('#sptwebsite').val() != '') {
            $('#sptjobhow').prop('disabled', true)
        } else if ($('#sptwebsite').val() == '') {
            $('#sptjobhow').prop('disabled', false)
        }  
    })
})

$(document).ready(function() {
    $('#sptjobhow').on('keyup', function() {
        if ($('#sptjobhow').val() != '') {
            $('#sptwebsite').prop('disabled', true)
        } else if ($('#sptjobhow').val() == '') {
            $('#sptwebsite').prop('disabled', false)
        }  
    })
})

$(document).ready(function() {
    $('#website').on('click', function(){ 
      if($("#website").is(":checked")){ 
            $('#jobhow'). attr('disabled','disabled') 
        }else{ 
           $('#jobhow').removeAttr('disabled')
        } 
    })
})

$(document).ready(function() {
    $('#jobhow').on('keyup', function(){ 
      if($("#jobhow").val() != ''){ 
            $('#website'). attr('disabled','disabled') 
        }else{ 
           $('#website').removeAttr('disabled')
        } 
    })
})

function sendPhoto() {
  $(document).ready(function(){
     filepath = $("#filepath").val();
     chatid = $("#chatid").val();
     caption = $("#caption").val();   
    $.ajax({
        url: 'functions/sendphoto_display.php',
        type: 'POST',
        data: { filepath: filepath, chatid: chatid, caption: caption },
        success: function(response) {
            if (response.indexOf('success') > -1) {
                $("#poststatus").html('Photo successfully posted!')
            } else {
              $("#poststatus").html('ERROR, Photo Not Sent!')
            }
            $("#sendPhotoBtn").attr('disabled','disabled')
            $("#filepath").val('')
            $("#chatid").val('')
            $("#caption").val('')
            $('#sendPhotoBtn').removeAttr('disabled')
        }
    })
  });
}