<?php
session_start();
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
$mysqli = mysqli_connect('localhost','junmo14','mse','MSE');
$id = $_GET['id'];
$number = $_GET['number'];
$ann = $_GET['ann'];

echo $id;
echo $number;


$query_name = "SELECT * from board_comment where board_number = '$id' and number = '$number'";
$select_name = $mysqli->query($query_name);
$check_name = $select_name->fetch_array(MYSQLI_ASSOC);


$check = "DELETE FROM board_comment WHERE board_number = '$id' and number = '$number'";
$result = $mysqli->query($check);

if(!$result){
	echo " fail";
}else{
	echo "comment delete</br>";
}
echo "<script>window.location.replace('../board_click.php?id=$id&ann=$ann');</script>";
exit;

?>
