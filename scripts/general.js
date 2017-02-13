//lists page

//addnewlists
$(document).ready(function() {
    var globalS;
    var currentListData;
    var nameText = $('.itemBlock input[type="text"]');
    var textArea = $('.itemBlock textarea');

    console.log("General.js Loaded succesfully");
    checkExistingLogins('Username');
    checkExistingLogins('Email');
    getLists();

    $('#addList').click(function() {

        if (!$('#addListName').is(":visible")) {

            $('#addListName').slideToggle("slow");
            $("#addList h2").text("Go!");
            $("#addList").css('background-color', 'rgba(60, 120, 60, 0.8)');

        } else {
            if ($.trim($('#addListName').val()) == "" || $.trim($('#addListName').val()).length > 40) {
                alert("Not a valid name");
            } else {
                $.post('scripts/insertDB.php', {
                    name: $('#addListName').val()
                }, function(data, textStatus, xhr) {
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

    $(document).on('click', '.remove', function() {
        $.post('scripts/DeleteTable.php', {
            id: $(this).attr('id')
        }, function(data, textStatus, xhr) {
            console.log(data);
            getLists();
        });
    });



    $('#listOfLists').on('click', '.listTitle div', function() {

        $('.listTitle div').removeClass('active');
        $(this).toggleClass('active');

        $('#listItemForm').slideUp("slow");
        $("#addListItem h2").text("Add a new List Item");
        $("#addListItem").css('background-color', 'rgba(60, 60, 60, 0.8)');
        nameText.val("");
        textArea.val("")

        getListItems($(this).attr('id').slice(5));



    });

    $(document).on('click', '.incompleteItemButton', function() {

        $.post('scripts/CompleteItem.php', {
            id: $(this).attr('id').slice(4)
        }, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            console.log(data);
            getListItems(currentListData["list"]["listID"]);
        });
    });


     $(document).on('click', '.deleteItemButton', function() {

        $.post('scripts/DeleteItem.php', {
            id: $(this).attr('id').slice(4)
        }, function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            console.log(data);
            getListItems(currentListData["list"]["listID"]);
        });
    });   

    $('#addListItem').click(function() {
        console.log(currentListData);
        var currentID = currentListData["list"]["listID"];

        if (!$('#listItemForm').is(":visible")) {

            $('#listItemForm').slideToggle("slow");
            $("#addListItem h2").text("Go!");
            $("#addListItem").css('background-color', 'rgba(120, 60, 180, 0.8)');

        } else {
            if ($.trim(nameText.val()) == "" || $.trim($('#listItemForm').val()).length > 20) {
                alert("Not a valid name");
            } else {

                $.post('scripts/InsertListItem.php', {
                    label: nameText.val(),
                    itemText: textArea.val(),
                    id: currentID
                }, function(data, textStatus, xhr) {
                    /*optional stuff to do after success */
                    //   getLists();
                    console.log(data);
                    $('#listItemForm').slideToggle("slow");
                    $("#addListItem h2").text("Add a new List Item");
                    $("#addListItem").css('background-color', 'rgba(60, 60, 60, 0.8)');
                    nameText.val("");
                    textArea.val("")
                    getListItems(currentID);

                });
            }
        }

    });

    function getLists() {
        $('#listOfLists').empty();
        $.post('scripts/loadlists.php', {}, function(data, textStatus, xhr) {
        	console.log(data);
            $('#listOfLists').append(data); //generation of list table html done in php
        });
    }

    function getListItems(listID) {
        $.post('scripts/SelectList.php', {
            id: listID
        }, function(data, textStatus, xhr) {
            //retrieve query from database in the form of JSON
            console.log(data);
            $('.eachItem').slideUp("10", function() {
                $(this).remove();
            });
            currentListData = "";
            console.log(currentListData);
            //parse the JSON to an Associative Array and sent it to a higher scope variable to be used by other functions
            currentListData = JSON.parse(data);
            console.log(currentListData);
            console.log(JSON.parse(data));
            if ((currentListData = JSON.parse(data)) && (currentListData["listItem"])) {

                var i = 0;
                //	console.log(currentListData["listItem"]["0"]["itemText"]);
                for (var i = 0; i < currentListData["listItem"].length; i++) {

                    var currentItemBlock = $('<div/>', {
                        'id': 'itemBlock' + i,
                        'class': 'itemBlock eachItem',
                    }).appendTo('#middle');

                    var currentItemInfo = $('<div/>', {
                        'class': 'itemInfo notCompletedItem',
                    }).appendTo(currentItemBlock);

                    var currentItemBody = $('<div/>', {
                        'class': 'itemBody',
                        'text': currentListData["listItem"][i]["itemText"],
                    }).appendTo(currentItemBlock);





                    var creationDate = new Date(currentListData["listItem"][i]["creation"] * 1000);
                    var creationDateString = creationDate.toUTCString();
                    console.log(currentListData["listItem"][i]["label"]);
                    //since setting the text of the element, it is escaped anyway
                    $('<h3>').text(currentListData["listItem"][i]["label"]).appendTo(currentItemInfo);
                    // currentItemInfo.text(currentListData["listItem"][i]["label"]);
                    console.log(currentItemInfo.html());
                    currentItemInfo.append("Creation Time: " + creationDateString);


                    var currentCompleteButton = $('<div/>', {
                        'class': 'incompleteItemButton',
                        'id': 'item' + currentListData["listItem"][i]["itemID"],
                        'text': 'complete Item',
                        'width': '40%'
                    }).appendTo(currentItemInfo);

                    var currentDeleteButton = $('<div/>', {
                        'class': 'deleteItemButton',
                        'id': 'item' + currentListData["listItem"][i]["itemID"],
                        'text': 'Delete Item',
                        'width': '40%'
                    }).appendTo(currentItemInfo);                    

                    if (currentListData["listItem"][i]["completion"]) {
                        currentItemInfo.toggleClass('completedItem');
                        var completionDate = new Date(currentListData["listItem"][i]["creation"] * 1000);
                        var completionDateString = creationDate.toUTCString();
                        currentCompleteButton.toggleClass('incompleteItemButton');
                        currentCompleteButton.toggleClass('completeItemButton');
                        currentCompleteButton.text(completionDateString);
                    }


            console.log(currentListData["listItem"][i]["completion"]);
                }

            }
            console.log(currentListData);
            $('.itemBlock').slideDown('400', function() {});

        });

    }

});

function checkExistingLogins(type) {
    //runs the script to check if the username is available every time a new character is entered
    var userTextField = $('input[name="' + type + '"]');
    userTextField.keyup(function() {
        console.log("keyup registered");
        var newuser2 = userTextField.val();
        $.post('scripts/UsernameCheck.php', {
            newuser: newuser2
        }, function(result) {
            //the server side script should return '1' if the username is available
            userTextField[0].setCustomValidity("");
            $('#regError' + type).empty();

            if (result == 0) {
                //username unavailable
                userTextField[0].setCustomValidity("This +" + type + " + is already taken");
                $('#regError' + type).append('This ' + type + ' is taken');
            }
        });
    });
}