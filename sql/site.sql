#
drop table Site;
create table Site
(
   id int NOT NULL auto_increment primary key,
   title varchar(50) NOT NULL,
   title_des varchar(255),
   about_me varchar(2000),
   account_id int,
   createtime int unsigned not null,
   updatetime int unsigned not null
);



drop table BlogPost;
create table BlogPost
(
    id int NOT NULL auto_increment primary key,
    title varchar(255) NOT NULL,
    summary varchar(2000),
    comtent text NOT NULL,
    account_id int NOT NULL,
    category_id int,
    createtime int unsigned not null,
    updatetime int unsigned not null
    
);


drop table Category;
create table Category
(
    id int not null auto_increment primary key,
    name varchar(50) NOT NULL,
    parent_id int NOT NULL,
    createtime int not null,
    updatetime int not null
);

