DROP TABLE IF EXISTS log;
DROP TABLE IF EXISTS engineer_history;
DROP TABLE IF EXISTS authentication;
DROP TABLE IF EXISTS conductor_history;
DROP TABLE IF EXISTS equipment;
DROP TABLE IF EXISTS trains;
DROP TABLE IF EXISTS conductor;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS engineer;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS users;

CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT,
    phoneNumber varchar(16),
    firstName varchar(64),
    lastName varchar(64),
    PRIMARY KEY(id)
);


CREATE TABLE customer(
    id int,
    email VARCHAR(64),
    billingAddress VARCHAR(255), 
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES users(id) 
);

CREATE TABLE employee(
    id int,
    address VARCHAR(255),
    role VARCHAR(16),
    username VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES users (id)    
);

CREATE TABLE conductor(
    id int,
    `status` BOOL,
    rank VARCHAR(255),
    PRIMARY KEY(id),
    FOREIGN KEY (id) REFERENCES employee(id)
);

CREATE TABLE administrator(
    id int,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES employee(id)
);

CREATE TABLE engineer(
    id int,
    `status` BOOL,
    hoursTraveled int,
    rank VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES employee(id)
);


CREATE TABLE log(
    logNumber int PRIMARY KEY AUTO_INCREMENT,
    ipAddress VARCHAR(32)  NOT NULL,
    ocassionTime datetime NOT NULL,
    description VARCHAR(255) NOT NULL,
    id int NOT NULL,
    actionType int NOT NULL, 
    FOREIGN KEY (id) REFERENCES users (id)
);

CREATE TABLE authentication(
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    id int, 
    FOREIGN KEY (id) REFERENCES employee (id),
    PRIMARY KEY (id)
);

CREATE TABLE trains(
    trainNumber int PRIMARY KEY AUTO_INCREMENT,
    destination VARCHAR(30),
    startLocation VARCHAR(30),
    days VARCHAR(30),
    departureTime time,
    arrivalTime time
);

CREATE TABLE equipment(
    serialNumber int PRIMARY KEY,
    loadCapacity int,
    `type` VARCHAR(50),
    location VARCHAR(20),
    manufacturer VARCHAR(32),
    price int,
    trainNumber int,
    id int,
    FOREIGN KEY (id) REFERENCES customer(id),
    FOREIGN KEY(trainNumber) REFERENCES trains(trainNumber)   
);

CREATE TABLE engineer_history(
    startDate date NOT NULL,
    endDate date,
    travelTime time,
    id int NOT NULL,
    trainNumber int NOT NULL,
    FOREIGN KEY (id) REFERENCES engineer (id),
    FOREIGN KEY (trainNumber) REFERENCES trains(trainNumber),
    PRIMARY KEY(id, trainNumber)
);

CREATE TABLE conductor_history(
    startDate date NOT NULL,
    endDate date,
    id int NOT NULL,
    trainNumber int NOT NULL,
    FOREIGN KEY (id) REFERENCES conductor (id),
    FOREIGN KEY (trainNumber) REFERENCES trains(trainNumber),
    PRIMARY KEY(id, trainNumber)
);

