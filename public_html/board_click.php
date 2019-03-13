<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
  <link href="css/board_click_css.css" type="text/css" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>


<body>

  <header>
    <h1>
      <a data-clk="top.logo" href="index.php">
        <span class="mse_logo">MSE</span>
      </a>
    </h1>
  </header>

  <nav>
    <div class="nav_home">
      <a target="_self" href="index.php">HOME</a>
    </div>
    <div class="nav_notice">
      <a target="_self" href="notice.php">NOTICE</a>
    </div>
    <div class="nav_schedule">
      <a target="_self" href="schedule.php">SCHEDULE</a>
    </div>
    <div class="nav_board">
      <a target="_self" href="board.php">BOARD</a>
    </div>
    <div class="nav_contact">
      <a target="_self" href="contact.php">CONTACT</a>
    </div>
    <div class="nav_members">
      <a target="_self" href="notice_click.php">MEMBERS</a>
    </div>
  </nav>

  <div id="login_box">
    <?php
    if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) { ?>
      <form method="post" action="php/login_ok.php">
      <div id="login_input">
        아이디 <input type="text" name="user_id"/>
        비밀번호 <input type="password" name="user_pw"/>
        <input type="submit" value="로그인" class="login_btn"/>
        <a href="php/signup.php" target="_self" id="register">회원가입</a>
      </div>
    </form>
    <?php } else {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        echo "<p><strong>$user_name </strong>님~~ "; ?>
          <a href="changepw.php" target="_self" id="register">비밀번호변경</a>
          <a href="php/logout.php" id="forgot">로그아웃</a><?php
    }?>
  </div>

  <aside id="left">

    <div class="search_main">
      <form action = "search_result.php" method="get">
        <input title="홈페이지 검색어 입력" type="text" name="search_value" class="inp" style="ime-mode:active" placeholder="검색어 입력">
        <input type="hidden" name="sort" value="search">
        <button type="submit" name="search" class="btn"></button>
      </form>
    </div>

    <div class="laguage">
      <a href="index.html" target="_blank" class="index_kor">한국어</a>
      <a href="home_eng.html" target="_blank" class="index_eng">English</a>
    </div>
  </aside>

  <div class="background">
  </div>
  <div class="background_bottom">
  </div>
  <section>
    <div class="main">
      <div class="small_title">
        <div class="blue">
        </div>
        MSE Board
      </div>
      <div class="small_small_title">
        | &nbsp;게시판
      </div>

