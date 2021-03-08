$('#registerForm').on('submit', (function(e) {
  e.preventDefault()
  var formData = new FormData(this);
  formData.append('endpoint', 'register');

  $.ajax({
      type:'POST',
      url: 'includes/registering_sjekk.php',
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      success:function(data){
      	var json_data = JSON.parse(data)
      	if(json_data['status'] == 'SUCCESS'){
      		$.alert({
            title: 'Success',
            icon: 'far fa-check-circle',
            type: 'green',
            boxWidth: '500px',
            useBootstrap: false,
            animation: 'none',
            content: "<section class='text-center'>" + json_data['message'] + "<section>"
          });

          $('#registerForm').trigger("reset");
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
      error: function(data){
        $(this).trigger("reset");
      }
  });

  
}));