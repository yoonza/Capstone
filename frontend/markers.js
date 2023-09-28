// 마커를 표시할 위치와 title 객체 배열입니다 
const places = [
    {
        title: '그라찌에 순천향대피닉스광장점', 
        latlng: new kakao.maps.LatLng(36.771306, 126.931333)
    },
    {
        title: '그라찌에 순천향대향설2관점', 
        latlng: new kakao.maps.LatLng(36.767919, 126.933554)
    },
    {
        title: '그라찌에 순천향대향설1관점', 
        latlng: new kakao.maps.LatLng(36.768500, 126.932228)
    },
    {
        title: '고고쓰 순천향대점', 
        latlng: new kakao.maps.LatLng(36.7737209, 126.932562)
    },
    {
        title: '카페 에이루트', 
        latlng: new kakao.maps.LatLng(36.7734328, 126.932988)
    },
    {
        title: '대단한탕후루 순천향대점카페', 
        latlng: new kakao.maps.LatLng(36.7750554, 126.934062)
    },
    {
        title: '베이커리경',
        latlng: new kakao.maps.LatLng(36.7747488, 126.933670)
    },
    {
        title: '카페별',
        latlng: new kakao.maps.LatLng(36.7730993, 126.932786)
    },
    {
        title: '파리바게뜨 아산순천향대점',
        latlng: new kakao.maps.LatLng(36.7739109, 126.9338895)
    },
    {
        title: '컴포즈커피 아산순천향대점',
        latlng: new kakao.maps.LatLng(36.7737032, 126.932976)
    },
    {
        title: '메가MGC커피 순천향대점',
        latlng: new kakao.maps.LatLng(36.7735771, 126.933167)
    },
    {
        title: '유캔두잇 아산순천향대점',
        latlng: new kakao.maps.LatLng(36.7770113, 126.934945)
    },
    {
        title: '빽다방 아산순천향대학교점',
        latlng: new kakao.maps.LatLng(36.7733614, 126.934142)
    },
    {
        title: '쥬씨 순천향대점',
        latlng: new kakao.maps.LatLng(36.7731181, 126.934198)
    },
    {
        title: '공차 아산순천향대점',
        latlng: new kakao.maps.LatLng(36.7730993, 126.932786)
    },
    {
        title: 'The대단한커피 순천향대점',
        latlng: new kakao.maps.LatLng(36.7750554,126.934062)
    },
    {
        title: '우주라이크커피 아산순천향대점',
        latlng: new kakao.maps.LatLng(36.7770113, 126.934945)
    },
    {
        title: '카페 15th Avenue',
        latlng: new kakao.maps.LatLng(36.7741540, 126.933469)
    },
    {
        title: '필나인',
        latlng: new kakao.maps.LatLng(36.7699724,126.980594)
    },
    {
        title: '웜사이트 온양',
        latlng: new kakao.maps.LatLng(36.7616881, 126.967347)
    },
    {
        title: '카페 안낙',
        latlng: new kakao.maps.LatLng(36.7639157, 126.974559)
    },
    {
        title: '논사이하우스',
        latlng: new kakao.maps.LatLng(36.7579042, 126.970171)
    },
    {
        title: '우즈베이커리카페',
        latlng: new kakao.maps.LatLng(36.7689088, 126.979026)
    },
    {
        title: '그린브리즈',
        latlng: new kakao.maps.LatLng(36.7598786, 126.9740456)
    },
    {
        title: '오브',
        latlng: new kakao.maps.LatLng(36.7752980, 126.980682)
    },
    {
        title: '컨스턴트 베이커리카페',
        latlng: new kakao.maps.LatLng(36.7761449, 126.980156)
    },
    {
        title: '신정노을',
        latlng: new kakao.maps.LatLng(36.7691801, 126.984862)
    },
    {
        title: '좋은아침페스츄리 신정호수점',
        latlng: new kakao.maps.LatLng(36.7620952, 126.973608)
    },
    {
        title: '카페브리드',
        latlng: new kakao.maps.LatLng(36.7633569, 126.973988)
    },
    {
        title: 'LLAF COFFEE',
        latlng: new kakao.maps.LatLng(36.7750457, 126.981119)
    },
    {
        title: '아마르 라운지',
        latlng: new kakao.maps.LatLng(36.7616881, 126.967347)
    },
    {
        title: '엔제리너스 신정호수점',
        latlng: new kakao.maps.LatLng(36.7744600, 126.980962)
    },
    {
        title: '그래비티 신정호수점',
        latlng: new kakao.maps.LatLng(36.7741717, 126.981388)
    },
    {
        title: '카페 블랙쿠바프리덤',
        latlng: new kakao.maps.LatLng(36.7760284, 126.983987)
    },
    {
        title: '신정호하루',
        latlng: new kakao.maps.LatLng(36.7644823, 126.969989)
    },
    {
        title: '봉봉',
        latlng: new kakao.maps.LatLng(36.7544357, 126.973409)
    },
    {
        title: '셀렉토커피 아산신정호점',
        latlng: new kakao.maps.LatLng(36.7760457, 126.979461)
    },
    {
        title: '루트 102',
        latlng: new kakao.maps.LatLng(36.7595724, 126.974762)
    },
    {
        title: '카페룩스',
        latlng: new kakao.maps.LatLng(36.7627519, 126.968892)
    },
    {
        title: '레이크온',
        latlng: new kakao.maps.LatLng(36.7619316, 126.968109)
    },  
    {
        title: '리에또',
        latlng: new kakao.maps.LatLng(36.7677983, 126.969596)
    },
    {
        title: '마리올라',
        latlng: new kakao.maps.LatLng(36.7666271, 126.970671)
    },
    {
        title: '카페 데이즐',
        latlng: new kakao.maps.LatLng(36.7670866, 126.970559)
    }, 
    {
        title: '민들레카페',
        latlng: new kakao.maps.LatLng(36.7618791, 126.974201)
    },
    {
        title: '보스턴빵작가',
        latlng: new kakao.maps.LatLng(36.7615636, 126.973597)
    },
    {
        title: '곤트란쉐리에 천안아산점',
        latlng: new kakao.maps.LatLng(36.7595724, 126.974762)
    },
    {
        title: '파스쿠찌 아산신정호점',
        latlng: new kakao.maps.LatLng(36.7612915, 126.966866)
    },
    {
        title: '일랑일랑',
        latlng: new kakao.maps.LatLng(36.7621208, 126.968030)
    },
    {
        title: '카페짙은',
        latlng: new kakao.maps.LatLng(36.7617050, 126.963472)
    },
    {
        title: '커피홀베이커리 신정호점',
        latlng: new kakao.maps.LatLng(36.7577784, 126.971571)
    },
    {
        title: '행복들',
        latlng: new kakao.maps.LatLng(36.7573634, 126.969757)
    },
    {
        title: '행복한찹쌀꽈배기 신정호기산점',
        latlng: new kakao.maps.LatLng(36.7573634, 126.969757)
    },
    {
        title: '문카페',
        latlng: new kakao.maps.LatLng(36.7585256, 126.968625)
    },
    {
        title: '윌카페',
        latlng: new kakao.maps.LatLng(36.7760457, 126.979461)
    },
    {
        title: '카페모들',
        latlng: new kakao.maps.LatLng(36.7704500, 126.980717)
    }
    


];

// 마커 이미지의 이미지 주소입니다
const imageSrc = "/Users/yoonza/Desktop/Capstone/frontend/icons8-location-64.png"; 

const imageSize = new kakao.maps.Size(30, 35); 