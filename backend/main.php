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
<html>
<head>
	<title>GANDE</title>
	<link rel="icon" href="/Users/yoonza/Desktop/Capstone/backend/mainfa.png" type="image/x-icon">  <!-- 지도맵 파비콘 생성 -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<link rel = stylesheet href = 'main.css' type = 'text/css' />
	<script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
	<style>
		* {margin:0;padding:0;}
		.section input[id*="slide"] {display:none;}
		.section .slidewrap {max-width:1200px;margin:0 auto;}
		.section .slidelist {white-space:nowrap;font-size:0;overflow:hidden;position:relative;}
		.section .slidelist > li {display:inline-block;vertical-align:middle;width:100%;transition:all .5s;}
		.section .slidelist > li > a {display:block;position:relative;}
		.section .slidelist > li > a img {width:70%; margin-left: 170px;}
		.section .slidelist label {position:absolute;z-index:10;top:50%;transform:translateY(-50%);padding:50px;cursor:pointer;}
		.section .slidelist .textbox {position:absolute;z-index:1;top:50%;left:50%;transform:translate(-50%,-50%);line-height:1.6;text-align:center;}
		.section .slidelist .textbox h3 {font-size:36px;color:#fff;;transform:translateY(30px);transition:all .5s;}
		.section .slidelist .textbox p {font-size:16px;color:#fff;opacity:0;transform:translateY(30px);transition:all .5s;}
	
		/* input에 체크되면 슬라이드 효과 */
		.section input[id="slide01"]:checked ~ .slidewrap .slidelist > li {transform:translateX(0%);}
		.section input[id="slide02"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-100%);}
		.section input[id="slide03"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-200%);}
		.section input[id="slide04"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-300%);}
		.section input[id="slide05"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-400%);}
		.section input[id="slide06"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-500%);}
		.section input[id="slide07"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-600%);}
		.section input[id="slide08"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-700%);}
		.section input[id="slide09"]:checked ~ .slidewrap .slidelist > li {transform:translateX(-800%);}

		/* input에 체크되면 텍스트 효과 */
		.section input[id="slide01"]:checked ~ .slidewrap li:nth-child(1) .textbox h3 {opacity:1;transform:translateY(0);transition-delay:.2s;}
		.section input[id="slide01"]:checked ~ .slidewrap li:nth-child(1) .textbox p {opacity:1;transform:translateY(0);transition-delay:.4s;}
		.section input[id="slide02"]:checked ~ .slidewrap li:nth-child(2) .textbox h3 {opacity:1;transform:translateY(0);transition-delay:.2s;}
		.section input[id="slide02"]:checked ~ .slidewrap li:nth-child(2) .textbox p {opacity:1;transform:translateY(0);transition-delay:.4s;}
		.section input[id="slide03"]:checked ~ .slidewrap li:nth-child(3) .textbox h3 {opacity:1;transform:translateY(0);transition-delay:.2s;}
		.section input[id="slide03"]:checked ~ .slidewrap li:nth-child(3) .textbox p {opacity:1;transform:translateY(0);transition-delay:.4s;}

		/* 좌,우 슬라이드 버튼 */
		.slide-control > div {display:none;}
		.section .left {left:30px;background:url('left.png') center center / 100% no-repeat; background-size: 50px;}
		.section .right {right:30px;background:url('right.png') center center / 100% no-repeat; background-size: 50px;}
		.section input[id="slide01"]:checked ~ .slidewrap .slide-control > div:nth-child(1) {display:block;}
		.section input[id="slide02"]:checked ~ .slidewrap .slide-control > div:nth-child(2) {display:block;}
		.section input[id="slide03"]:checked ~ .slidewrap .slide-control > div:nth-child(3) {display:block;}
		.section input[id="slide04"]:checked ~ .slidewrap .slide-control > div:nth-child(4) {display:block;}
		.section input[id="slide05"]:checked ~ .slidewrap .slide-control > div:nth-child(5) {display:block;}
		.section input[id="slide06"]:checked ~ .slidewrap .slide-control > div:nth-child(6) {display:block;}
		.section input[id="slide07"]:checked ~ .slidewrap .slide-control > div:nth-child(7) {display:block;}
		.section input[id="slide08"]:checked ~ .slidewrap .slide-control > div:nth-child(8) {display:block;}
		.section input[id="slide09"]:checked ~ .slidewrap .slide-control > div:nth-child(9) {display:block;}

		/* 페이징 */
		.slide-pagelist {text-align:center;padding:20px;}
		.slide-pagelist > li {display:inline-block;vertical-align:middle;}
		.slide-pagelist > li > label {display:block;padding:8px 15px;border-radius:30px;background:white;margin:15px 10px;cursor:pointer;}
		.section input[id="slide01"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(1) > label {background:#999;}
		.section input[id="slide02"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(2) > label {background:#999;}
		.section input[id="slide03"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(3) > label {background:#999;}
		.section input[id="slide04"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(4) > label {background:#999;}
		.section input[id="slide05"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(5) > label {background:#999;}
		.section input[id="slide06"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(6) > label {background:#999;}
		.section input[id="slide07"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(7) > label {background:#999;}
		.section input[id="slide08"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(8) > label {background:#999;}
		.section input[id="slide09"]:checked ~ .slidewrap .slide-pagelist > li:nth-child(9) > label {background:#999;}
	
		.amount{
    		position: relative;
    		top:-15px;
    		display: flex;
    		width:100%;
    		background: #fff;
    		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    		margin: auto;
			list-style: none;
  		}
  		.amount > li {
    		flex: 1;
    		height: 132px;
  		}
  		.amount > li > div {
    		text-align: center;
    		margin-top:40px;
    		height:57px;
  		}
  		.amount > li:not(:last-child) > div{
    		border-right:1px solid #E1E1E1;
  		}
		.button {
			color: gray; /* 버튼 텍스트의 기본 색상 */
			font-weight: bold;
			text-decoration: none; /* 텍스트 밑줄 제거 */
		}

		.button:hover {
			color: red; /* 버튼에 마우스 호버 시 텍스트 색상을 빨간색으로 변경 */
		}	
	</style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>&nbsp;&nbsp;GANDE</h1>
            <ul class="nav-menu">
				<?php
					if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    				// 로그인 상태
    				if (isset($_SESSION['username'])) {
        				$username = $_SESSION['username'];
						$sql = "SELECT name FROM members WHERE username = '{$username}'";
            			$result = mysqli_query($conn, $sql);
            			$row = mysqli_fetch_array($result);
            			$name = $row['name'];
						echo "<li><strong><a href='mypage.php'>{$name}님 환영합니다!</a></strong></li>";
    				} else {
        				$username = $_COOKIE['username'];
						$sql = "SELECT name FROM members WHERE username = '{$username}'";
            			$result = mysqli_query($conn, $sql);
            			$row = mysqli_fetch_array($result);
            			$name = $row['name'];
            			echo "<li><strong><a href='mypage.php'>{$name}님 환영합니다!</a></strong></li>";
    				}
    				// 로그아웃 버튼 표시
    				echo '<li><strong><a href="logout.php">로그아웃</a></strong></li>';

					// echo '<li><a href="mypage.php">마이페이지</a></li>';
					} else {
    				// 로그아웃 상태
    				// 로그인 버튼 표시
    				echo '<li><strong><a href="login.php">로그인</a></strong></li>';
					}
				?> 
                &nbsp;&nbsp;<li><strong><a href="gande_member.php">회원가입</a></strong></li>&nbsp;&nbsp;&nbsp;
				<li><strong><a href="contact.php">고객센터</a></strong><li>
				<li><strong><a href="manager.php">관리자페이지</a></strong><li>
            </ul>
        </div>
		
    </header>
	<nav>
		<ul>
			<li><a href="main.php">Home</a></li>
			<li><a href="cafelist.php">CAFE</a></li>
			<li><a href="map.php">POSITION</a></li>
			<li><a href="reservation.php">RESERVATION</a></li>
		</ul>
	</nav>
	<div class="section">
    <input type="radio" name="slide" id="slide01" checked>
    <input type="radio" name="slide" id="slide02">
    <input type="radio" name="slide" id="slide03">
    <input type="radio" name="slide" id="slide04">
    <input type="radio" name="slide" id="slide05">
    <input type="radio" name="slide" id="slide06">
    <input type="radio" name="slide" id="slide07">
    <input type="radio" name="slide" id="slide08">
    <input type="radio" name="slide" id="slide09">
    <div class="slidewrap">
        <ul class="slidelist">
            <!-- 슬라이드 영역 -->
            <li class="slideitem">
                <a>
                    <img src="/assets/1-3.jpg" alt="Slide 1 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/2-1.jpg" alt="Slide 2 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/3-1.jpg" alt="Slide 3 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/4-1.jpg" alt="Slide 4 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/5-1.jpg" alt="Slide 5 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/6-1.jpg" alt="Slide 6 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/7-1.jpg" alt="Slide 7 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/8-1.jpg" alt="Slide 8 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
            <li class="slideitem">
                <a>
                    <img src="/assets/9-1.jpg" alt="Slide 9 Image" style="width: 82%; height: auto; margin-left: 9%">
                </a>
            </li>
							<!-- 좌,우 슬라이드 버튼 -->
		<div class="slide-control">
			<div>
				<label for="slide01" class="left"></label>
				<label for="slide02" class="right"></label>
			</div>
			<div>
				<label for="slide02" class="left"></label>
				<label for="slide03" class="right"></label>
			</div>
			<div>
				<label for="slide03" class="left"></label>
				<label for="slide04" class="right"></label>
			</div>
			<div>
				<label for="slide04" class="left"></label>
				<label for="slide05" class="right"></label>
			</div>
			<div>
				<label for="slide05" class="left"></label>
				<label for="slide06" class="right"></label>
			</div>
			<div>
				<label for="slide06" class="left"></label>
				<label for="slide07" class="right"></label>
			</div>
			<div>
				<label for="slide07" class="left"></label>
				<label for="slide08" class="right"></label>
			</div>
			<div>
				<label for="slide08" class="left"></label>
				<label for="slide09" class="right"></label>
			</div>
			<div>
				<label for="slide09" class="left"></label>
				<label for="slide01" class="right"></label>
			</div>
		</div>


        </ul>
        <!-- 페이징 -->
        <ul class="slide-pagelist">
            <li><label for="slide01"></label></li>
            <li><label for="slide02"></label></li>
            <li><label for="slide03"></label></li>
            <li><label for="slide04"></label></li>
            <li><label for="slide05"></label></li>
            <li><label for="slide06"></label></li>
            <li><label for="slide07"></label></li>
            <li><label for="slide08"></label></li>
            <li><label for="slide09"></label></li>
        </ul>
    </div>
</div>

<ul class="amount">
    <li>
        <div>
            <div class="contents1">등록된 카페 수</div>
            <div class="result">107,957</div>
        </div>
    </li>
    <li>
        <div>
            <div class="contents1">서비스 이용자 수</div>
            <div class="result" id = "user_count"><?php include 'user_count.php'; ?></div>
        </div>
		<script>
		/*$(document).ready(function() {
    		setInterval(function() {
        		$.ajax({
            		type: 'GET',
            		url: 'user_count.php',
            		success: function(data) {
                		$('#user_count').text(data);
            		}
        		});
    		}, 5000);
		});*/
		</script>
    </li>
    <li>
        <div>
            <div class="contents1">카페 예약 목록</div>
			<a href="view_reservations.php" class="button">예약 조회</a>
        </div>
    </li>
    <li>
        <div>
            <div class="contents1">오늘의 카페 추천</div>
            <a href="recommend.php" class="button">추천 확인</a>		
        </div>
    </li>
</ul>
</body>
</html>