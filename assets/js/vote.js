$(document).ready(function(){
	fillCandidateList(candidate_list);
});
function fillCandidateList(list) {
	let content = "";
	for(var user of list) {
		content += "<option value='"+user['id']+"'>"+user['bruker']+"</option>"
	}
	$("#candidateid").html(content);
}

$('#voteForm').on('submit', (function(e) {
    e.preventDefault()
    var formData = new FormData(this);
    formData.append('endpoint', 'do_vote');

    $.ajax({
        type:'POST',
        url: '../includes/dashboard.php',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
        	var json_data = JSON.parse(data)

        	if(json_data['status'] == 'SUCCESS'){
        		$('.avatar').css('background-image', "url(../assets/images/profile/" + json_data['img_url'] + ")");

	        	$.alert({
	              title: 'Success',
	              icon: 'far fa-check-circle',
	              type: 'green',
	              boxWidth: '500px',
	              useBootstrap: false,
	              animation: 'none',
	              content: "<section class='text-center'>" + json_data['message'] + "<section>"
	            });
	            $('#voteForm').parents(".jconfirm").remove();
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

          resetImg();
        },
        error: function(data){}
    });

    $(this).trigger("reset");
}));