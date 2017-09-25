
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("1234567890", "Greg", "Rice");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("0987654321", "Paul", "Matt");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("1597534826", "Mist", "Mox");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Protein", "Flag");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Greg", "Flag");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Joe", "Blow");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Ben", "Jerry");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Garry", "Jerry");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Edgar", "Poe");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Matt", "Flag");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Customer", "Cust");
INSERT INTO `users` (phoneNumber, firstName, lastName) VALUES("9513574862", "Another", "One");

INSERT INTO `customer` (id, email, billingAddress) VALUES("1", "grice@gmail.com", "255 St. Louis Street St. Louis, MO");
INSERT INTO `customer` (id, email, billingAddress) VALUES("11", "grice@gmail.com", "255 St. Louis Street St. Louis, MO");
INSERT INTO `customer` (id, email, billingAddress) VALUES("12", "grice@gmail.com", "255 St. Louis Street St. Louis, MO");

INSERT INTO `employee` (id, address, role) VALUES("2", "3600 Aspen Heights Pwky, Columbia, MO", "conductor");
INSERT INTO `employee` (id, address, role) VALUES("3", "27 Broadway Ave, Springfield, MO", "engineer");
INSERT INTO `employee` (id, address, role) VALUES("4", "3500 Grindstone Pwky, Columbia, MO", "administrator" );
INSERT INTO `employee` (id, address, role) VALUES("5", "123 Fake St, St. Louis, MO", "administrator" );
INSERT INTO `employee` (id, address, role) VALUES("6", "370 Brookside Ln, Columbia, MO", "engineer" );
INSERT INTO `employee` (id, address, role) VALUES("7", "105 Locus St, Columbia, MO", "engineer" );
INSERT INTO `employee` (id, address, role) VALUES("8", "3500 Grindstone Pwky, Columbia, MO", "engineer" );
INSERT INTO `employee` (id, address, role) VALUES("9", "3500 Grindstone Pwky, Columbia, MO", "conductor" );
INSERT INTO `employee` (id, address, role) VALUES("10", "3500 Grindstone Pwky, Columbia, MO", "conductor" );

INSERT INTO `conductor` (id, status, rank) VALUES("2", "1", "Senior");
INSERT INTO `conductor` (id, status, rank) VALUES("9", "1", "Senior");
INSERT INTO `conductor` (id, status, rank) VALUES("10", "1", "Senior");

INSERT INTO `engineer` (id, status, hoursTraveled, rank) VALUES("3", "1", "19127", "Senior");
INSERT INTO `engineer` (id, status, hoursTraveled, rank) VALUES("6", "1", "19127", "Senior");
INSERT INTO `engineer` (id, status, hoursTraveled, rank) VALUES("7", "1", "19127", "Senior");
INSERT INTO `engineer` (id, status, hoursTraveled, rank) VALUES("8", "1", "19127", "Senior");

insert into `administrator` (id) VALUES("4");
insert into `administrator` (id) VALUES("5");

INSERT INTO `equipment` (serialNumber, loadCapacity, type, location, manufacturer, price) VALUES("1000", "4000", "grain car", "St. Louis", "Train Cars Inc.", "500"); 
INSERT INTO `equipment` (serialNumber, loadCapacity, type, location, manufacturer, price) VALUES("1001", "4000", "coal car", "St. Louis", "Train Cars Inc.", "700"); 
INSERT INTO `equipment` (serialNumber, loadCapacity, type, location, manufacturer, price) VALUES("1002", "2000", "flat bed", "Chicago", "Train Cars Inc.", "400"); 
INSERT INTO `equipment` (serialNumber, loadCapacity, type, location, manufacturer, price) VALUES("1003", "4000", "grain car", "Chicago", "Train Cars Inc.", "500"); 
INSERT INTO `equipment` (serialNumber, loadCapacity, type, location, manufacturer, price) VALUES("1004", "3000", "hopper", "St. Louis", "Train Cars Inc.", "800"); 
INSERT INTO `equipment` (serialNumber, type, location, manufacturer) VALUES("1005", "locomotive", "St. Louis", "Train Cars Inc."); 
INSERT INTO `equipment` (serialNumber, type, location, manufacturer) VALUES("1006", "locomotive", "Chicago", "Train Cars Inc."); 

INSERT INTO `equipment` (serialNumber, loadCapacity, type, location, manufacturer, price) VALUES ('1007', "3000", "hopper", "St. Louis", "Train Cars Inc.", "800");
INSERT INTO `trains` VALUES("1", "Chicago", "St. Louis", "Monday", "8:00:00", "12:00:00"); 
INSERT INTO `trains` VALUES("2", "Chicago", "New York", "Wednesday", "10:00:00", "12:00:00"); 
INSERT INTO `trains` VALUES("3", "Memphis", "New Orleans", "Friday", "8:00:00", "15:00:00"); 

INSERT INTO `conductor_history` VALUES("2017-04-17","","2","1");
INSERT INTO `conductor_history` VALUES("2017-04-18","","2","3");
INSERT INTO `conductor_history` VALUES("2017-04-19","","9","2");

INSERT INTO `engineer_history` VALUES("2017-04-15","","","3","1");
INSERT INTO `engineer_history` VALUES("2017-04-16","","","3","2");
INSERT INTO `engineer_history` VALUES("2017-04-17","","","3","3");
INSERT INTO `engineer_history` VALUES("2017-04-18","","","8","3");
INSERT INTO `engineer_history` VALUES("2017-04-17","","","7","1");
INSERT INTO `engineer_history` VALUES("2017-04-17","","","7","2");
