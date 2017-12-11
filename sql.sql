

CREATE TABLE todo.tasks (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(20) NOT NULL,
  description varchar(100) NOT NULL,
  author varchar(100) NOT NULL,
  added_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  finished int(11) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE todo.users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

INSERT INTO todo.tasks (
  title,
  description,
  author,
  added_date,
  end_date,
  finished
  ) VALUES (
  "Test Title",
  "Test Description",
  "Jakob",
  CURDATE(),
  CURDATE() + INTERVAL 1 DAY,
  0
);
