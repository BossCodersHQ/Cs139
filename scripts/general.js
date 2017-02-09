//lists page

$(document).ready(function(){
	$('#addList').click(function(){
		if(!$('#addListName').is(":visible")){

				$('#addListName').toggle();
				$("#addList h2").text("Go!");
				$("#addList").css('background-color', 'rgba(60, 120, 60, 0.8)');

			} else {
				if($.trim($('#addListName').val()) == "" || $.trim($('#addListName').val()).length >=30) {
					alert("Not a valid name");
				}
		$.post('scripts/insertDB.php', {name: $('#addListName').val()}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */

				$('#addListName').toggle();		
				$("#addList h2").text("Add new list");
				$("#addList").css('background-color', 'rgba(60, 60, 60, 0.8)');
				$('#addListName').val("");
				console.log(data);

		});
	}
	});
});
