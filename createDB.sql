CREATE USER 'admin03' IDENTIFIED BY 'Admin!_03';
GRANT ALL ON *.* TO admin03;
GRANT SELECT, INSERT ON *.* TO admin03;

create database check_anpi;

use check_anpi;

create table employee  (
id char(8) unique not null primary key,
name varchar(20) not null,
bg_id char(2) not null index bg_id_index(bg_id),
d_id char(2) index d_id_index(d_id)
);

create table user  (
id char(8) unique not null primary key,
password varchar(10) not null,
foreign key(id) references employee(id)
);

create table belongs  (
bg_id char(2) not null primary key,
belong varchar(10) not null,
foreign key(bg_id) references employee(bg_id)
);

create table  divisions (
bg_id char(2) not null primary key,
d_id char(2) not null primary key,
division varchar(10) not null,
foreign key(bg_id) references employee(bg_id),
foreign key(d_id) references employee(d_id)
);

create table anpi (
id char(8) unique  not null primary key,
time time not null,
status char(10) not null,
text varchar(50),
foreign key(id) references employee(id)
);

commit;
