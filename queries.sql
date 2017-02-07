/*to select all lists from user 1 */
SELECT list.listID,list.title,list.creation,list.completion from list JOIN  userList ON userList.listID = list.listID JOIN user ON userList.userID = user.userID WHERE user.username= "user1" ;
/*to select just the titles from user 1's lists */
SELECT list.title from list JOIN  userList ON userList.listID = list.listID JOIN user ON userList.userID = user.userID WHERE user.username= "user1" ;
/* to select  incomplete items from list 1*/
SELECT listItem.itemID,listItem.creation,listItem.completion,listItem.itemText from listItem JOIN list ON list.listID = listItem.listID WHERE listItem.completion IS NULL AND list.listID = 1;
/* to select  complete items from list 1*/
SELECT listItem.itemID,listItem.creation,listItem.completion,listItem.itemText from listItem JOIN list ON list.listID = listItem.listID WHERE listItem.completion IS NOT NULL AND list.listID = 1;
/* count number of todos iin list 1 */
SELECT COUNT(*) FROM listItem WHERE listItem.listID = 1;
/* return the number of todos user 1 has */
SELECT COUNT(*) From listItem JOIN userList ON listItem.listID = userList.listID JOIN user ON userList.userID = user.userID WHERE user.username =  "user1";
/*