


#创建账户表
drop table Account;
create table Account
(
    id int NOT NULL auto_increment primary key,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    role int NOT NULL comment '0表示是普通用户，1表示是管理员, 2表示是游客',
    state int NOT NULL comment '0表示无效，1表示有效',
    sex int NOT NULL comment '0表示女性,1表示男性',
    file_id int NOT NULL comment '用户图片的id',
    birthday timestamp(6) NOT NULL comment '生日',
    createtime int unsigned not null,
    updatetime int  unsigned not null
);

drop table File;
create table File
(
    id int NOT NULL auto_increment primary key,
    path varchar(200) NOT NULL,
    type int NOT NULL comment '0为图片，1为其他类型',
    filesize int,
    createtime int unsigned not null
);

