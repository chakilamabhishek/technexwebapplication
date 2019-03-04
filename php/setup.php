<!DOCTYPE html>
<html>

<head>
<title>Setting up database</title>
</head>

<body>

	<h3>Setting up...</h3>

<?php
// Example 26-3: setup.php
require_once 'info.php';
createTable('members', 'id INT PRIMARY KEY AUTO_INCREMENT,
			  first_name VARCHAR(30),
			  last_name VARCHAR(30), 
			  email VARCHAR(30),
              pass VARCHAR(16)');
?>

	<br>...done.
</body>

</html>