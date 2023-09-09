CREATE TABLE Rooms(
RoomId INT auto_increment PRIMARY KEY,
RoomNo varchar(10) NOT NULL,
Capacity INT NOT NULL,
Occupants INT NOT NULL DEFAULT 0,
Availablility VARCHAR(20) NOT NULL
);
