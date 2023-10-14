<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact page</title>
    <link rel="stylesheet" href="view_contact.css" />
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="top">
        <!-- 상단 내용 -->
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
</body>
</html>
