<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: login.php?');	 
	
}
echo $name = $_FILES['file']['name'];
echo $tmp_name = $_FILES['file']['tmp_name'];
if (isset($name)){
	if(!empty($name)){
		
	}
}

?>

<form action = "upload.php" method = "POST" enctype"multiplart/form-data">
      <input type="file" name="file"> <br><br>
      <input type="submit" value"Submit">
</form>

<?php
require "footer.php";
?>


