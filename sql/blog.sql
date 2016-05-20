#创建账户表
drop table Account;
create table Account
(
    id int NOT NULL auto_increment primary key,
    person_id int comment '个人信息',
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    role int NOT NULL comment '0表示是普通用户，1表示是管理员, 2表示是游客',
    email varchar(50),
    state int NOT NULL comment '0表示无效，1表示有效',
    createtime int unsigned not null,
    updatetime int  unsigned not null
);

#创建Person表
drop table Person;
create table Person
(
    id int NOT NULL auto_increment primary key,
    name varchar(50) NOT NULL,
    state int NOT NULL comment '0表示无效，1表示有效',
    sex char(2),
    address varchar(255),
    createtime int unsigned not null,
    updatetime int unsigned not null
);


