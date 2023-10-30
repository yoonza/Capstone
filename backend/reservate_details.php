<?php
    session_start();
    header('Content-Type: text/html; charset = utf-8');

    $selectedSeatNumbers = "좌석이 선택되지 않았습니다."; // 변수 초기화

    $conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_SESSION['username'])) {
        $is_login = false;
        if ($is_login) {
            $is_login = true;
            setcookie('username', $username, time() + 3600, '/');
            session_start();
            $_SESSION['username'] = $username;
        }

        $selectedTimeInfo = isset($_GET['selectedTime']) ? $_GET['selectedTime'] : '';
        $currentDate = isset($_GET['currentDate']) ? $_GET['currentDate'] : '';
        $selectedSeatInfo = isset($_GET['selectedSeats']) ? $_GET['selectedSeats'] : ''; // 선택한 좌석 번호 가져오기



        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve'])) {
            // POST 요청을 처리하여 예약 정보를 저장
            $username = $_SESSION['username'];
            $cafe_name = "Starbucks"; // 예약한 카페 이름을 여기에 추가
            $reserved_time = $selectedTimeInfo; // 선택한 시간대를 사용
            $reservation_date = $currentDate; // 오늘의 날짜를 사용
        
            $selectedSeats = isset($_POST['selectedSeats']) ? $_POST['selectedSeats'] : '';
            $selectedTables = isset($_POST['selectedTables']) ? $_POST['selectedTables'] : '';
            $selectedSeatInfo = isset($_GET['selectedSeats']) ? $_GET['selectedSeats'] : ''; // 선택한 좌석 번호 가져오기

        
            $sql = "INSERT INTO reservation (username, cafe_name, reserved_time, reservation_date, selected_seats, ) 
                    VALUES ('$username', '$cafe_name', '$reserved_time', '$reservation_date', '$selectedSeats')";
        
            if (mysqli_query($conn, $sql)) {
                // 예약 정보가 성공적으로 저장되었을 때 실행할 코드
                echo "예약이 성공적으로 저장되었습니다.";
            } else {
                // 저장 중 오류가 발생한 경우 실행할 코드
                echo "예약 저장 중 오류가 발생했습니다: " . mysqli_error($conn);
            }
        }
        
        
?>

<!DOCTYPE html>
<html lang = "en">
<meta charset = "utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>예약 정보</title>

    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
    <style>
        * { 
           margin: 0 auto;
           font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;       
        }

        body {
            background-color: #8fbc8f;
        }

        h1 {
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;   
            font-weight: bold;
        }

        a {
            color: #333;
            text-decoration: none;
        }
        .find {
            text-align: center;
            width: 500px;
            height: 200px;
            margin-top: 280px;
            align-items: center;
        }

        input[type="submit"] {
            height: 35px;
            width: 180px;
            background-color: #3a3a3a;
            color: white;
            border: 2px solid #999;
            border: none;
            display: inline-block;
        }

        input[type="submit"]:hover {
            background-color: lightgray;
        }

        input[type="reset"] {
            height: 35px;
            width: 180px;
            background-color: #3a3a3a;
            color: white;
            border: 2px solid #999;
            border: none;
            display: inline-block;
        }

        input[type="reset"]:hover {
            background-color: lightgray;
        }

        fieldset {
             border: 2px solid #000; /* 테두리 굵기 및 색상 설정 */
             font-weight: bolder;
        }

        .top {
            line-height: 24px;
            font-size: 11px;
            background: #fff;
            background: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            z-index: 9999;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            font-family: Cambria, Georgia, serif;
            box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
            text-decoration: none;
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
    </style>
    <link rel = stylesheet href = 'details.css' type = 'text/css' />
    <body>
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
				    // 로그아웃 버튼 표시
				    echo '<a href="logout.php"><strong>로그아웃</strong></a>';

				    // echo '<li><a href="mypage.php">마이페이지</a></li>';
				    } else {
				    // 로그아웃 상태
    			    // 로그인 버튼 표시
    			    echo '<a href="login.php"><strong>로그인</strong></a>';
				    }
                    echo '<a href="contact.php"><strong>고객센터</strong></a>';
			    ?>
            </span>
        </div>
        <div class = "find">
            <form method = "post" action = "main.php">
                <?php
                    $sql = "SELECT * FROM members WHERE username = '{$_SESSION['username']}'";
                    $result = mysqli_query($conn, $sql);
                    $gande_member = mysqli_fetch_array($result);
                    if (!$gande_member) { // 회원 정보가 없는 경우
                        echo "<script>alert('회원 정보를 찾을 수 없습니다.'); history.back();</script>";
                        exit;
                    }

                    $selectedTimeInfo = $_GET['selectedTime'];
                    $currentDate = $_GET['currentDate'];
                    $selectedSeatInfo = $_GET['selectedSeats'];

                ?>
                <h1>Reservation Details</h1>
                <br><fieldset>
                    <table>
                        <tr>
                            <td>이름</td>
                            <td><input type = "text" size = "20" name = "name" placeholder = "이름" value = "<?php echo $gande_member['name']; ?>" style="height: 20px; width:120px;"></td>
                        </tr>
                        <tr>
                            <td>전화번호</td>
                            <td><input type = "text" size = "20" name = "phone" placeholder = "전화번호" value = "<?php echo $gande_member['phone']; ?>" style="height: 20px; width:120px;"></td>
                        </tr>
                        <tr>
                            <td>선택한 시간대</td>
                            <td><?php echo $selectedTimeInfo; ?></td>
                        </tr>
                        <tr>
                            <td>오늘의 날짜</td>
                            <td><?php echo $currentDate; ?></td>
                        </tr>
                        <tr>
                            <td>카페 이름</td>
                            <td><div class="cafe-container">
                                <select id="cafe" style="height: 30px; width:120px;">
                                    <option value>Starbucks</option>
                                </select></td>
                            </div></td>
                        </tr>
                        <tr>
                            <td>선택한 좌석 번호</td>
                            <td><?php echo $selectedSeatInfo; ?></td>
                       </tr>
                    </table>
                </fieldset>
                <br><br>
                <div class = "text-center">
                    <input type="reset" value="시간 다시 선택하기" onclick="location.href='realtime.php';"/>
                    <input type = "submit" name="reserve" value = "예약하기">
                </div>
            </form>
        </div>
    </body>
</html>

<?php 
    } else { // 로그인 되어 있지 않은 경우
        echo "<script>alert('로그인 후 이용해주세요.'); location.href='login.php';</script>";
        exit;
    }
?>