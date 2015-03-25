<?php
require "header.php";
require "connect.php";

echo '<h3>Search Forum </h3></br />';
echo '<form  method="post"  id="searchform"> 
	      <input  type="text" name="name"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form>';
	    
	    if(isset($_POST['submit']) ){
	    	$postname =  mysqli_real_escape_string($conn, $_POST['name']);
	  	$sql = "select p.*, u.* from posts p, users u where p.post_content LIKE '%{$postname}%' and p.post_by=u.userID";
	  	$result = mysqli_query($conn,$sql) or die('Error2' . mysqli_error($conn)); 
	  		echo '<table border="1">
				<tr>
				<th>Posts Found</th>
				
				</tr>';
				
		while($row = $result->fetch_assoc())
			{
			echo '<tr>';
			echo '<td class="leftpart">';
			echo '<h3><a href="topic.php?id=' . $row['post_topic'] . '">' . $row['post_content'] . '</a></h3>' . $row['userName'];
			echo '</td>';
			echo '<td class="rightpart">';
	    		}
	  	
	 }
mysqli_close($conn);
require "footer.php";
?>
