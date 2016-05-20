/*
drop table BlogPost;
create table BlogPost
(
    id int NOT NULL auto_increment primary key,
    title varchar(255) NOT NULL,
    summary varchar(2000),
    comtent text NOT NULL,
    account_id int NOT NULL,
    category_id int,
    state int,
    is_open int comment '0表示是private的，1表示是open的',
    createtime int unsigned not null,
    updatetime int unsigned not null
    
);

*/
drop table Category;
create table Category
(
    id int not null auto_increment primary key,
    name varchar(50) NOT NULL,
    num int(11) NOT NULL,
    account_id int NOT NULL,
    state int NOT NULL,
    createtime int not null,
    updatetime int not null
);

