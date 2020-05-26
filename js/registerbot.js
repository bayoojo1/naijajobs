$(document).ready(function() {
  $('#submitBotReg').click(function(event) {
    event.stopImmediatePropagation()
    var token = $('#token').val()
    var url = $('#url').val()
    var port = $('#port').val()
    var conn = $('#conn').val()
    if(token == '' || url == '' || port == '' || conn == '') {
      alert('Please provide all info')
      return false;
    }
    $.ajax({
        url: 'functions/registerbot_func.php',
        type: 'POST',
        data: { token: token, url: url, port: port, conn: conn },
        success: function(response) {
          if(response != '') {
            $('#status').html(response)
          }
        }
    })
  })
});