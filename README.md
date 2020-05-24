# To-Do-App
A To-Do App made with php, MySQL &amp; AJAX

## Getting Started

Download the project files from github onto your local machine.

### Prerequisites

```
You can use any of the follwoing free programs to set up a local host:
Xampp
Wamp
Mamp
```

You will also need to make use of phpmyAdmin for the databases.

### Installing

Please follow the install instruction for Wamp/Mamp/Xampp from the providers as well as the local host setup.

Please create a new database in your phpmyAdmin named as per your preference.

Then proceed to add the SQL database tables as listed below.


## Deployment

### PHP SETUP
```
Use github to clone the project into your local server.

Once you have the project cloned, use the config.php page and update your phpmyadmin connection details.

TO RUN THE PROJECT PLEASE OPEN THE PUBLIC FOLDER! This is where index.php is located.


```


### SQL DATABASE 

```
CREATE TABLE `todo_list` (
  `id` int(11) NOT NULL,
  `task` varchar(60) NOT NULL,
  'dueDate' date NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

ALTER TABLE `todo_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

ALTER TABLE `todo_list`
  ADD CONSTRAINT `todo_list_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwhash` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
```



## Built With

* HTML
* CSS
* PHP
* MySQL
* AJAX



## Versioning


## Authors

* **Sjaan Ackermann** 


## License

MIT