/* Copy and run queries in DBMS */
CREATE DATABASE todo;

CREATE TABLE todo.users (
  id INT(10) AUTO_INCREMENT NOT NULL,
  name VARCHAR (25) NOT NULL,
  PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE todo.tasks (
  id INT (10) AUTO_INCREMENT NOT NULL ,
  title VARCHAR (25) NOT NULL,
  description varchar(500) NOT NULL,
  author_id INT (10) NOT NULL,
  added_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  status VARCHAR (10) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;
