CREATE TABLE User (
    user_id INT auto_increment primary key,
    name VARCHAR(255),
    address varchar(255),
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255),
    is_admin INT default 0
);

CREATE TABLE image (
    id INT auto_increment primary key,
    file_name VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

