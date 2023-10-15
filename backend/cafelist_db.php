<?php
$servername = "localhost";
$username = "root";
$password = "Forestz01!!";
$database = "cafe_list";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

$csvFiles = [
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
];

foreach ($csvFiles as $csvFile) {
    if (($handle = fopen($csvFile, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            if (count($data) === 4) {
                $name = $conn->real_escape_string($data[0]);
                $address = $conn->real_escape_string($data[1]);
                $latitude = $conn->real_escape_string($data[2]);
                $longitude = $conn->real_escape_string($data[3]);

                $insertQuery = "INSERT INTO cafes (name, address, latitude, longitude) VALUES ('$name', '$address', '$latitude', '$longitude')";
                if ($conn->query($insertQuery) !== true) {
                    echo "오류: " . $conn->error;
                }
            } else {
                echo "잘못된 데이터 형식입니다.";
            }
        }
        fclose($handle);
    } else {
        echo "파일을 열 수 없습니다.";
    }
}

$conn->close();
?>


<?php
$servername = "localhost";
$username = "root";
$password = "Forestz01!!";
$database = "cafe_list";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

$csvFiles = [
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
];

if (($handle = fopen($csvFile, "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        if (count($data) === 4) {
            $name = $conn->real_escape_string($data[0]);
            $address = $conn->real_escape_string($data[1]);
            $latitude = $conn->real_escape_string($data[2]);
            $longitude = $conn->real_escape_string($data[3]);

            $insertQuery = "INSERT INTO cafes (name, address, latitude, longitude) VALUES ('$name', '$address', '$latitude', '$longitude')";
            if ($conn->query($insertQuery) !== true) {
                echo "오류: " . $conn->error;
            }
        } else {
            echo "잘못된 데이터 형식입니다.";
        }
    }
    fclose($handle);
} else {
    echo "파일을 열 수 없습니다.";
}

$conn->close();
?>
