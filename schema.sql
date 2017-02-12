drop table user;

CREATE TABLE user(
userID   integer primary key,
username VARCHAR(20) not null UNIQUE, 
email    VARCHAR(40) not null UNIQUE,
password VARCHAR(70) not null,
forename VARCHAR(25) not null,
surname  VARCHAR(25) not null,
salt     VARCHAR(10) not null
);

drop table friendship;

CREATE TABLE friendship(
friendshipID integer primary key,	
userID   integer,
friendID integer 
);


drop table list;

CREATE TABLE list(
listID   integer primary key,
title VARCHAR(30),
creation integer,
completion integer                                                                                                                    
);



drop table listItem;

CREATE TABLE listItem(
itemID integer primary key,
listID integer,
creation integer, 
completion integer,
itemText text
);

drop table userList;

CREATE TABLE userList(
userID  integer,
listID  integer,
permission integer,
primary key (userID,listID)
);           