<div class="main-area" style="overflow: visible">
      <?php

      $mysqli = mysqli_connect('localhost','junmo14','mse','MSE');
      $board_num = $_GET['id'];
      $ann_check = $_GET['ann'];

      if($ann_check == NULL)
        $check = "SELECT * FROM board WHERE number = '$board_num'";
      else
        $check = "SELECT * FROM ann_board WHERE number = '$board_num'";

      $result = $mysqli->query($check);

      if(!result){
        echo " fail";
      }else{
      	$board = $result->fetch_array(MYSQLI_BOTH);
        $id = $board['number'];
      }

      if($ann_check == NULL)
        $add_hits = "UPDATE board SET hits = hits+1 WHERE number = '$board_num'";
      else
        $add_hits = "UPDATE ann_board SET hits = hits+1 WHERE number = '$board_num'";

    	$hites_result = $mysqli->query($add_hits);?>


        <article class="notice" style="overflow: visible">
          <div class="notice_title">
            <?php
            echo $board['title'];?>
          </div>
          <div class="notice_info">
            <div class="notice_info_writer">
              <div class="notice_writer_pic">
                <a href="notice_click.php" class="notice_info_writer .notice_writer_pic">
                  <span class="blind">인</span>
                </a>
              </div>
              <div class="writer">
                <?php
                if($ann_check == NULL)
                  echo $board['writer'];
                else
                  echo "익명";?>
                </div>
              </div>
              <div class="notice_info_date">
                <div class="year">
                <?php
                echo $board['date_year'];?>
                </div>
                <div class="time">
                <?php
                echo $board['date_hour'];?>
                </div>
              </div>
              <div class="notice_info_hits">
                <div class="notice_info_hits_pic">
                  <a href="notice_click.php" class="notice_info_hits.notice_info_hits_pic">
                    <span class="blind">눈</span>
                  </a>
                </div>
                <?php
                echo $board['hits'];?>
              </div>
            </div>

            <div class="notice_attachment">
            <div class="notice_attachment_pic">
              <a class="notice_attachment.notice_attachment_pic">
                <span class="blind">클</span>
              </a>
            </div>
            첨부파일
            <ul>
              <?php
              $b_file1 = $board['file1'];
              $b_file1_cut = substr($b_file1, 8, 50);

              $b_file2 = $board['file2'];
              $b_file2_cut = substr($b_file2, 8, 50);

              $b_file3 = $board['file3'];
              $b_file3_cut = substr($b_file3, 8, 50);
              ?>

              <?php
              if($b_file1 != NULL){?>
              <a href = "php/file_download.php?filename=<?php echo $b_file1?>&check=0" target = "_blank"><?php echo $b_file1_cut?></a><br>
              <?php
              }?>

              <?php
              if($b_file2 != NULL){?>
              <a href = "php/file_download.php?filename=<?php echo $b_file2?>&check=0" target = "_blank"><?php echo $b_file2_cut?></a><br>
              <?php
              }?>

              <?php
              if($b_file3 != NULL){?>
              <a href = "php/file_download.php?filename=<?php echo $b_file3?>&check=0" target = "_blank"><?php echo $b_file3_cut?></a><br>
              <?php
              }?>

            </ul>
          </div>

          <div style="overflow: auto;" class="notice_content"><pre><?php
            echo $board['content'];
            $result->close();?></pre>
          </div>




          <div class="notice_reply">

          <?php
          if($ann_check == 1)
            $check = "SELECT * FROM ann_board_comment WHERE board_number = '$id'";
          else
            $check = "SELECT * FROM board_comment WHERE board_number = '$id'";

          $result = $mysqli->query($check);
          if(!$result)
            die($mysqli->error);

        	$rows = $result->num_rows;

          $page_num = $rows;

          if($page_num % 10 == 0)
            $page_num = floor($rows / 10);
          else
            $page_num = floor($rows / 10) + 1;
          $current_page = $_GET['page_number'];
          if($current_page == NULL)
            $current_page = 0;

          $board_comment = $result->fetch_array(MYSQLI_BOTH);
          $number = $board_comment['number'];

        //	for($j=$current_page*10+1; $j<$current_page*10+10; $j++)
        for($j=$rows-10*($current_page); $j>$rows-(10*($current_page+1)); $j--)
          	{
              if($j ==0)
                break;

        			$result->data_seek($j-1);
        			$comment = $result->fetch_array(MYSQLI_BOTH);
        	?>

          		<tr>
                <div class = notice_reply_pic>
                  <a class="notice_attachment.notice_attachment_pic">
                    <span class="blind">클</span>
                </div>
                <div class="notice_reply_name">
                  <?php
                  if($ann_check != 1)
                  {?>
            	     <td width="10" ><?php echo $comment['writer']; ?></td><?php
                  }
                   else
                  {?>
                   <td width="10" >익명</td><?php
                  }?>
                </div>
                  <div class="notice_reply_time">
                	<td width="10"><?php echo $comment['date']; ?></td><br>
                </div>
                <div class="notice_reply_content">
                  <td width="10" height="20"><?php echo $comment['content']; ?></td>
                </div><?php
                if($user_id == $board_comment['student_id']){?>
                <form method="post" onsubmit="passwordPrompt()" action="php/delete_board_comment.php?id=<?php echo $id?>&number=<?php echo $number?>">
              			<input type = "submit" value="X" class="reply_delete"/>
                </form><?php
                }?>
                </tr>
            		<?php
            	}

            	$result->close();
            	$mysqli->close();
          ?>


            <div class="notice_reply_input">
              <div class="bottom_paging_box"><?php
                for($i = 0; $i < $page_num; $i++)
                {
                  if($i == $current_page)
                  {?>
                    <em class="page_cur"><?php echo $i+1?></em><?php
                  }
                  else
                  {?>
                    <a href="board_click.php?id=<?php echo $id?>&page_number=<?php echo $i?>" class="page_mid"><?php echo $i+1?></a><?php
                  }
                }?>
              </div>
              <form class="comment" action="php/write_board_comment.php?id=<?php echo $id?>&ann=<?php echo $ann_check?>" name="comment" method="post">
                <div class="notice_replyy">
                <textarea name="comment" rows="5" cols="105"></textarea>
                <?php
                if($user_id){?>
                  <input class="comment_btn" type ="submit" value="댓글쓰기"/><?php
                  }?>
                </div>
              </form>
              </div>
            </div>
          </div>

        </article>

      <div class="back_bottom">
      </div>

      <?php
      if($user_id == $board['student_id']){?>
      <form action="php/delete_board.php?id=<?php echo $id?>" method="post">
	 <input type = "submit" value="게시글 삭제" class="btn"/>
	 </form>
   <form action="editboard.php?id=<?php echo $id?>" method="post">
<input type = "submit" value="게시글 수정" class="btn"/>
</form><?php
}?>
      <div class="notice_list">
        <a target="_self" href="board.php">목록</a>
      </div>
    </div>
  </section>

  <footer>
    <div class="footer">
      <br />주소 : 경기도 용인시 수지구 죽전로 152, 단국대학교 국제관 201호 (우)16890 <br>
      COPYRIGHT 2019 BY DANKOOK UNIVERSITY, INTERNATIONAL COLLEGE MOBILE SYSTEM ENGINEERING <동아리명>
    </div>
  </footer>
</body>
</html>
