<?php
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$id = $_GET['id'];

$file1 = $_FILES['upfile1']['tmp_name'];
$filename1 = $_FILES['upfile1']['name'];

$file2 = $_FILES['upfile2']['tmp_name'];
$filename2 = $_FILES['upfile2']['name'];

$file3 = $_FILES['upfile3']['tmp_name'];
$filename3 = $_FILES['upfile3']['name'];

if($file1 != NULL){
  //$filename = basename($filename1);
  $folder = "../../up/upfile/".$user_id.$filename1;
  move_uploaded_file($file1 , $folder);
  $f1 = $user_id.$filename1;
  //echo $folder;
  //$filename = 0;
  //$folder = 0;
}

if($file2 != NULL){
  //$filename = basename($filename2);
  $folder = "../../up/upfile/".$user_id.$filename2;
  move_uploaded_file($file2 , $folder);
  $f2 = $user_id.$filename2;
  //$filename = 0;
  //$folder = 0;
}

if($file3 != NULL){
  //$filename = basename($filename3);
  $folder = "../../up/upfile/".$user_id.$filename3;
  move_uploaded_file($file3 , $folder);
  $f3 = $user_id.$filename3;
  //$filename = 0;
  //$folder = 0;
}

$mysqli = mysqli_connect('localhost','junmo14','mse','MSE');

if(mysqli_connect_errno($mysqli)){
            echo "연결실패";
}else{
            echo "성공";
            echo $user_id;
            echo $user_name;
}


$check_1 = "SELECT * FROM board where number = '$id'";
$result_1 = $mysqli->query($check_1);
$board = $result_1->fetch_array(MYSQLI_BOTH);

$title = $_POST['title'];
$content = $_POST['content'];
$sort = $_POST['board_type'];
echo $title;
echo $content;

//$sort = $board['sort'];

$date1 = date("Y.m.d");
$date2 = date("H:i:s");

if($title==NULL||$content==NULL)
{
        echo "<script>alert('빈칸을 모두 입력해주세요!.');";
        echo "window.location.replace('../edit_board.php?id=$id');</script>";
        exit();
}

$check = "UPDATE board SET title = '$title' , file1 = '$f1', file2 = '$f2', file3 = '$f3', content = '$content' , sort = '$sort' WHERE number = '$id'";
$result = $mysqli->query($check);

echo "<script>window.location.replace('../board.php');</script>";

exit;
$result->close();
$result_1->close();
$mysqli->close();

?>
