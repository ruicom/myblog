#创建Person表
drop table Person;
create table Person
(
    id int NOT NULL auto_increment primary key,
    name varchar(50) NOT NULL,
    state int NOT NULL comment '0表示无效，1表示有效',
    email varchar(50),
    sex char(2),
    address varchar(255),
    createtime int unsigned not null,
    updatetime int unsigned not null
);


