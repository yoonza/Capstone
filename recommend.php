<<<<<<< HEAD:backend/recommend.php
<?php
	/*session_start();

	$conn = mysqli_connect("localhost", "root", "", "gande_member");

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
	}*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Menu recommendation</title>
        <meta name="description" content="여러분의 취향을 담아 드립니다. " />
        <meta name="keywords" content="css3, perspective, 3d, jquery, transform3d, responsive, template, restaurant, menu, leaflet, folded, flyer, concept" />
        <meta name="author" content="Codrops" />
        <!--<link rel="shortcut icon" href="../favicon.ico">--> 
        <link rel="stylesheet" type="text/css" href="recommend.css" />
		<script type="text/javascript" src="custom.js"></script>
		<!--[if lte IE 8]><style>.support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
		
			<!-- top bar -->
            <div class="top">
                <a href="main.php">
                    <strong>&laquo; GANDE HOME </strong>
                </a>
                <span class="right">
                  <?php
					if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    				// 로그인 상태
    				if (isset($_SESSION['username'])) {
        				$username = $_SESSION['username'];
						$sql = "SELECT name FROM gande_member WHERE username = '{$username}'";
            			$result = mysqli_query($conn, $sql);
            			$row = mysqli_fetch_array($result);
            			$name = $row['name'];
						echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
                        function redirect($url) {
                            header('Location: recommend.php'.$url);
                            exit();
                        }
    				} else {
        				$username = $_COOKIE['username'];
						$sql = "SELECT name FROM gande_member WHERE username = '{$username}'";
            			$result = mysqli_query($conn, $sql);
            			$row = mysqli_fetch_array($result);
            			$name = $row['name'];
            			echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
    				}
    				// 로그아웃 버튼 표시
    				echo '<a href="logout.php"><strong>로그아웃</strong></a>';

					// echo '<li><a href="mypage.php">마이페이지</a></li>';
					} else {
    				// 로그아웃 상태
    				// 로그인 버튼 표시
    				echo '<a href="login.php"><strong>로그인</strong></a>';
					}
				?>
                    <a href="contact.php">
                        <strong>고객센터</strong>
                    </a>
                </span>
            </div><!--/top bar -->
			
			<header>
				<h1>Welcome to GANDE's MENU</h1><br>
					<a href="main.php" style="color: white;"><strong>GANDE</strong></a>
				
				<!--<div class="support-note">--><!-- let's check browser support with modernizr -->
				    <!--<span class="no-cssanimations">CSS animations are not supported in your browser</span>
					<span class="no-csstransforms">CSS transforms are not supported in your browser</span>
					<span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span>
					<span class="no-csstransitions">CSS transitions are not supported in your browser</span>
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>-->
				
			</header>
			
			<section class="main">

				<div id="rm-container" class="rm-container">

					<div class="rm-wrapper">

						<div class="rm-cover">

							<div class="rm-front">
								<div class="rm-content">
									<br>
									<br>
									<h2>GANDE</h2>
									<h3>CAFE &amp; DESSERT</h3>

									<a href="#" class="rm-button-open">View Details</a>
                                    <script>
                                      const menuButton = document.getElementById("menu-button");
                                      menuButton.addEventListener("click", () => {
                                        document.body.classList.toggle("rm-open");
                                      });
                                    </script>
									<div class="rm-info">
										<p>
										<br>
										<strong>Copyright 2023<br> 
											Gande ALL RIGHTS RESERVED.</strong><br>
										EMAIL) gracekim0513@naver.com<br>
										EMAIL) wldbs1110@naver.com</p>
									</div>

								</div><!-- /rm-content -->
							</div><!-- /rm-front -->

							<div class="rm-back">
								<div class="rm-content">
								<?php
								// 'username' 키가 설정되어 있는지 확인
								if (isset($_SESSION['username'])) {
    								// 설정된 경우, 사용자 이름을 가져옵니다.
    								$username = $_SESSION['username'];
    								$sql = "SELECT name FROM gande_member WHERE username = '{$username}'";
    								$result = mysqli_query($conn, $sql);

    								// SQL 쿼리가 정상적으로 실행되었는지 확인합니다.
    								if (!$result) {
        								die(mysqli_error($conn));
    								}

    								// 사용자 이름을 출력합니다.
    								$row = mysqli_fetch_array($result);
    								if ($row) {
        								$name = $row['name'];
        								echo "<h4>{$name}님의 선호 카페</h4>";
    								} else {
        								echo "<p>로그인 후 선호하는 카페를 등록해주세요.</p>";
    								}
								} else {
    								// 설정되지 않은 경우, 로그인 후 선호하는 카페를 등록하라는 메시지를 출력합니다.
    								echo "<p>로그인 후 선호하는 카페를 등록하세요!.</p>";
								}
								?>
									<dl>
										<dt>1. 카페 리스트 추천 기능</dt>
										<dd>매일 간디 그룹에서 직접 추천 카페 리스트를 제공합니다.</dd>

										<dt>2. 사용자의 위치 인근의 카페 검색 기능</dt>
										<dd>고객이 직접 인근의 카페를 찾고 방문할 수 있습니다.</dd>

										<dt>3. 회원형 맞춤 서비스 제공</dt>
										<dd>회원/비회원에 따라 선택형 서비스를 제공합니다.</dd>

										<dt>4. 서비스 개선 상시 반영</dt>
										<dd>불편사항 혹은 개선사항은 직접 문의가 가능합니다.</dd>
										
										<dt>5. 최상의 서비스 제공, 최대의 카페 정보 제공</dt>
										<dd>항시 무료 프로그램을 제공하며, 원하는 카페를 모두 검색할 수 있습니다.</dd>
									</dl>

									<h4>카페 예약 하러 가기</h4>
									<dl>
										<dt>예약페이지로 이동하세요!</dt>
										<dd>Watercress, frisee and avocado salad</dd>
									</dl>
								</div><!-- /rm-content -->
								<div class="rm-overlay"></div>

							</div><!-- /rm-back -->

						</div><!-- /rm-cover -->

						<div class="rm-middle">
							<div class="rm-inner">
								<div class="rm-content">
									<h4>위치 별 카페 추천</h4>
									<dl>
										<dt><a href="http://herbivoracious.com/2009/03/panfried-gnocchi-with-arugula-recipe.html" class="rm-viewdetails" data-thumb="images/11.jpg">Crispy Gnocchi with Arugula</a></dt>
										<dd>Pan-fried potato gnocchi with arugula salad</dd>
										<dt>Tamari-Maple Glazed Tofu</dt>
										<dd>Wasabi emulsion, sesame seeds and scallions</dd>

										<dt>Maple Barbeque Tofu</dt>
										<dd>Grilled marinated tofu, maple barbeque sauce, tahini slaw, grilled seasonal vegetables and mashed potatoes</dd>
																													
										<dt><a href="http://herbivoracious.com/2012/07/king-oyster-mushroom-with-roasted-cherries-and-sage-no-that-isnt-meat-recipe-and-thought-process.html" class="rm-viewdetails" data-thumb="images/4.jpg">Luxur Oyster</a></dt>
										<dd>King oyster mushroom with roasted cherries and sage</dd>
										
										<dt><a href="http://herbivoracious.com/2012/09/rigatoni-with-roasted-cauliflower-and-spicy-tomato-sauce-recipe.html" class="rm-viewdetails" data-thumb="images/3.jpg">Rigatoni di Cavolfiore</a></dt>
										<dd>Rigatoni with roasted cauliflower and spicy tomato sauce</dd>
										
										<dt><a href="http://herbivoracious.com/2012/06/saffron-chickpea-stew-with-grilled-porcini-mushroom-recipe.html" class="rm-viewdetails" data-thumb="images/14.jpg">Saffron Chana Secret</a></dt>
										<dd>Saffron chickpea stew with grilled porcini mushrooms</dd>
									</dl>
								</div><!-- /rm-content -->
								<div class="rm-overlay"></div>
							</div><!-- /rm-inner -->
						</div><!-- /rm-middle -->

						<div class="rm-right">

							<div class="rm-front">
								
							</div>

							<div class="rm-back">
								<span class="rm-close">Close</span>
								<div class="rm-content">
								<h4>오늘의 추천 카페리스트</h4>
                                    <!--알고리즘 추천 -->
									<dl>
										<dt><a href="https://www.starbucks.co.kr/index.do">스타벅스</a></dt>
										<dd>시그니처 로스팅, 가벼운 식사, 무료 Wi-Fi로 잘 알려진 미국 시애틀 기반의 커피하우스 전국 ㄴㄴ체인점입니다!</dd>
										
										<dt><a href="https://www.instagram.com/cafe_annac">카페 안낙</a></dt>
										<dd>아산 신정호에 위치한 카페. 맛있는 커피와 디저트와 함께 아름다운 호수뷰를 구경하세요!</dd>
										
										<dt><a href="https://www.terarosa.com/market/main?viewName=redirect%3A%2Fmarket%2Fmain">테라로사 커피공장</a></dt>
										<dd>아름다운 강릉에서 커피 로스터리로 시작, 한국의 스페셜티 커피의 선구자인 테라로사에 방문하세요!</dd>
										
										<dt><a href="https://www.instagram.com/flower_illda/">카페 일다</a></dt>
										<dd>한창 좋아진게 나타나 보이다라는 뜻의 일다, 전대 후문에 위치한 카페입니다! </dd>
										
										<dt><a href="https://www.instagram.com/cafe_toenmaru/">카페 툇마루</a></dt>
										<dd>흑임자커피와 두부케이크가 유명한 카페 툇마루입니다. 초심을 잃지 않고 한잔한잔 준비합니다!</dd>
										
									</dl>
									<br>
									<div class="rm-order">
										<p><strong>카페 사장님이시라면?</strong><br>카페 등록 하기를 통해 사장님의 카페를 알려주세요!<br>
										<?php
										if (isset($_SESSION['roles']) && $_SESSION['roles'] === 'owner') {
											echo '<a href = ""><button type = "button">카페 등록하기</button></a>';
										} else {
											echo '카페 사장님만 작성할 수 있습니다!';
										}
										?>
										</p>
									</div>
								</div><!-- /rm-content -->
							</div><!-- /rm-back -->

						</div><!-- /rm-right -->
					</div><!-- /rm-wrapper -->

				</div><!-- /rm-container -->

			</section>
			
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="recommend.js"></script>
		<script type="text/javascript">
			$(function() {

				Menu.init();
			
			});
		</script>
    </body>
=======
<?php
	/*session_start();

	$conn = mysqli_connect("localhost", "root", "", "gande_member");

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
	}*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Menu recommendation</title>
        <meta name="description" content="여러분의 취향을 담아 드립니다. " />
        <meta name="keywords" content="css3, perspective, 3d, jquery, transform3d, responsive, template, restaurant, menu, leaflet, folded, flyer, concept" />
        <meta name="author" content="Codrops" />
        <!--<link rel="shortcut icon" href="../favicon.ico">--> 
        <link rel="stylesheet" type="text/css" href="menu.css" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:300,500|Arvo:700' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="custom.js"></script>
		<!--[if lte IE 8]><style>.support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
		
			<!-- top bar -->
            <div class="top">
                <a href="main.php">
                    <strong>&laquo; GANDE HOME </strong>
                </a>
                <span class="right">
                  <?php
					if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    				// 로그인 상태
    				if (isset($_SESSION['username'])) {
        				$username = $_SESSION['username'];
						$sql = "SELECT name FROM gande_member WHERE username = '{$username}'";
            			$result = mysqli_query($conn, $sql);
            			$row = mysqli_fetch_array($result);
            			$name = $row['name'];
						echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
                        function redirect($url) {
                            header('Location: menu.php'.$url);
                            exit();
                        }
    				} else {
        				$username = $_COOKIE['username'];
						$sql = "SELECT name FROM gande_member WHERE username = '{$username}'";
            			$result = mysqli_query($conn, $sql);
            			$row = mysqli_fetch_array($result);
            			$name = $row['name'];
            			echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
    				}
    				// 로그아웃 버튼 표시
    				echo '<a href="logout.php"><strong>로그아웃</strong></a>';

					// echo '<li><a href="mypage.php">마이페이지</a></li>';
					} else {
    				// 로그아웃 상태
    				// 로그인 버튼 표시
    				echo '<a href="login.php"><strong>로그인</strong></a>';
					}
				?>
                    <a href="contact.php">
                        <strong>고객센터</strong>
                    </a>
                </span>
            </div><!--/top bar -->
			
			<header>
				<h1>Welcome to GANDE's MENU</h1>
				<h2>
                    여러분의 취향을 담아 드립니다. <a href="main.php">GANDE</a>
				</h2>
				
				<!--<div class="support-note">--><!-- let's check browser support with modernizr -->
				    <!--<span class="no-cssanimations">CSS animations are not supported in your browser</span>
					<span class="no-csstransforms">CSS transforms are not supported in your browser</span>
					<span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span>
					<span class="no-csstransitions">CSS transitions are not supported in your browser</span>
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>-->
				
			</header>
			
			<section class="main">

				<div id="rm-container" class="rm-container">

					<div class="rm-wrapper">

						<div class="rm-cover">

							<div class="rm-front">
								<div class="rm-content">
									<br>
									<br>
									<h2>GANDE</h2>
									<h3>CAFE &amp; DESSERT</h3>

									<a href="#" class="rm-button-open">View Details</a>
                                    <script>
                                      const menuButton = document.getElementById("menu-button");
                                      menuButton.addEventListener("click", () => {
                                        document.body.classList.toggle("rm-open");
                                      });
                                    </script>
									<div class="rm-info">
										<p>
										<br>
										<strong>Copyright 2023. Gande ALL RIGHTS RESERVED.</strong><br>
										<strong>EMAIL</strong> gracekim0513@naver.com<br>
										<strong>EMAIL</strong> wldbs1110@naver.com</p>
									</div>

								</div><!-- /rm-content -->
							</div><!-- /rm-front -->

							<div class="rm-back">
								<div class="rm-content">
								<?php
								// 'username' 키가 설정되어 있는지 확인
								if (isset($_SESSION['username'])) {
    								// 설정된 경우, 사용자 이름을 가져옵니다.
    								$username = $_SESSION['username'];
    								$sql = "SELECT name FROM gande_member WHERE username = '{$username}'";
    								$result = mysqli_query($conn, $sql);

    								// SQL 쿼리가 정상적으로 실행되었는지 확인합니다.
    								if (!$result) {
        								die(mysqli_error($conn));
    								}

    								// 사용자 이름을 출력합니다.
    								$row = mysqli_fetch_array($result);
    								if ($row) {
        								$name = $row['name'];
        								echo "<h4>{$name}님의 선호 카페</h4>";
    								} else {
        								echo "<p>로그인 후 선호하는 카페를 등록해주세요.</p>";
    								}
								} else {
    								// 설정되지 않은 경우, 로그인 후 선호하는 카페를 등록하라는 메시지를 출력합니다.
    								echo "<p>로그인 후 선호하는 카페를 등록해주세요.</p>";
								}
								?>
									<dl>
										<dt>Bella's Artichokes</dt>
										<dd>Roasted artichokes with chipotle aioli and cream cheese</dd>

										<dt>Bruschetta Blue Delight</dt>
										<dd>Blue cheese and citrus bruschetta</dd>

										<dt>Pomme Dulse</dt>
										<dd>Baked potatoes with crisped dulse</dd>

										<dt><a href="http://herbivoracious.com/2011/11/crostini-with-young-pecorino-grilled-figs-and-arugula-mint-pesto-recipe.html" class="rm-viewdetails" data-thumb="images/1.jpg">Green Love Crostini</a></dt>
										<dd>Crostini with young pecorino, grilled figs and arugula &amp; mint pesto</dd>
										
										<dt>Focaccia di Carciofi</dt>
										<dd>Artichoke focaccia with fresh thyme</dd>
									</dl>

									<h4>카페 예약 하러 가기</h4>
									<dl>
										<dt>Green Delight</dt>
										<dd>Watercress, frisee and avocado salad</dd>

										<dt><a href="http://herbivoracious.com/2010/02/thai-tofu-salad-recipe.html" class="rm-viewdetails" data-thumb="images/13.jpg">Gourmet Yam Taohu</a></dt>
										<dd>Thai tofu salad yam taohu</dd>

										<dt>Panini Deluxe</dt>
										<dd>Buffalo mozzarella basil panini</dd>
									</dl>
								</div><!-- /rm-content -->
								<div class="rm-overlay"></div>

							</div><!-- /rm-back -->

						</div><!-- /rm-cover -->

						<div class="rm-middle">
							<div class="rm-inner">
								<div class="rm-content">
									<h4>위치 별 카페 추천</h4>
									<dl>
										<dt><a href="http://herbivoracious.com/2009/03/panfried-gnocchi-with-arugula-recipe.html" class="rm-viewdetails" data-thumb="images/11.jpg">Crispy Gnocchi with Arugula</a></dt>
										<dd>Pan-fried potato gnocchi with arugula salad</dd>

										<dt>Sea Palm Spicy Peanut Curry</dt>
										<dd>Tender sea palm noodles, seasoned vegetables, spicy peanut curry and tempeh fenel croquettes</dd>

										<dt><a href="http://herbivoracious.com/2012/09/caviar-lentil-salad-with-arugula-crispy-shallots-and-roasted-garlic-recipe.html" class="rm-viewdetails" data-thumb="images/8.jpg">Lentil Caviar &amp; Arugula</a></dt>
										<dd>Black lentil curry with arugula salad, caramelized shallots and roasted garlic</dd>

										<dt>Tamari-Maple Glazed Tofu</dt>
										<dd>Wasabi emulsion, sesame seeds and scallions</dd>

										<dt>Maple Barbeque Tofu</dt>
										<dd>Grilled marinated tofu, maple barbeque sauce, tahini slaw, grilled seasonal vegetables and mashed potatoes</dd>
																													
										<dt><a href="http://herbivoracious.com/2012/07/king-oyster-mushroom-with-roasted-cherries-and-sage-no-that-isnt-meat-recipe-and-thought-process.html" class="rm-viewdetails" data-thumb="images/4.jpg">Luxur Oyster</a></dt>
										<dd>King oyster mushroom with roasted cherries and sage</dd>
										
										<dt><a href="http://herbivoracious.com/2012/09/rigatoni-with-roasted-cauliflower-and-spicy-tomato-sauce-recipe.html" class="rm-viewdetails" data-thumb="images/3.jpg">Rigatoni di Cavolfiore</a></dt>
										<dd>Rigatoni with roasted cauliflower and spicy tomato sauce</dd>
										
										<dt><a href="http://herbivoracious.com/2012/06/saffron-chickpea-stew-with-grilled-porcini-mushroom-recipe.html" class="rm-viewdetails" data-thumb="images/14.jpg">Saffron Chana Secret</a></dt>
										<dd>Saffron chickpea stew with grilled porcini mushrooms</dd>
									</dl>
								</div><!-- /rm-content -->
								<div class="rm-overlay"></div>
							</div><!-- /rm-inner -->
						</div><!-- /rm-middle -->

						<div class="rm-right">

							<div class="rm-front">
								
							</div>

							<div class="rm-back">
								<span class="rm-close">Close</span>
								<div class="rm-content">
									<h4>Gande's Hot Place</h4>
                                    <!--알고리즘 추천 -->
									<dl>
										<dt><a href="https://www.starbucks.co.kr/index.do">스타벅스 강남R점</a></dt>
										<dd>시그니처 로스팅, 가벼운 식사, 무료 Wi-Fi로 잘 알려진 미국 시애틀 기반의 커피하우스 체인점입니다!</dd>
										
										<dt><a href="https://www.instagram.com/cafe_annac">카페 안낙</a></dt>
										<dd>아산 신정호에 위치한 카페. 맛있는 커피와 디저트와 함께 아름다운 호수뷰를 구경하세요!</dd>
										
										<dt><a href="https://www.terarosa.com/market/main?viewName=redirect%3A%2Fmarket%2Fmain">테라로사 커피공장 강릉본점</a></dt>
										<dd>아름다운 강릉에서 커피 로스터리로 시작, 한국의 스페셜티 커피의 선구자인 테라로사에 방문하세요!</dd>
										
										<dt><a href="https://www.instagram.com/flower_illda/">카페 일다</a></dt>
										<dd>한창 좋아진게 나타나 보이다라는 뜻의 일다, 전대 후문에 위치한 카페입니다! </dd>
										
										<dt><a href="https://www.instagram.com/cafe_toenmaru/">카페 툇마루</a></dt>
										<dd>흑임자커피와 두부케이크가 유명한 카페 툇마루입니다. 초심을 잃지 않고 한잔한잔 준비합니다!</dd>
										
										<dt><a href="https://www.mega-mgccoffee.com/">메가MGC커피 부천소사본점</a></dt>
										<dd>언제 어디서나, 부담스럽지 않은 가격과 대용량으로 모든 사람들에게 사랑받는 메가MGC커피 입니다.</dd>
										
										<dt><a href="https://www.instagram.com/allthatcoffee/">올댓커피 본점</a></dt>
										<dd>에스프레소 및 커피와 디저트를 판매하는 한국의 에스프레소바 카페입니다.</dd>
									</dl>
									<div class="rm-order">
										<p><strong>카페 사장님이시라면?</strong><br>카페 등록 하기를 통해 사장님의 카페를 알려주세요!<br>
										<?php
										if (isset($_SESSION['roles']) && $_SESSION['roles'] === 'owner') {
											echo '<a href = ""><button type = "button">카페 등록하기</button></a>';
										} else {
											echo '카페 사장님만 작성할 수 있습니다!';
										}
										?>
										</p>
									</div>
								</div><!-- /rm-content -->
							</div><!-- /rm-back -->

						</div><!-- /rm-right -->
					</div><!-- /rm-wrapper -->

				</div><!-- /rm-container -->

			</section>
			
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="menu.js"></script>
		<script type="text/javascript">
			$(function() {

				Menu.init();
			
			});
		</script>
    </body>
>>>>>>> eaf0fdd801ea58481f89cfda56872fa726fc40a4:backend/menu.php
</html>