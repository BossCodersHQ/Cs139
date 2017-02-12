//lists page

//addnewlists
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
                getLists();
				$('#addListName').toggle();		
				$("#addList h2").text("Add new list");
				$("#addList").css('background-color', 'rgba(60, 60, 60, 0.8)');
				$('#addListName').val("");

		});
	}

	});

        $(document).on('click','.remove',function() {
		$.post('scripts/DeleteTable.php', {id: $(this).attr('id') }, function(data, textStatus, xhr) {
			    		console.log(data);
			getLists();
		});
    });


});

function checkExistingLogins(type) {
	  //runs the script to check if the username is available every time a new character is entered
    var userTextField = $('input[name="'+type+'"]');
    userTextField.keyup(function() {
    	console.log("keyup registered");
        var newuser2 = userTextField.val();
        $.post('scripts/UsernameCheck.php', {
            newuser: newuser2
        }, function(result) {
          //the server side script should return '1' if the username is available
            userTextField[0].setCustomValidity("");
            $('#regError'+type).empty();

            if (result == 0) {
                //username unavailable
                userTextField[0].setCustomValidity("This +"+type+" + is already taken");
                $('#regError'+type).append('This '+type+' is taken');
            }
        });
    });
}

function getLists() {
		$('#listOfLists').empty();
		$.post('scripts/loadlists.php', {}, function(data, textStatus, xhr) {
		$('#listOfLists').append(data);
	});
}

$(document).ready(function() {
	console.log("General.js Loaded succesfully");
	checkExistingLogins('Username');
	checkExistingLogins('Email');
});

$(document).ready(function() {
	getLists();
});