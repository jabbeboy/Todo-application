
CREATE TABLE todo.tasks (
  id int(10) AUTO_INCREMENT NOT NULL ,
  title varchar(25) NOT NULL,
  description varchar(500) NOT NULL,
  author varchar(25) NOT NULL,
  added_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  status VARCHAR(10) NOT NULL,
  PRIMARY KEY(id)
);

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

/* 2.               */
SELECT tasks.id,
 tasks.title,
 tasks.description,
 tasks.added_date,
 tasks.end_date,
 tasks.status
FROM todo.tasks
INNER JOIN todo.users
ON users.name = tasks.author
WHERE users.name = 'John Doe';


/* 3. */
SELECT
  tasks.id,
  tasks.title,
  tasks.description,
  tasks.author,
  tasks.added_date,
  tasks.end_date,
  tasks.status
FROM todo.tasks
WHERE tasks.author = :author
AND tasks.status = :status ORDER BY tasks.end_date DESC";

/*https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/ */
/*https://github.com/zenware/FreeCodeCamp-wiki/blob/master/10-Steps-To-Plan-Better-So-You-Can-Write-Less-Code.md */