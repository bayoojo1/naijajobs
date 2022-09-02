function submitMessage(id) {
  $(document).ready(function(){
    chatid = id
    name = $('#name').val()
    message = $('#message').val()
    $.ajax({
        url: 'functions/message.php',
        type: 'POST',
        data: { id: chatid, name: name, message: message },
        success: function(response) {
            if(response == 'success') {
              $('#messageStatus').html('Thanks for your message. We would get back to you soon.')
            }
        }
    })
  });
}
