create table index1(
	id int primary key auto_increment,
	name varchar(32) not null,
	age tinyint not null,
	intro text,
	unique key (name),
	index (age),
	fulltext index(intro),
	index (name,age)
)engine myisam charset utf8;
create table index2(
	id int primary key auto_increment,
	name varchar(32) not null,
	age tinyint not null,
	intro text
)engine myisam charset utf8;




create table t2(
    id int primary key auto_increment,
    name varchar(32) not null default '',
    class int not null default 0
)engine myisam charset utf8;
insert into t2 values(null,'xiaogang',3),
(null,'xiaohong',3),
(null,'xiaolong',1),
(null,'xiaofeng',2),
(null,'xiaogui',2);

create table user(
    id int primary key auto_increment,
    name varchar(32) not null default '',
    age tinyint unsigned not null default 0,
    email varchar(32) not null default '',
    classid int not null default 1
)engine myisam charset utf8;
insert into user values(null,'xiaogang',12,'gang@sohu.com',4),
(null,'xiaohong',13,'hong@sohu.com',2),
(null,'xiaolong',31,'long@sohu.com',2),
(null,'xiaofeng',22,'feng@sohu.com',3),
(null,'xiaogui',42,'gui@sohu.com',3);

create table class(
    id int not null default 0,
    classname varchar(32) not null default ''
)engine myisam charset utf8;
insert into class values(1,'java'),(2,'.net'),(3,'php'),(4,'c++'),(5,'ios');

