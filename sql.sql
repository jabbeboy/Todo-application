

CREATE TABLE todo.tasks (
  id int(10) NOT NULL AUTO_INCREMENT,
  title varchar(20) NOT NULL,
  description varchar(100) NOT NULL,
  author varchar(100) NOT NULL,
  added_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  status varchar(10) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE todo.users (
  id int(10) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY(id)
);


SELECT *
FROM todo.tasks
WHERE created_date >= getdate();