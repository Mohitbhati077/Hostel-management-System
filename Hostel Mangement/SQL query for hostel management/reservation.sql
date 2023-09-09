CREATE TABLE reservation(
resid int auto_increment primary key,
s_id int,
RoomId int,
name varchar(100),
address varchar(255),
dob date,
phone varchar(12),
state varchar(50),
city varchar(50),
clgname varchar(100),
status enum('Pending','Confirmed','Cancelled') default 'Pending',
bookingdate timestamp default current_timestamp,
foreign key(s_id)references students(s_id),
foreign key(RoomId)references rooms(RoomId)
)
