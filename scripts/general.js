//lists page

//addnewlists
$(document).ready(function(){

var currentListData;
var nameText = $('.itemBlock input[type="text"]');
var textArea = $('.itemBlock textarea');

	console.log("General.js Loaded succesfully");
	checkExistingLogins('Username');
	checkExistingLogins('Email');
	getLists();

	$('#addList').click(function(){
		
		if(!$('#addListName').is(":visible")){

				$('#addListName').slideToggle("slow");
				$("#addList h2").text("Go!");
				$("#addList").css('background-color', 'rgba(60, 120, 60, 0.8)');

			} else {
				if($.trim($('#addListName').val()) == "" || $.trim($('#addListName').val()).length >20) {
					alert("Not a valid name");
				} else{
		$.post('scripts/insertDB.php', {name: $('#addListName').val()}, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
                getLists();
				$('#addListName').slideToggle("slow");		
				$("#addList h2").text("Add new list");
				$("#addList").css('background-color', 'rgba(60, 60, 60, 0.8)');
				$('#addListName').val("");

		});
	}
	}

	});

        $(document).on('click','.remove',function() {
		$.post('scripts/DeleteTable.php', {id: $(this).attr('id') }, function(data, textStatus, xhr) {
			    		console.log(data);
			getLists();
		});
    });

         $('#listOfLists').on('click','.listTitle div',function() {

         	    $('.listTitle div').removeClass('active');
                $(this).toggleClass('active');

                $('#listItemForm').slideUp("slow");		
				$("#addListItem h2").text("Add new list");
				$("#addListItem").css('background-color', 'rgba(60, 60, 60, 0.8)');
				nameText.val("");
				textArea.val("")

         

		$.post('scripts/SelectList.php', {id: $(this).attr('id').slice(5) }, function(data, textStatus, xhr) {
	//retrieve query from database in the form of JSON
		    		console.log(data);
		    		$('.eachItem').slideUp("400", function() {
		    			$(this).remove();

		    		});
		    		currentListData = "";
	//parse the JSON to an Associative Array and sent it to a higher scope variable to be used by other functions
		    		if(currentListData = JSON.parse(data)) {
		    			var i = 0;
		    		//	console.log(currentListData["listItem"]["0"]["itemText"]);
		    			for(var i = 0; i < currentListData["listItem"].length; i++) {

		    				var currentItemBlock = $('<div/>', {
    									'id':'itemBlock'+i,
    									'class':'itemBlock eachItem',
									}).appendTo('#middle');

		    				var currentItemInfo = $('<div/>', {
    									'class':'itemInfo notCompletedItem',
									}).appendTo(currentItemBlock);

		    				$('<div/>', {
    									'class':'itemBody',
    									'text':currentListData["listItem"][i]["itemText"], 
									}).appendTo(currentItemBlock);


		    				if(currentListData["listItem"][i]["completion"]) {
		    					currentItemInfo.toggleClass('completedItem');
		    				}
		    				var creationDate = new Date(currentListData["listItem"][i]["creation"] * 1000);



		    				   
		    			}
		    			$('.itemBlock').slideDown('400', function() { });
		    		}

		});
    });

         	$('#addListItem').click(function(){

         		var currentID = currentListData["list"]["listID"];

		if(!$('#listItemForm').is(":visible")){

				$('#listItemForm').slideToggle("slow");
				$("#addListItem h2").text("Go!");
				$("#addListItem").css('background-color', 'rgba(120, 60, 180, 0.8)');

			} else {
				if($.trim(nameText.val()) == "" || $.trim($('#listItemForm').val()).length >20) {
					alert("Not a valid name");
				} else {

		$.post('scripts/InsertListItem.php', {label: nameText.val(),itemText: textArea.val(),id: currentID  }, function(data, textStatus, xhr) {
			/*optional stuff to do after success */
             //   getLists();
             console.log(data);
				$('#listItemForm').slideToggle("slow");		
				$("#addListItem h2").text("Add new list");
				$("#addListItem").css('background-color', 'rgba(60, 60, 60, 0.8)');
				nameText.val("");
				textArea.val("")

		});
	}
	}

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