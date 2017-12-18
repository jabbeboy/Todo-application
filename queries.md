
### QUERIES 


/*https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/ */
/*https://github.com/zenware/FreeCodeCamp-wiki/blob/master/10-Steps-To-Plan-Better-So-You-Can-Write-Less-Code.md */


1. Tasks with specific status ordered by end_date

`SELECT id, title, description, author, added_date, end_date, status
FROM todo.tasks
WHERE author = 'author_id'
AND status = 'todo'
ORDER BY end_date ASC;`

2. Select a specific task 

`SELECT id, title, description, author, added_date, end_date, status
FROM todo.tasks
WHERE author = 'author_id'
AND id = 'task_id'
`

?------------------------------*/

`SELECT id, title, description, added_date, end_date, status
FROM todo.tasks
INNER JOIN todo.users
ON todo.users.id = todo.tasks.author
WHERE users.id = '12';`


3. Update task with current users id and name 

`UPDATE todo.tasks
SET title, description, added_date, end_date, status
WHERE todo.tasks.id = ''
AND todo.tasks.author = '';`

4. Delete a task */
`DELETE
FROM todo.tasks
WHERE tasks.id = 'id'
AND tasks.author = 'author';`

5. Select task with specific status and whose end date has surpassed the current date*/
`SELECT id
FROM todo.tasks
WHERE author = '10'
AND id = '10'
AND end_date <= CURDATE()
AND status IN ('todo');`

/* --------------------------------*/

`SELECT id,
       title,
       description,
       author,
       added_date,
       end_date,
       status
FROM todo.tasks
WHERE author = ''
AND end_date < CURDATE()
AND status IN ('todo', 'ongoing');`