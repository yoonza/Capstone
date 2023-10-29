<?php
session_start();

// 데이터베이스 연결
$conn = mysqli_connect("localhost", "root", "Forestz01!!", "gande_member");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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

mysqli_close($conn);
?>
