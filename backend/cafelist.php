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
    <title>원하는 카페를 검색하세요!</title>
    <link rel="stylesheet" type="text/css" href="cafelist.css">
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
    <style>
        /* 가운데 정렬을 위한 CSS 스타일 */
        body {
            text-align: center; /* body 요소 내의 모든 내용을 가운데 정렬합니다. */
        }

        h1 {
            font-size: 2em; /* 원하는 글꼴 크기로 조정하세요 */
            text-align: center;
            text-transform: uppercase; /* 텍스트를 대문자로 변환 */
            color: white; /* 텍스트 색상 */
            transform: perspective(300px) rotateX(20deg); /* 3D 효과 적용 */
            }
        form {
            text-align: center; /* form 요소 내의 모든 내용을 가운데 정렬합니다. */
        }

        ul {
            list-style: none; /* ul 요소의 리스트 마커를 제거합니다. */
            padding: 0; /* ul 요소의 패딩을 제거합니다. */
        }

        li {
            text-align: center; /* li 요소 내용을 가운데 정렬합니다. */
            font-weight: bold; /* 글꼴 굵기를 설정하여 텍스트를 굵게 표시합니다. */
            padding: 10px; /* 각 항목의 내부 여백을 설정합니다. */
            border: 2px solid #DCDCDC; /* 항목의 테두리를 설정합니다. */
            border-radius: 10px; /* 항목의 모서리를 둥글게 설정합니다. */
            margin: 10px; /* 항목 간의 간격을 설정합니다. */
            transition: transform 0.3s; /* hover 시 애니메이션 효과를 위한 속성 추가 */
            background-color:white; /* 배경색을 설정합니다. */
            color:black;
        }

        /* hover 상태일 때의 스타일 변경 */
        li:hover {
            transform: scale(1.05); /* hover 시 확대 애니메이션 효과 */
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2); /* 그림자 효과 추가 */
        }

        /* 카드 내부 텍스트 스타일 */
        .card p {
            font-size: 10px; /* 원하는 글자 크기로 설정 */
            color: white; /* 글씨 색상을 하얀색으로 설정합니다. */
            font-weight: bold; /* 글꼴 굵기를 설정하여 텍스트를 굵게 표시합니다. */
        }

        input[type="submit"] {
            padding: 8px 15px; /* 버튼 크기 조정 */
            background-color: #d3d3d3; /* 배경색 설정 */
            color:black; /* 텍스트 색상 설정 */
            font-weight: bold;
            border: none; /* 테두리 없음 */
            border-radius: 5px; /* 둥근 모서리 설정 */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* 그림자 효과 설정 */
            cursor: pointer; /* 커서 스타일 변경 */
            transition: background-color 0.3s; /* 배경색 변경에 애니메이션 추가 */

            /* 가로 중앙 정렬 스타일 추가 */
            margin: 0 auto;
            display: block;
            width: 100px;
}

        /* 검색 버튼에 마우스 호버 효과 추가 */
        input[type="submit"]:hover {
            background-color: silver; /* 호버 시 배경색 변경 */
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
    <h1>SEARCH YOUR CAFE !</h1>
    
    <form method="post" action="">
        <input type="text" id="search" name="search"><br>
        <input type="submit" value="검색">
        <br>

        <a href="new_cafe.php" style="text-decoration: none; margin-left: 10px;">
        <button type="button">내 카페 등록</button>
    </form>
    
    <ul>
        <?php
        $message = ""; // 초기 메시지 변수를 설정합니다.
        $found = false; // 검색 결과 여부를 저장하는 변수를 초기화합니다.

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];
            $files = array(
                "/Users/yoonza/Desktop/Capstone/backend/data/R_busan.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Seoul.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Gyeonggi.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Gwangju.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Gangwon.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Gyeongnam.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Gyeongbuk.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Jeonnam.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Jeonbuk.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Jeju.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Ulsan.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Incheon.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Chungbuk.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Chungnam.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Daegu.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/R_Sejong.csv",
                "/Users/yoonza/Desktop/Capstone/backend/data/Starbucks.csv"
            );

            foreach ($files as $file) {
                if (!empty($search)) { // $search가 비어 있지 않은 경우에만 데이터 출력
                    if (($handle = fopen($file, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            if (count($data) > 3) {
                                $name = $data[0];
                                $address = $data[1];
                                $latitude = $data[2];
                                $longitude = $data[3];

                                if (stripos($name, $search) !== false) {
                                    // 각 데이터를 리스트 항목으로 출력
                                    echo "<li>";
                                    echo "<h3>$name</h3>";
                                    echo "<p>도로명주소: $address</p>";
                                    echo "<p>위도: $latitude</p>";
                                    echo "<p>경도: $longitude</p>";
                                    echo "</li>";

                                    $found = true; // 검색 결과를 찾았음을 표시합니다.
                                }
                            } else {
                                $message = "찾으시는 카페가 없습니다."; // 데이터 형식 오류 메시지
                            }
                        }
                        fclose($handle);
                    } else {
                        $message = "파일을 열 수 없습니다."; // 파일 열기 오류 메시지
                    }
                } else {
                    $message = "검색어를 입력하세요."; // 검색어 입력 안한 경우 메시지
                }
            }
        }

        if (!$found) {
            if (!empty($message)) {
                echo "<li>$message</li>";
            } else {
            }
        }
        ?>
        <?php
        // MySQL 데이터베이스 연결 설정
        $host = "localhost";
        $username = "root"; // MySQL 사용자명
        $password = "Forestz01!!"; // MySQL 비밀번호
        $database = "gande_member"; // 데이터베이스 이름

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("데이터베이스 연결에 실패했습니다: " . mysqli_connect_error());
        }

        // SQL 쿼리 실행
        $sql = "SELECT * FROM cafes"; // cafes 테이블에서 모든 카페 정보를 선택
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // 결과 처리
            echo "<ul>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>도로명주소: " . $row['address'] . "</p>";
                echo "<p>위도: " . $row['latitude'] . "</p>";
                echo "<p>경도: " . $row['longitude'] . "</p>";
                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "카페 정보를 가져오는 데 실패했습니다: " . mysqli_error($conn);
        }

        // 데이터베이스 연결 닫기
        mysqli_close($conn);
        ?>

    </ul>
    <script>
        // 카드 클릭 이벤트를 막음
document.querySelectorAll('li').forEach(function(card) {
    card.addEventListener('click', function(event) {
        event.preventDefault(); // 기본 동작을 막음
    });
});
    </script>
</body>
</html>