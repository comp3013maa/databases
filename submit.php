<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 
<form action = "submit.php" method = "POST" enctype"multiplart/form-data">
      <input type="file" name="file"> <br><br>
      <input type="submit" value"Submit">
</form>
require "footer.php";
?>


