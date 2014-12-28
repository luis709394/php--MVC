<html>
<head>
</head>

<body>

<?php
// show error message if the user does not enter anything but presses submit for search
$keywordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["keyword"])) {$keywordErr = "*Keyword is required";
	}

}

/*
 * check if there are books whose titles include the keyword, and if yes, show them in a table
 */	

if (count($books) == 0) {
	echo "Not found";
   
} else {
  echo '<table>
  <tbody>
    <tr>
      <td>Title</td>
      <td>Author</td>
      <td>Description</td>
    </tr>
  </tbody>';
  
	foreach ($books as $book) {
		echo '<tr><td><a href="index.php?book=' . $book -> ISBN . '">' . $book -> Title . '</a></td><td>' . $book -> Author . '</td><td>' . $book -> Description . '</td></tr>';
	}
}

echo '</table>';

?>
<!--below is a search box-->
   <form name="searchBox"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
   	Search by title:<td><input type="text" name="keyword"  ></td>
   	<td>	
                         <input type="submit" value="search">
   </td>
   <span class="error"><?php echo $keywordErr; ?></span>
</body>
</html>
