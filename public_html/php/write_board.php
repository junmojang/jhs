<?php
session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$title = $_POST['title'];
$content = $_POST['content'];
$date1 = date("Y.m.d");
$date2 = date("H:i:s");
$sort = $_POST['board_type'];
$sub_sort = $_POST['head_type'];
$hits = 0;

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

if($title==NULL||$content==NULL)
{
        echo "<script>alert('빈칸을 모두 입력해주세요!.');";
        echo "window.location.replace('../newboard.php');</script>";
        exit();
}
else if($sort == '자유' && $sub_sort == 'NULL')
{
    $sub_sort = '전체';
}

$mysqli = mysqli_connect('localhost','junmo14','mse','MSE');

if(mysqli_connect_errno($mysqli)){
            echo "연결실패";
    }else{
            echo "성공";
    }

if($sub_sort == 'NULL')
{
    $check = "INSERT INTO board VALUES" . "(DEFAULT,'$title','$sort', '$hits','$user_id','$user_name',now(),'$content','$f1','$f2','$f3','$date1','$date2', DEFAULT)";
}
else
{
    $check = "INSERT INTO ann_board VALUES" . "(DEFAULT,'$title','$sub_sort','$hits',now(),'$date2','$date1','$content')";
}

$result = $mysqli->query($check);

if(!result){
	echo " fail";
}
echo "<script>window.location.replace('../board.php');</script>";

exit;

?>
