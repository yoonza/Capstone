<!DOCTYPE html>
<html>
<head>
    <title>원하는 카페를 검색하세요!</title>
    <link rel="stylesheet" type="text/css" href="cafelist.css">
    <style>
        /* 가운데 정렬을 위한 CSS 스타일 */
        body {
            text-align: center; /* body 요소 내의 모든 내용을 가운데 정렬합니다. */
        }

        h1 {
            text-align: center; /* h1 요소의 텍스트를 가운데 정렬합니다. */
        }

        form {
            text-align: center; /* form 요소 내의 모든 내용을 가운데 정렬합니다. */
        }

        ul {
            list-style: none; /* ul 요소의 리스트 마커를 제거합니다. */
            padding: 0; /* ul 요소의 패딩을 제거합니다. */
        }

        li {
            text-align: center; /* li 요소 내용을 가운데 정렬합니다. */
            font-weight: bold; /* 글꼴 굵기를 설정하여 텍스트를 굵게 표시합니다. */
            padding: 10px; /* 각 항목의 내부 여백을 설정합니다. */
            border: 1px solid #669966; /* 항목의 테두리를 설정합니다. */
            border-radius: 10px; /* 항목의 모서리를 둥글게 설정합니다. */
            margin: 10px; /* 항목 간의 간격을 설정합니다. */
            transition: transform 0.3s; /* hover 시 애니메이션 효과를 위한 속성 추가 */
            background-color: #99CC99; /* 배경색을 설정합니다. */
            color:white;
        }

        /* hover 상태일 때의 스타일 변경 */
        li:hover {
            transform: scale(1.05); /* hover 시 확대 애니메이션 효과 */
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2); /* 그림자 효과 추가 */
        }

        /* 카드 내부 텍스트 스타일 */
        .card p {
            font-size: 14px; /* 원하는 글자 크기로 설정 */
            color: white; /* 글씨 색상을 하얀색으로 설정합니다. */
            font-weight: bold; /* 글꼴 굵기를 설정하여 텍스트를 굵게 표시합니다. */
        }
    </style>
</head>
<body>
    <h1>SEARCH YOUR CAFE</h1>
    
    <form method="post" action="">
        <input type="text" id="search" name="search"><br>
        <input type="submit" value="검색">
    </form>
    
    <ul>
        <?php
        $message = ""; // 초기 메시지 변수를 설정합니다.
        $found = false; // 검색 결과 여부를 저장하는 변수를 초기화합니다.

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];
            $files = array(
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
            );

            foreach ($files as $file) {
                if (!empty($search)) { // $search가 비어 있지 않은 경우에만 데이터 출력
                    if (($handle = fopen($file, "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            if (count($data) > 3) {
                                $name = $data[0];
                                $address = $data[1];
                                $latitude = $data[2];
                                $longitude = $data[3];

                                if (stripos($name, $search) !== false) {
                                    // 각 데이터를 리스트 항목으로 출력
                                    echo "<li>";
                                    echo "<h3>$name</h3>";
                                    echo "<p>도로명주소: $address</p>";
                                    echo "<p>위도: $latitude</p>";
                                    echo "<p>경도: $longitude</p>";
                                    echo "</li>";

                                    $found = true; // 검색 결과를 찾았음을 표시합니다.
                                }
                            } else {
                                $message = "잘못된 데이터 형식입니다."; // 데이터 형식 오류 메시지
                            }
                        }
                        fclose($handle);
                    } else {
                        $message = "파일을 열 수 없습니다."; // 파일 열기 오류 메시지
                    }
                } else {
                    $message = "검색어를 입력하세요."; // 검색어 입력 안한 경우 메시지
                }
            }
        }

        if (!$found) {
            if (!empty($message)) {
                echo "<li>$message</li>";
            } else {
                echo "<li><strong>검색하신 카페가 없습니다.</strong></li>"; // strong은 글씨가 굵게
            }
        }
        ?>
    </ul>
</body>
</html>
