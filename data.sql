
INSERT INTO user VALUES(NULL,"user1","user1mail@testmail.co.uk","password1","user","one","fakesalt");
INSERT INTO user VALUES(NULL,"user2","user2mail@testmail.co.uk","password2","user","two","fakesalt");
INSERT INTO user VALUES(NULL,"user3","user3mail@testmail.co.uk","password3","user","three","fakesalt");

INSERT INTO friendship VALUES(NULL,1,2);
INSERT INTO friendship VALUES(NULL,2,1);
INSERT INTO friendship VALUES(NULL,1,3);
INSERT INTO friendship VALUES(NULL,3,1);
INSERT INTO friendship VALUES(NULL,2,3);
INSERT INTO friendship VALUES(NULL,3,2);

INSERT INTO list VALUES(NULL,"List1",strftime('%s','now')-5000,strftime('%s','now'));
INSERT INTO list VALUES(NULL,"List2",strftime('%s','now')-5500,strftime('%s','now'));
INSERT INTO list VALUES(NULL,"List3",strftime('%s','now')-6000,NULL);

INSERT INTO listItem VALUES(NULL,1,strftime('%s','now')-5000,strftime('%s','now'),"Completed List item");
INSERT INTO listItem VALUES(NULL,1,strftime('%s','now')-5000,NULL,"First Incomplete List item");
INSERT INTO listItem VALUES(NULL,1,strftime('%s','now')-6000,NULL,"Second Incomplete List item");
INSERT INTO listItem VALUES(NULL,2,strftime('%s','now')-5000,strftime('%s','now'),"Completed List item second list");
INSERT INTO listItem VALUES(NULL,2,strftime('%s','now')-5000,NULL,"First Incomplete List item second list");


INSERT INTO userList VALUES(1,1,1);
INSERT INTO userList VALUES(1,2,2);
INSERT INTO userList VALUES(1,3,2);
INSERT INTO userList VALUES(2,3,1);
INSERT INTO userList VALUES(2,2,2);
