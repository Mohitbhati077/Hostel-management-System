CREATE TABLE students(
s_id int auto_increment primary key,
f_name varchar(50) not null,
l_name varchar(50) not null,
email varchar(100) not null unique,
password varchar(255) not null
)