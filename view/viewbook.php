<html>
<head></head>

<body>

	<?php
	    echo '<table border="1">'; 
		echo '<tr><td>ISBN:' . $book->ISBN . '</td><tr>';
		echo '<tr><td>Title:' . $book->Title . '</td><tr>';
		echo '<tr><td>Author:' . $book->Author . '</td><tr>';
		echo '<tr><td>Description:' . $book->Description . '</td><tr>';
        echo '<table';
	?>

</body>
</html>
