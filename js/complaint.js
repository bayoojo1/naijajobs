function submitComplaint(id) {
  $(document).ready(function(){
    jobId = id
    mail = $('#mail').val()
    complaint = $('#complaint').val()
    $.ajax({
        url: 'functions/complaint.php',
        type: 'POST',
        data: { id: jobId, mail: mail, complaint: complaint },
        success: function(response) {
            if(response == 'success') {
              $('#compStatus').html('Thanks for your submission. We would act on this information')
            }
        }
    })
  });
}
