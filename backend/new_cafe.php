<?php
session_start();

$conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$is_login = false;
if ($is_login) {
    $is_login = true;
    setcookie('username', $username, time() + 3600, '/');
    session_start();
    $_SESSION['username'] = $username;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼에서 제출된 데이터 가져오기
    $cafeName = $_POST["cafeName"];
    $cafeAddress = $_POST["cafeAddress"];
    $cafeLatitude = $_POST["cafeLatitude"];
    $cafeLongitude = $_POST["cafeLongitude"];

    // SQL 쿼리 작성하여 데이터베이스에 카페 정보 삽입
    $sql = "INSERT INTO cafes (name, address, latitude, longitude) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // 바인딩 및 실행
    mysqli_stmt_bind_param($stmt, "ssdd", $cafeName, $cafeAddress, $cafeLatitude, $cafeLongitude);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo '<script>alert("카페가 성공적으로 등록되었습니다.");</script>';
    } else {
        echo '<script>alert("카페 등록 중 오류가 발생했습니다.");</script>';
    }
}

// 이 파일 내에 나머지 HTML 코드와 스크립트를 포함합니다.

?>
<!DOCTYPE html>
<html>
<head>
    <title>카페 등록</title>
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
    <style>
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
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
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
            display: inline-block.
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

        body {
            background-color: #8fbc8f;
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        }
        h1 {
        text-align: center; /* 텍스트를 가운데 정렬 */
        position: fixed;
        top: 40%; /* 화면 상단에서 절반 위치로 이동 */
        left: 50%; /* 화면 왼쪽에서 절반 위치로 이동 */
        transform: translate(-50%, -50%); /* 중앙 정렬을 위한 변환 */
        margin: 0; /* h1 요소 주변의 외부 여백을 제거 */
        padding: 0; /* h1 요소 주변의 내부 여백을 제거 */
        }

        button{
        position: fixed;
        top: 60%; /* 화면 상단에서 절반 위치로 이동 */
        left: 50%; /* 화면 왼쪽에서 절반 위치로 이동 */
        transform: translate(-50%, 0); /* 가로 방향으로만 중앙 정렬 */
        width: 200px;
        height: 80px;
        border-radius:5%;
        border: 2px solid #ddd;
        font-weight: bold;
        font-size: 20px;
        }
        button:hover {
            background-color: lightgray;
        }
        /* 스타일링을 위한 CSS */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        #registerCafeBtn {
            cursor: pointer;
        }

        #closeModal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        #closeModal:hover {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 50%;
            padding: 6px;
            margin: 4px 0;
            display: block;
            margin: 0 auto;
            text-align: center;
        }

        input[type="submit"] {
            background-color: lightgray;
            align-items: center;
            text-align: center;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left:45%;
        }

        input[type="submit"]:hover {
            background-color: red;
        }

    </style>
<body>
    <!-- top bar -->
    <div class="top">
        <a href="main.php" style="float: left; text-decoration: none;">
            <strong>&laquo; GANDE HOME</strong>
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
    <h1>Registeration Form</h1>

    <!-- 카페 등록 버튼 -->
    <button id="registerCafeBtn">New</button>

    <!-- 카페 등록 팝업 모달 -->
    <div id="registerCafeModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" style="float: right; cursor: pointer;">&times;</span>
            <h2>새로운 카페 등록</h2>
            <form id="cafeForm" action="" method="post">
                <input type="text" id="cafeName" name="cafeName" required placeholder="카페 이름"><br>
                <input type="text" id="cafeAddress" name="cafeAddress" required placeholder="주소"><br>
                <input type="text" id="cafeLatitude" name="cafeLatitude" required placeholder="위도"><br>
                <input type="text" id="cafeLongitude" name="cafeLongitude" required placeholder="경도"><br>
                <input type="submit" value="등록" id="registerButton">
            </form>
        </div>
    </div>

    <script>
        // 모달 열기 버튼 클릭 시
        document.getElementById("registerCafeBtn").onclick = function () {
            document.getElementById("registerCafeModal").style.display = "block";
        }

        // 모달 닫기 버튼 클릭 시
        document.getElementById("closeModal").onclick = function () {
            document.getElementById("registerCafeModal").style.display = "none";
        }
        // 모달 외부 클릭 시 모달 닫기
        window.onclick = function (event) {
            if (event.target == document.getElementById("registerCafeModal")) {
                document.getElementById("registerCafeModal").style.display = "none";
            }
        }
    </script>
</body>
</html>