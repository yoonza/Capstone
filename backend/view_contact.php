<?php
	session_start();

	$conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// 로그인 처리 후, 쿠키에 로그인 정보 저장
	$is_login = false;
	if ($is_login) {
		$is_login = true;
    	setcookie('username', $username, time() + 3600, '/');
    	session_start();
    	$_SESSION['username'] = $username;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact page</title>
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view_contact.css" />
    <style>
        * {
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
            text-decoration: none;
        }
         .top {
            line-height: 24px;
            font-size: 11px;
            background: #fff;
            background: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            z-index: 9999;
            position: relative;
            font-family: Cambria, Georgia, serif;
            box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
        }

        /* Clearfix hack by Nicolas Gallagher: http://nicolasgallagher.com/micro-clearfix-hack/ */

        .top:before,
        .top:after {
            content: " "; /* 1 */
            display: table; /* 2 */
        }

        .top:after {
            clear: both
        }

        .top a {
            padding: 0px 10px;
            letter-spacing: 1px;
            color: #333;
            display: inline-block;
        }

        .top a:hover {
            background: rgba(255,255,255,0.6)
        }

        .top span.right {
            float: right
        }

        .top span.right a {
            float: left;
            display: block;
        }
        /* 스타일링을 위한 CSS */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }
        .popup-content {
            /* 기존 스타일 유지하면서 팝업 창 크기 조정 */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 40px; /* 팝업 내용의 패딩을 조정하여 크기를 변경 */
            border: 1px solid #888;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 80%; /* 팝업 창의 너비를 조정 */
            max-width: 600px; /* 최대 너비 지정 */
            height: 10vh; /* 높이를 뷰포트 높이의 70%로 설정 */
            max-height: 20vh; /* 최대 높이를 뷰포트 높이의 80%로 설정 */
            overflow-y: auto; /* 내용이 높이보다 크면 스크롤 표시 */
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="top">
      <a href="manager.php">
        <strong>&laquo; Manage Home </strong>
      </a>
      <span class="right">
        <?php
          if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
            if (isset($_SESSION['username'])) {
              $username = $_SESSION['username'];
              $sql = "SELECT name FROM members WHERE username = '{$username}'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $name = $row['name'];
              echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
              function redirect($url) {
                header('Location: contact.php'.$url);
                exit();
              }
            } else {
              $username = $_COOKIE['username'];
              $sql = "SELECT name FROM members WHERE username = '{$username}'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $name = $row['name'];
              echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
            }
            echo '<a href="logout.php"><strong>로그아웃</strong></a>';
          } else {
            echo '<a href="login.php"><strong>로그인</strong></a>';
          }
          echo '<a href="contact.php"><strong>고객센터</strong></a>';
        ?>
      </span>
    </div>
    <div class="answer">
        <?php
        // 데이터베이스 연결 정보
        $host = "localhost"; // MySQL 호스트 주소
        $username = "root"; // MySQL 사용자명
        $password = "Forestz01!!"; // MySQL 비밀번호
        $database = "contact"; // 사용할 데이터베이스명

        // 데이터베이스 연결
        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("데이터베이스 연결에 실패했습니다: " . mysqli_connect_error());
        }

        // SQL 쿼리 작성
        $sql = "SELECT * FROM contact";

        // SQL 쿼리 실행
        $result = mysqli_query($conn, $sql);

        // 결과 확인 및 데이터 출력
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='data-box'>";
                echo "<div><strong>이름:</strong> " . $row["name"] . "</div>";
                echo "<div><strong>전화번호:</strong> " . $row["number"] . "</div>";
                echo "<div><strong>이메일:</strong> " . $row["email"] . "</div>";
                echo "<div><strong>메시지:</strong> " . $row["message"] . "</div>";
                echo "</div>";
            }
        } else {
            echo "데이터베이스에 저장된 데이터가 없습니다.";
        }

        // 데이터베이스 연결 종료
        mysqli_close($conn);
        ?>
    </div>

    <!-- 데이터를 표시하는 팝업 창 -->
    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <div id="popup-data"></div>
        </div>
    </div>

    <script>
        // 팝업 열기 함수
        function openPopup(data) {
            var popup = document.getElementById("popup");
            var popupData = document.getElementById("popup-data");
            popupData.innerHTML = data;
            popup.style.display = "block";
        }

        // 팝업 닫기 함수
        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        }

        // 각 data-box에 클릭 이벤트 추가
        var dataBoxes = document.querySelectorAll(".data-box");
        dataBoxes.forEach(function(box) {
            box.addEventListener("click", function() {
                openPopup(box.innerHTML);
            });
        }
        );
    </script>
</body>
</html>
