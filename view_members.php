<?php
// MySQL 데이터베이스에 연결
$servername = "localhost";
$hostname = "root";
$password = "Forestz01!!";
$dbname = "gande_member";

$conn = mysqli_connect($servername, $hostname, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// MySQL에서 데이터 선택
$sql = "SELECT * FROM members";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<h1>회원 목록</h1>";
    echo "<table border='1'>";
    echo "<tr><th>이름</th><th>전화번호</th><th>아이디</th><th>이메일</th><th>회원 유형</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['roles'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "저장된 회원 정보가 없습니다.";
}

mysqli_close($conn);
?>
