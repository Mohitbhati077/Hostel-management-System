CREATE TABLE Bookings(
BookingId INT auto_increment primary key,
s_id INT,
RoomId INT,
BookingDate DATE,
foreign key(s_id)references students(s_id),
foreign key(RoomId)references rooms(RoomId)
)