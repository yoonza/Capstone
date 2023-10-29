<?php
session_start();

// 데이터베이스 연결 설정
$conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // 사용자의 예약 정보를 데이터베이스에서 가져오는 쿼리
    $sql = "SELECT * FROM reservation WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // 예약 정보가 존재하는 경우
        echo "<h1>예약 목록</h1>";
        echo "<table>";
        echo "<tr><th>예약 번호</th><th>카페 이름</th><th>예약 시간</th><th>예약 날짜</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['reservation_id'] . "</td>";
            echo "<td>" . $row['cafe_name'] . "</td>";
            echo "<td>" . $row['reserved_time'] . "</td>";
            echo "<td>" . $row['reservation_date'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // 예약 정보가 없는 경우
        echo "<h1>예약 정보가 없습니다.</h1>";
    }
} else {
    // 로그인 되어 있지 않은 경우
    echo "<h1>로그인 후 이용해주세요.</h1>";
}

?>
