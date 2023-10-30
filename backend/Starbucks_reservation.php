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

  // 예약된 좌석 번호 정보를 저장
if (isset($_POST['selectedSeats']) && !empty($_POST['selectedSeats'])) {
  $selectedSeats = $_POST['selectedSeats'];
  $_SESSION['selectedSeats'] = $selectedSeats;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Starbucks_seat.css" />
    <title>Cafe Seat Booking</title>
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="top">
      <a href="main.php">
        <strong>&laquo; GANDE HOME </strong>
      </a>
      <span class="right">
        <?php
          if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
            if (isset($_SESSION['username'])) {
              $username = $_SESSION['username'];
              $sql = "SELECT name FROM members WHERE username = '{$username}'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $name = $row['name'];
              echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
              function redirect($url) {
                header('Location: contact.php'.$url);
                exit();
              }
            } else {
              $username = $_COOKIE['username'];
              $sql = "SELECT name FROM members WHERE username = '{$username}'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $name = $row['name'];
              echo "<a href='mypage.php'><strong>{$name}님 환영합니다!</strong></a>";
            }
            echo '<a href="logout.php"><strong>로그아웃</strong></a>';
          } else {
            echo '<a href="login.php"><strong>로그인</strong></a>';
          }
          echo '<a href="contact.php"><strong>고객센터</strong></a>';
        ?>
      </span>
    </div>
    <div class="movie-container">
      <label for="movie">Pick a seat: </label>
      <select id="movie">
        <option value>Starbucks</option>
      </select>
    </div>

    <div class="container">
      <div class="screen"></div>
<div class="showcase">
  <li>
    <div class="seat"></div>
    <small>N/A</small>
  </li>
  <li>
    <div class="seat selected"></div>
    <small>Selected</small>
  </li>
  <li>
    <div class="seat occupied"></div>
    <small>Occupied</small>
  </li>
  <li>
    <div class="table"></div>
    <small>N/A</small>
  </li>
  <li>
    <div class="table selected"></div>
    <small>Selected</small>
  </li>
  <li>
    <div class="table occupied"></div>
    <small>Occupied</small>
  </li>
</div>
      <div class="row">
        <div class="set">
          <div class="seat">1</div>
          <div class="table"></div>
          <div class="seat">2</div>
        </div>
        <div class="col">
          <div class="set">
            <div class="seat">3</div>
            <div class="table"></div>
            <div class="seat">4</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="set">
          <div class="seat">5</div>
          <div class="table"></div>
          <div class="seat">6</div>
        </div>
        <div class="set">
          <div class="seat">7</div>
          <div class="table"></div>
          <div class="seat">8</div>
        </div>
        <div class="set">
          <div class="seat">9</div>
          <div class="table"></div>
          <div class="seat">10</div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="set">
            <div class="seat">11</div>
            <div class="table"></div>
            <div class="seat">12</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="set">
          <div class="seat">13</div>
          <div class="table"></div>
          <div class="seat">14</div>
        </div>
        <div class="set">
          <div class="seat">19</div>
          <div class="table"></div>
          <div class="seat">20</div>
        </div>
        <div class="set">
          <div class="seat">25</div>
          <div class="table"></div>
          <div class="seat">26</div>
        </div>
      </div>
      <!-- 더 많은 좌석 추가 -->
      <div class="row">
        <div class="set">
          <div class="seat">15</div>
          <div class="table"></div>
          <div class="seat">16</div>
        </div>
        <div class="set">
          <div class="seat">21</div>
          <div class="table"></div>
          <div class="seat">22</div>
        </div>
      </div>
      <!-- 더 많은 좌석 추가 -->
      <div class="row">
        <div class="set">
          <div class="seat">17</div>
          <div class="table"></div>
          <div class="seat">18</div>
        </div>
              <!-- 더 많은 좌석 추가 -->
      <div class="row">
        <div class="set">
          <div class="seat">23</div>
          <div class="table"></div>
          <div class="seat">24</div>
        </div>
        <div class="set">
          <div class="seat">27</div>
          <div class="table"></div>
          <div class="seat">28</div>
        </div>
      </div>
      <!-- 더 많은 좌석 추가 -->
    </div>
    <p><span id="count">0</span> seats and <span id="tableCount">0</span> tables. Selected Seats: <span id="selectedSeatNumbers"></span></p>
    <p class="text">
      Total <span id="totalCount">0</span> Seats and already reserved <span id="reservedSeats">0</span> Seats
    </p>
    <input type="hidden" id="selectedSeatNumbers" name="selectedSeatNumbers" value="">

    <a href="realtime.php" class="rm-button-open" id="reserveButton">Select Time -></a>
    <script src="seat.js"></script>
    <script>
    document.getElementById('reserveButton').addEventListener('click', function() {
        var selectedSeats = getSelectedSeats();
        var selectedSeatsString = selectedSeats.join(',');
        document.getElementById('selectedSeatNumbers').value = selectedSeatsString;
    });

    function getSelectedSeats() {
        var selectedSeats = document.querySelectorAll('.seat.selected');
        var seatNumbers = [];
        selectedSeats.forEach(function(seat) {
            seatNumbers.push(seat.textContent);
        });
        return seatNumbers;
    }
</script>
  </body>
</html>