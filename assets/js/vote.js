$(document).ready(function(){
	fillCandidateList(candidate_list);
	fillElectionList(election_list);
});
function fillCandidateList(list) {
	let content = "";
	for(var user of list) {
		content += "<option value='"+user['id']+"'>"+user['bruker']+"</option>"
	}
	$("#candidateid").html(content);
}

function fillElectionList(list) {
	let content = "";
	for(var election of list) {
		content += "<option value='"+election['id']+"'>"+election['title']+" ( "+election['startvalg']+" - "+election['sluttvalg'] +") </option>"
	}
	// console.log(content);
	document.getElementById('electionid').innerHTML = content;
	document.getElementById('startvalg').value = list[0]['startvalg'];
	document.getElementById('sluttvalg').value = list[0]['sluttvalg'];
	document.getElementById('information').value = list[0]['description'];
}

// $('#voteForm').on('submit', (function(e) {
//     e.preventDefault()
//     var formData = new FormData(this);
//     formData.append('endpoint', 'do_vote');

//     $.ajax({
//         type:'POST',
//         url: '../includes/dashboard.php',
//         data:formData,
//         cache:false,
//         contentType: false,
//         processData: false,
//         success:function(data){
//         	var json_data = JSON.parse(data)

//         	if(json_data['status'] == 'SUCCESS'){
//         		$('.avatar').css('background-image', "url(../assets/images/profile/" + json_data['img_url'] + ")");

// 	        	$.alert({
// 	              title: 'Success',
// 	              icon: 'far fa-check-circle',
// 	              type: 'green',
// 	              boxWidth: '500px',
// 	              useBootstrap: false,
// 	              animation: 'none',
// 	              content: "<section class='text-center'>" + json_data['message'] + "<section>"
// 	            });
// 	            $('#voteForm').parents(".jconfirm").remove();
//         	}
//         	else{
// 				$.alert({
// 	              title: 'Error',
// 	              icon: 'fas fa-exclamation-triangle',
// 	              type: 'red',
// 	              boxWidth: '500px',
// 	              useBootstrap: false,
// 	              animation: 'none',
// 	              content: "<section class='text-center'>" + json_data['message'] + "<section>"
// 	            });
//         	}

//           resetImg();
//         },
//         error: function(data){}
//     });

//     $(this).trigger("reset");
// }));

document.getElementById('electionid').addEventListener('change', function(event){
	console.log('ffff');
	console.log(event.target.value);
	for ( var election of election_list) {
		if(election['id'] == event.target.value) {
			document.getElementById('startvalg').value = election['startvalg'];
			document.getElementById('sluttvalg').value = election['sluttvalg'];
			document.getElementById('information').value = election['description'];
		}
	}
});