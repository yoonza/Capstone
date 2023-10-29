<?php
session_start();

$conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL 쿼리 실행
$sql = "SELECT * FROM cafes";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h1>카페 정보 확인</h1>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>카페 이름: " . $row['name'] . "</h2>";
        echo "<p>주소: " . $row['address'] . "</p>";
        echo "<p>위도: " . $row['latitude'] . "</p>";
        echo "<p>경도: " . $row['longitude'] . "</p>";
        echo "<hr>"; // 각 카페 정보 구분을 위한 가로선
    }
} else {
    echo "카페 정보를 가져오는 데 실패했습니다: " . mysqli_error($conn);
}

// 데이터베이스 연결 닫기
mysqli_close($conn);
?>
