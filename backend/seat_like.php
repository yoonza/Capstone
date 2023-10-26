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

// 클릭 횟수가 가장 높은 좌석 번호 조회
$sql = "SELECT seat_number FROM seat_clicks ORDER BY clicks DESC LIMIT 1";

// 데이터베이스 쿼리 실행
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $recommendedSeat = $row['seat_number'];

  // 추천 좌석 번호를 클라이언트로 반환
  echo $recommendedSeat;
} else {
  // 추천 좌석을 찾을 수 없는 경우에 대한 처리 (예: 기본값 설정)
  echo "No recommendations available.";
}

// MySQL 데이터베이스 연결 닫기
mysqli_close($conn);
?>
