<!DOCTYPE html>
<html>
<head>
    <title>카페 등록</title>
    <style>
        h1 {
        text-align: center; /* 텍스트를 가운데 정렬 */
        position: fixed;
        top: 50%; /* 화면 상단에서 절반 위치로 이동 */
        left: 50%; /* 화면 왼쪽에서 절반 위치로 이동 */
        transform: translate(-50%, -50%); /* 중앙 정렬을 위한 변환 */
        margin: 0; /* h1 요소 주변의 외부 여백을 제거 */
        padding: 0; /* h1 요소 주변의 내부 여백을 제거 */
        }

        button{
        position: fixed;
        top: 60%; /* 화면 상단에서 절반 위치로 이동 */
        left: 50%; /* 화면 왼쪽에서 절반 위치로 이동 */
        transform: translate(-50%, 0); /* 가로 방향으로만 중앙 정렬 */
        }
        /* 스타일링을 위한 CSS */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        #registerCafeBtn {
            cursor: pointer;
        }

        #closeModal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        #closeModal:hover {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
<body>
    <h1>카페 등록하기</h1>

    <!-- 카페 등록 버튼 -->
    <button id="registerCafeBtn">새로운 카페 등록</button>

    <!-- 카페 등록 팝업 모달 -->
    <div id="registerCafeModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" style="float: right; cursor: pointer;">&times;</span>
            <h2>새로운 카페 등록</h2>
            <form id="cafeForm" action="register_cafe.php" method="post">
                <label for="cafeName">카페 이름:</label>
                <input type="text" id="cafeName" name="cafeName" required><br>

                <label for="cafeAddress">주소:</label>
                <input type="text" id="cafeAddress" name="cafeAddress" required><br>

                <label for="cafeLatitude">위도:</label>
                <input type="text" id="cafeLatitude" name="cafeLatitude" required><br>

                <label for="cafeLongitude">경도:</label>
                <input type="text" id="cafeLongitude" name="cafeLongitude" required><br>

                <input type="submit" value="등록">
            </form>
        </div>
    </div>

    <script>
        // 모달 열기 버튼 클릭 시
        document.getElementById("registerCafeBtn").onclick = function() {
            document.getElementById("registerCafeModal").style.display = "block";
        }

        // 모달 닫기 버튼 클릭 시
        document.getElementById("closeModal").onclick = function() {
            document.getElementById("registerCafeModal").style.display = "none";
        }

        // 모달 외부 클릭 시 모달 닫기
        window.onclick = function(event) {
            if (event.target == document.getElementById("registerCafeModal")) {
                document.getElementById("registerCafeModal").style.display = "none";
            }
        }
    </script>
</body>
</html>
