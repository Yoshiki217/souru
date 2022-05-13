drop user admin03;

drop database check_anpi;

CREATE USER 'admin03' IDENTIFIED BY 'Admin!_03';
create database check_anpi;

GRANT ALL ON check_anpi.* TO admin03;
GRANT SELECT, INSERT ON *.* TO admin03;

use check_anpi;

create table belongs (
bg_id char(2) not null primary key,
belong varchar(10) not null
);

create table  divisions (
bg_id char(2) not null,
d_id char(2) not null,
division varchar(10) not null,
primary key(d_id),
foreign key(bg_id) references belongs(bg_id)
);

create table employee  (
id char(8) unique not null,
name varchar(20),
bg_id char(2) not null,
d_id char(2) not null,
password varchar(100),
primary key(id),
foreign key(bg_id) references belongs(bg_id),
foreign key(d_id) references divisions(d_id)
);

create table anpi (
id char(8) not null,
name varchar(20),
datetime datetime not null,
status char(10) not null,
text varchar(50),
foreign key(id) references employee(id)
);
