<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: login.php?source=submit');	 
	
}

echo $name = $_FILES['file']['name'];

?>

<form action = "submit.php" method = "POST" enctype"multiplart/form-data">
      <input type="file" name="file"> <br><br>
      <input type="submit" value"Submit">
</form>

<?php
require "footer.php";
?>


