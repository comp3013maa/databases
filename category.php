<?php
//category.php
require 'header.php';
include 'connect.php';


//first select the category based on $_GET['cat_id']
$sql = "SELECT	cat_id,	cat_name,cat_description FROM categories WHERE cat_id = " . $_GET['id'];
		

$result = mysqli_query($conn,$sql)  or die('Error2' . mysqli_error($conn));
$num_rows = $result->num_rows;


if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if($num_rows == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = $result->fetch_assoc())
		{
			echo '<h2>Topics in &prime;' . $row['cat_name'] . '&prime; category</h2><br />';
		}

		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
				topic_cat = " . $_GET['id'];
		
		$result = mysqli_query($conn,$sql);
		$topicnum_rows = $result->num_rows;

		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			if($topicnum_rows == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';	
					
				while($row = $result->fetch_assoc()
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y', strtotime($row['topic_date']));
						echo '</td>';
					echo '</tr>';
				}
			}
		}
		echo '<li id = "indexList"> <a href = "create_topic.php" class="listLinks"> Create Topic </a></li>';
	}
}

require 'footer.php';
?>
