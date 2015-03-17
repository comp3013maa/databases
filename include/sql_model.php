<?php
require_once "config.php";

class SQL_Model {

/*
* Using prepared statements 
    $stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) { }
*/
  
public function __construct() {
   $this->conn = DbConnect();
}

public function close() {
	closeDB($this->conn);
}

/*
* Get assigned groups for a group ID - used in getGroupAllocations()
* @params: int - $groupID
* @return: string - $output
*/

public function getAssignedTo($groupID) {
	$stmt = $this->conn->prepare("SELECT assignedTo FROM groupassignments WHERE groupID=?");
	$stmt->bind_param("i", $groupID );	
 	$stmt->execute(); $result = $stmt->get_result();
	$row = array(); $output = "";
	while ($row = $result->fetch_assoc()) {
	 	$output .= '<td>' . htmlentities($row['assignedTo']) . '</td>';
	}
	
	$stmt->free_result();
        $stmt->close();	
	return $output;
}

    /*
    *   Get group allocations list 
    *   @params: none 
    *   @return: 
    */
public function getGroupAllocations() {
	$stmt = $this->conn->prepare("SELECT groupID
	FROM groupassignments
	ORDER BY groupID ASC");
	// $stmt->bind_param('s', $name);

        if ($stmt->execute()) {
		$result = $stmt->get_result();
		$row = array(); $output = "";
		while ($row = $result->fetch_assoc()) {
		$output .= '<tr> <td>' . htmlentities($row['groupID']) . '</td></td>' . $this->getAssignedTo($row['groupID']) . '</td></tr>';
		}
		
		$stmt->free_result();
            	$stmt->close();
		return $output; 
        } 
        else {
		die("An error occurred performing the request");
	}
}




} // end class	
