<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = ''; // 빈 문자열로 $name을 초기화합니다.

    // 사용자가 로그인한 경우 확인
    if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
        // 사용자가 로그인한 경우
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $sql = "SELECT name FROM members WHERE username = '{$username}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $name = $row['name']; // $name 업데이트
        } else {
            $username = $_COOKIE['username'];
            $sql = "SELECT name FROM members WHERE username = '{$username}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $name = $row['name']; // $name 업데이트
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="realtime.css">
    <title>실시간 예약 페이지</title>
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
</head>
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
                } else {
                    // 로그아웃 상태
                    // 로그인 버튼 표시
                    echo '<a href="login.php"><strong>로그인</strong></a>';
                }
                echo '<a href="contact.php"><strong>고객센터</strong></a>';
            ?>
        </span>
    </div>
    <div class="reservation-info">
        <strong><?php echo "{$name}님 현재 예약 가능 시간은"; ?></strong>
        <span id="countdown-timer">3:00</span>
    </div>
    
    <div class="calendar">
        <div class="calendar-header">
            <span id="current-month-year"></span>
        </div>
        <div class="calendar-weekdays">
            <div class="calendar-day">일</div>
            <div class="calendar-day">월</div>
            <div class="calendar-day">화</div>
            <div class="calendar-day">수</div>
            <div class="calendar-day">목</div>
            <div class="calendar-day">금</div>
            <div class="calendar-day">토</div>
        </div>
        <div class="calendar-grid" id="calendar-grid"></div>
    </div>

    <!-- 시간표를 표시할 영역 추가 -->
    <div id="timeTableContainer">
        <h2 id="selected-date">날짜를 선택하세요.</h2>
        <table id="timeTable">
            <caption></caption>
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- 이 부분에 시간대를 추가할 수 있습니다. -->
            </tbody>
        </table>
    </div>

    <script src="realtime.js"></script>
</body>
</html>