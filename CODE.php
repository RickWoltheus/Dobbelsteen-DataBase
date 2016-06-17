<?php
include 'Connect.php';
$read = "SELECT * FROM data";
$result = $conn->query($read);
while($row = $result->fetch_assoc()){
echo $row['Worp'] ;
}

?>