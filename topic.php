<?php
//create_cat.php
require 'header.php';
include 'connect.php';
$getid =  mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = $getid";
			
 $result = mysqli_query($conn,$sql) or die('Error2' . mysqli_error($conn));
$num_rows = $result->num_rows;

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if($num_rows == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = $result->fetch_assoc())
		{
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.userID,
						users.userName
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.userID
					WHERE
						posts.post_topic = " . $_GET['id'];
						
			$posts_result = mysqli_query($conn,$posts_sql) or die('Error2' . mysqli_error($conn));;
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = $posts_result->fetch_assoc() )
				{
					echo '<tr class="topic-post">
							<td class="user-post">' . $posts_row['userName'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
						  </tr>';
				}
			}
			
			if(!isset ($_SESSION['userID'])  )
			{
				echo '<tr><td colspan=2>You must be <a href="login.php">signed in</a> to reply.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

require 'footer.php';
?>
