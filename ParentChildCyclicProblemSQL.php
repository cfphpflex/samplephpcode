<?php


/*
o   Ex. If A > B > C > D, then the following are not allowed: B > A, C > A, C > B, D > A, D > B, D > C

o   A > D is okay, B > F is okay

A=1
B=2
C=3
D=4
E=5
F=6
g=7



Parent:chile
OK = 1>2>3>4>5>6>7>8>9>10
BAD= 2>1
 
--create db
create database sonyplayparentchild
character set 'utf8'
 
 
--group table
CREATE TABLE groups(
group_id int  NOT NULL,  
group_name varchar(20) NULL,  
groupParent_id int  NULL 
);


--Test data
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (1, '1', 1);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (2, '2', 1);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (3, '3', 2);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (4, '4', 3);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (5, '5', 4);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (6, '6', 4);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (7, '7', 4);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (8, '8', 3);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (9, '9', 6);
INSERT INTO sonyplayparentchild.groups(group_id, group_name, groupParent_id) VALUES (10, '10', 9);

*/


?>