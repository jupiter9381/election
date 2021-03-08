$( document ).ready(function() {
   $("#epost").focus()
});


$('#loginForm').on('submit', (function(e) {
  e.preventDefault()
  var formData = new FormData(this);
  formData.append('endpoint', 'login');

  $.ajax({
      type:'POST',
      url: 'includes/login.php',
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      success:function(data){
        var json_data = JSON.parse(data)
        if(json_data['status'] == 'SUCCESS'){
          $("#mess_mess").html(json_data['message'])
          $("#mess_modal").show()

          setTimeout(function(){ 
            window.location.href= "dashboard/";
          }, 1000);
        }
        else{
          $.alert({
            title: 'Error',
            icon: 'fas fa-exclamation-triangle',
            type: 'red',
            boxWidth: '500px',
            useBootstrap: false,
            animation: 'none',
            content: "<section class='text-center'>" + json_data['message'] + "<section>"
          });
        }
      },
      error: function(data){}
  });

  $(this).trigger("reset");
}));