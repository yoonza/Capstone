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
    <title>Reservation Information</title>
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        }
        body {
            background-color: #8fbc8f;
        }
        h1 {
            text-align: center;
            color: gray;
            
        }
        h1:hover {
            color: black;
        }
        h4 {
            text-align: center;
        }

        .card-container {
            display: flex;
            overflow-x: scroll;
            white-space: nowrap;
            background-color: white;
        }

        .card {
            background-color: #ddd;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 20px;
            padding: 20px;
            display: inline-block;
            width: 300px;
            color: gray;
            transition: transform 0.2s;
            align-items: center;

        }

        .card:hover {
            transform: scale(1.05);
            color: black;
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


    </style>
</head>
<body>
        	<!-- top bar -->
            <div class="top">
    <a href="main.php" style="float: left; text-decoration: none;">
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
                echo "<a href='mypage.php' style='text-decoration: none;'><strong>{$name}님 환영합니다!</strong></a>";
            } else {
                $username = $_COOKIE['username'];
                $sql = "SELECT name FROM members WHERE username = '{$username}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $name = $row['name'];
                echo "<a href='mypage.php' style='text-decoration: none;'><strong>{$name}님 환영합니다!</strong></a>";
            }
            // 로그아웃 버튼 표시
            echo '<a href="logout.php" style="text-decoration: none;"><strong>로그아웃</strong></a>';
        } else {
            // 로그아웃 상태
            // 로그인 버튼 표시
            echo '<a href="login.php" style="text-decoration: none;"><strong>로그인</strong></a>';
        }
        ?>
        <a href="contact.php" style="text-decoration: none;">
            <strong>고객센터</strong>
        </a>
    </span>
</div><!--/top bar -->
<br><br>
    <h1>Cafe Reservation-List</h1>
    <h4>예약된 내역을 해당 페이지에서 확인할 수 있습니다.</h4>
    <div class="card-container" id="card-container">

        <?php
        // 데이터베이스 연결 설정
        $servername = "localhost";
        $username = "root";
        $password = "Forestz01!!";
        $dbname = "gande_member";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // 연결 확인
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 데이터베이스에서 데이터를 가져와서 출력
        $sql = "SELECT username, cafe_name, reserved_time, reservation_date, selected_seats FROM reservation";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo "<h2>Username: " . $row["username"] . "</h2>";
                echo "<p>Cafe Name: " . $row["cafe_name"] . "</p>";
                echo "<p>Reserved Time: " . $row["reserved_time"] . "</p>";
                echo "<p>Reservation Date: " . $row["reservation_date"] . "</p>";
                echo "<p>Selected Seats: " . $row["selected_seats"] . "</p>";
                echo '</div>';
            }
        } else {
            echo "No reservations found.";
        }

        // 데이터베이스 연결 닫기
        $conn->close();
        ?>
    </div>

    <script>
        const cardContainer = document.getElementById("card-container");
        const cards = document.querySelectorAll(".card");

        let currentIndex = 0;
        let interval;

        function slideCards() {
            currentIndex = (currentIndex + 1) % cards.length;
            cardContainer.scrollTo(cards[currentIndex].offsetLeft, 0);
        }

        interval = setInterval(slideCards, 3000); // 3 seconds interval
    </script>
</body>
</html>
