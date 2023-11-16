<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>자주 묻는 질문</title>
    <script src="http://kit.fontawesome.com/e1a4d00b81.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #8fbc8f;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .faq-item {
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 10px;
            cursor: pointer;
        }

        .question {
            font-weight: bold;
        }

        .answer {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>자주 묻는 질문</h1>
    </header>
    <div class="container">
        <div class="faq-item">
            <div class="question">Q1. GANDE는 무엇인가요?</div>
            <div class="answer">A1. 이 웹은 카페를 이용하는 고객들에게 더 나은 카페 정보를 제공하고 예약기능을 도입하고자 제작된 프로그램입니다.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q2. 좌석 예약은 당일 예약 외에는 불가한가요?</div>
            <div class="answer">A2. 원활한 예약시스템 운영과 카페의 회전율을 위하여 당일만을 예약 기간으로 제공하고 있습니다. 차후에 서비스가 개편될 예정입니다.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q3. 메인페이지에서 표시된 관리자 페이지는 접근할 수 없는 건가요?</div>
            <div class="answer">A3. 해당 서비스는 간디웹 관리자를 위하여 구현된 서비스로 고객 및 카페 사장님으르 대상으로 가입한 사용자는 이용할 수 없습니다.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q4. 예약된 정보는 어디서 확인할 수 있나요?</div>
            <div class="answer">A4. 예약 정보는 메인페이지 하단 바에 있는 예약 정보 확인 링크를 통해 확인할 수 있습니다.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q5. 카페를 등록하고 싶은데, 방법을 알 수 있을까요?</div>
            <div class="answer">A5. 새로운 카페를 등록하고자 할 경우, 메인페이지-CAFE 메뉴바 이동-카페 검색 창 아래 '내 카페 등록'을 활용하세요.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q6. 카페 좌석 예약 방법을 알려주세요.</div>
            <div class="answer">A6. 카페 예약 페이지에 접속하여 좌석을 선택하거나 테이블을 선택하면 해당 영역에 포함된 좌석이 선택됩니다. 이후, 예약 절차를 순서대로 이행하세요.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q7. 다른 문의사항에 대해서는 어떻게 질문할 수 있나요?</div>
            <div class="answer">A7. 메인페이지 상단의 고객센터 서비스를 이용하실 수 있습니다.</div>
        </div>

        <div class="faq-item">
            <div class="question">Q8. 카페 추천은 어떻게 받을 수 있나요?</div>
            <div class="answer">A8. 메뉴판 추천페이지를 새로고침할 때마다 카페가 임의적으로 변경됩니다.</div>
        </div>

        <!-- 추가적인 FAQ 아이템을 필요에 따라 복사해서 추가할 수 있습니다. -->

    </div>

    <script>
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const answer = item.querySelector('.answer');
            answer.style.display = 'block';
        });

        item.addEventListener('mouseleave', () => {
            const answer = item.querySelector('.answer');
            answer.style.display = 'none';
        });
    });
</script>

</body>
</html>
