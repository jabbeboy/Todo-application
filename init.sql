
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
/* 1. Tasks with specific status ordered by end_date */
SELECT tasks.id,
       tasks.title,
       tasks.description,
       tasks.author,
       tasks.added_date,
       tasks.end_date,
       tasks.status
FROM todo.tasks
WHERE tasks.author = 'author_id'
AND tasks.status = 'todo'
ORDER BY tasks.end_date DESC;

/* 2. */




/* ------------------------------*/
SELECT tasks.id,
       tasks.title,
       tasks.description,
       tasks.added_date,
       tasks.end_date,
       tasks.status
FROM todo.tasks
INNER JOIN todo.users
ON todo.users.id = todo.tasks.author
WHERE users.id = '12';


/* 3. Update task with current users id and name */
UPDATE todo.tasks
SET tasks.title,
    tasks.description,
    tasks.added_date,
    tasks.end_date,
    tasks.status
WHERE todo.tasks.id = ''
AND tasks.author = '';

/* 4. Delete a task */
DELETE
FROM todo.tasks
WHERE tasks.id = 'id'
AND tasks.author = 'author';


/* 5. Delete a task */
SELECT tasks.id, tasks.status
FROM todo.tasks
WHERE tasks.author = 'author'
AND tasks.end_date <= CURDATE()
AND tasks.status
IN ('todo', 'ongoing');

/* --------------------------------*/
SELECT tasks.id,
       tasks.title,
       tasks.description,
       tasks.author,
       tasks.added_date,
       tasks.end_date,
       tasks.status
FROM todo.tasks
WHERE tasks.author = '' AND
tasks.end_date < CURDATE()
AND tasks.status IN ('todo', 'ongoing');





/*https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/ */
/*https://github.com/zenware/FreeCodeCamp-wiki/blob/master/10-Steps-To-Plan-Better-So-You-Can-Write-Less-Code.md */