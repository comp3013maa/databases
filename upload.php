<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}


if(isset($_POST['uploaded'])) {
$directory = 'uploads/'. basename($_FILES['file']['name']);
echo 'BASENAME RETURNS: '. basename($_FILES['file']['name']);
$validUpload = true;

$extension = pathinfo($directory,PATHINFO_EXTENSION);
/*
$marker = 0;
while (file_exists($directory)) {
    $marker = $marker + 1;
    $directory = 'uploads/'. basename($_FILES['file']['name']) . $marker;
    if(file_exists($directory))
}
*/
if ($_FILES['file']['size'] > 2000000) {
    echo 'Cannot exceed 2MB';
    $validUpload = false;
}

if($extension != 'txt' && $extension != 'doc' && $extension != 'pdf') {
    echo 'Please ensure file is .txt, .doc, or .pdf';
    $validUpload = false;
}
if ($validUpload) {
 if (move_uploaded_file($_FILES['file']['tmp_name'], $directory)) {
        echo $_FILES['file']['name'] . ' successfully uploaded.';
    }else{
        echo 'Upload error';
    }
} 
else {
	echo 'File not uploaded. Try again.';
}
}
echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
      <input type="submit" value="Submit" name = "uploaded">
</form>';

/*
if (isset ($_POST['uploaded'])){
var_dump($_FILES['file']);
$filename = $_FILES['file']['name'];
$temp_name = $_FILES['file']['tmp_name'];

$conn_id = ftp_connect('waws-prod-am2-025.ftp.azurewebsites.windows.net')or die('could not connect');

ftp_login($conn_id, 'comp3013maa\abbuz','FuckingCunt') or die('could not log in');

ftp_chdir($conn_id, '/site/wwwroot/uploads/');

if (ftp_put($conn_id, $filename, $temp_name, FTP_ASCII))
{
 echo 'successfully uploaded';
}else{echo 'not uploaded';}
ftp_close($conn_id);
}
*/
require "footer.php";
?>


