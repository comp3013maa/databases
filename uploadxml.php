<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 
if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}
echo '<h3>Upload your report in XML</h3> <p></p>';
$user = $_SESSION['userID'];
 $connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error' . mysqli_error());
$query = "
	SELECT groupID
	FROM users
	WHERE userID =  $user
	";
$result = mysqli_query($connection,$query) or die('Error2' . mysqli_error($connection));
$row = mysqli_fetch_assoc($result);
$groupID = $row['groupID'];	 
$query3 = "
	SELECT groupID
	FROM submissions
	WHERE groupID = $groupID
	";
	$result3 = mysqli_query($connection,$query3) or die('Error3' . mysqli_error($connection));
	if (mysqli_num_rows($result3) == 1) {
		mysqli_close($connection);
		header('location: submitted.php?');
}
//unlink('uploads/'.'up.txt'); //to delete file
if(isset($_POST['uploaded'])) {
	
$file = $_FILES['file']['name'];	
$directory = 'uploads/'. basename($file);
$validUpload = true;
$extension = pathinfo($directory,PATHINFO_EXTENSION);
$marker = 0;
while (file_exists($directory)) {
    $marker = $marker + 1;
    $directory = 'uploads/'.basename($file,'.'.pathinfo($file)['extension']) . $marker . '.' . $extension;
    
}//adds a number marker if file exists
if ($_FILES['file']['size'] > 2000000) {
    echo 'Cannot exceed 2MB. ';
    $validUpload = false;
}
if($extension != 'xml') {
    echo 'File not XML ';
    $validUpload = false;
}
if ($validUpload) {
	if (move_uploaded_file($_FILES['file']['tmp_name'], $directory)) {
        	echo basename($file) . ' successfully uploaded.';
    	}else{
        	echo 'Upload error';
    	}
} 
else {
	echo 'File not uploaded. Try again.';
}
}
	 $userID = $_SESSION['userID'];
	 
	$query1 = 
	"SELECT groupID 
	FROM users
	WHERE userID = '$userID'
	";
	 
	 	$result1 = mysqli_query($connection,$query1) or die('Error' . mysqli_error("$result1"));
	 	$row = mysqli_fetch_assoc($result1);
	 	$groupID = $row['groupID'];
	 	$xml = simplexml_load_string(file_get_contents(basename($file))) or die("Error: Cannot create object");
if ($validUpload){
	$query2 = 
	 "INSERT INTO submissions 
	 (submissionName, groupID)
	 VALUES ('$xml', $groupID)";  
	 
	$result2 = mysqli_query($connection,$query2) or die('Error' . mysqli_error($connection));
}
	mysqli_close($connection);
	
echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
     	<button type ="submit "id="singlebutton" name="uploaded" class="btn btn-success"> Submit </button>
</form>';
require "footer.php";
?>