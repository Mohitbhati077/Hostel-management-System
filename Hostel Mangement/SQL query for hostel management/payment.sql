CREATE TABLE payment_record(
     payment_id int auto_increment primary key,
     s_id int,
     payment_date datetime,
     payment_amount decimal(10,2),
     mess_service tinyint(1),
     foreign key(s_id)references students(s_id)
)
