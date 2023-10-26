<?php
// 데이터베이스 연결 설정
$servername = "localhost"; // MySQL 서버 주소
$username = "root";      // MySQL 사용자 이름
$password = "Forestz01!!";  // MySQL 사용자 비밀번호
$database = "seat"; // 사용할 데이터베이스 이름 ("seat"로 변경)

// MySQL 데이터베이스에 연결
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['seatNumber'])) {
    $seatNumber = $_POST['seatNumber'];

    // 데이터베이스에 좌석 클릭 정보 저장 (클릭 횟수 증가)
    $sql = "UPDATE seat_clicks SET clicks = clicks + 1 WHERE seat_number = '$seatNumber'";

    // 쿼리 실행
    if (mysqli_query($conn, $sql)) {
      // 클릭 정보 저장이 완료되었으면 아무것도 반환하지 않음
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}

// MySQL 데이터베이스 연결 닫기
mysqli_close($conn);
?>
