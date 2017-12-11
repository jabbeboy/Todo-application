
/* Task table */
CREATE TABLE todo.tasks (
  id int(10) AUTO_INCREMENT NOT NULL ,
  title varchar(25) NOT NULL,
  description varchar(100) NOT NULL,
  author varchar(25) NOT NULL,
  added_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  finished TINYINT(1) NOT NULL,
  PRIMARY KEY(id)
);


/* User table */
CREATE TABLE todo.users (
  id int(10) AUTO_INCREMENT NOT NULL,
  name varchar(25) NOT NULL,
  PRIMARY KEY(id)
);


/* QUERIES */

/* 1.               */
SELECT *
FROM todo.tasks
WHERE created_date >= getdate();