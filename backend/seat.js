const movieSelect = document.getElementById('movie');
const container = document.querySelector('.container');
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const tables = document.querySelectorAll('.row .table:not(.occupied)'); // 테이블 선택
const count = document.getElementById('count');
const tableCount = document.getElementById('tableCount'); // 추가된 테이블 개수 표시
const totalCount = document.querySelectorAll('.row .seat').length;
const reservedSeats = calculateReservedSeats(); // ReservedSeats 계산 함수

let ticketPrice = +movieSelect.value;
let selectedSetCount = 0; // 선택된 set 개수를 추적

// totalCount를 HTML에 표시
const totalCountElement = document.getElementById('totalCount'); // HTML에서 해당 표시할 요소의 id를 지정해야 합니다.
totalCountElement.textContent = totalCount; // totalCount 값을 할당하여 HTML에 표시

populateUI();

function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    selectedSeats.forEach((seatIndex) => {
      if (seatIndex < seats.length) {
        seats[seatIndex].classList.add('selected');
      } else if (seatIndex < seats.length + tables.length) {
        const tableIndex = seatIndex - seats.length;
        tables[tableIndex].classList.add('selected');
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }
}

function setMovieData(movieIndex, moviePrice) {
  localStorage.setItem('selectedMovieIndex', movieIndex);
  localStorage.setItem('selectedMoviePrice', moviePrice);
}

function updateSelectedCount() {
    const selectedSeats = document.querySelectorAll('.row .seat.selected');
    const selectedTables = document.querySelectorAll('.row .table.selected');
    const selectedSeatCount = selectedSeats.length;
    const selectedTableCount = selectedTables.length;
  
    count.textContent = selectedSeatCount;
    tableCount.textContent = selectedTableCount;
  
    if (selectedSeatCount + selectedTableCount >= 5 || selectedTableCount >= 3) {
      alert('5개 이상의 좌석 또는 3개 이상의 set를 선택할 수 없습니다.');
      // 선택한 좌석 중 가장 나중에 선택한 좌석 또는 테이블을 자동으로 취소합니다.
      const lastSelected = selectedSeatCount + selectedTableCount >= 5 ? selectedSeats[selectedSeats.length - 1] : selectedTables[selectedTables.length - 1];
      lastSelected.classList.remove('selected');
    }
}

movieSelect.addEventListener('change', (event) => {
  ticketPrice = +event.target.value;

  setMovieData(event.target.selectedIndex, event.target.value);
  updateSelectedCount();
});

container.addEventListener('click', (event) => {
    if (event.target.classList.contains('seat') && !event.target.classList.contains('occupied')) {
      // 좌석을 클릭한 경우
      const selectedSeats = document.querySelectorAll('.row .seat.selected');
      if (selectedSetCount <= 2) {
        if (selectedSeats.length < 5 || event.target.classList.contains('selected')) {
          // 이미 선택된 좌석을 다시 클릭하면 취소
          event.target.classList.toggle('selected');
          updateSelectedCount();
        } else {
          alert('5개 이상의 좌석을 선택할 수 없습니다.');
        }
      } else {
        alert('3개 이상의 set를 선택할 수 없습니다.');
      }
    } else if (event.target.classList.contains('table')) {
      // 테이블을 클릭한 경우
      const set = event.target.closest('.set');
  
      if (set) {
        const seatsInSet = set.querySelectorAll('.seat:not(.occupied)');
        const tablesInSet = set.querySelectorAll('.table:not(.occupied)');
        const selectedSeats = document.querySelectorAll('.row .seat.selected');
        const selectedTables = document.querySelectorAll('.row .table.selected');
  
        if (selectedTables.length <= 2) {
          if (selectedSetCount <= 2) {
            // 선택된 set가 2개 이하인 경우
            seatsInSet.forEach((seat) => {
              seat.classList.toggle('selected');
            });
  
            tablesInSet.forEach((table) => {
              table.classList.toggle('selected');
            });
  
            selectedSetCount++;
            updateSelectedCount();
          } else {
            alert('3개 이상의 set를 선택할 수 없습니다.');
            // 선택한 set 전체를 취소합니다.
            seatsInSet.forEach((seat) => {
                if (seat.classList.remove('selected')) {
                  seat.classList.contains('selected');
                }
              });
            
              tablesInSet.forEach((table) => {
                if (table.classList.remove('selected')) {
                  table.classList.contains('selected');
                }
              });
            
              updateSelectedCount();
            }
        } else {
          alert('1인당 최대 예약 가능 테이블 수는 2개까지 입니다.');

          // 선택된 좌석 및 테이블 취소 코드 추가
            selectedSeats.forEach((seat) => {
                seat.classList.remove('selected');
            });

            selectedTables.forEach((table) => {
                table.classList.remove('selected');
            });

            // 선택된 set 개수 감소
            selectedSetCount--;

            // 업데이트 함수 호출
            updateSelectedCount();
        }
      }
    }
});  
  
function updateSelectedCount() {
    const selectedSeats = document.querySelectorAll('.row .seat.selected');
    const selectedTables = document.querySelectorAll('.row .table.selected');
    const selectedSeatCount = selectedSeats.length;
    const selectedTableCount = selectedTables.length;
  
    // 여기서 selectedSetCount 업데이트
    selectedSetCount = document.querySelectorAll('.set .seat.selected').length > 0 ? 1 : 0;
  
    count.textContent = selectedSeatCount;
    tableCount.textContent = selectedTableCount;
    
    if (selectedSeatCount + selectedTableCount >= 7 || selectedTableCount >= 3) {
        alert('1인당 최대 예약 가능 좌석 수는 2개까지 입니다.');
        // 선택한 좌석 중 가장 나중에 선택한 좌석 또는 테이블을 자동으로 취소합니다.
        const lastSelected = selectedSeatCount + selectedTableCount >= 7 ? selectedSeats[selectedSeats.length - 1] : selectedTables[selectedTables.length - 1];
        
        // 선택된 좌석 및 테이블 취소 코드 추가
        selectedSeats.forEach((seat) => {
            seat.classList.remove('selected');
        });

        selectedTables.forEach((table) => {
            table.classList.remove('selected');
        });

        // 선택된 set 개수 감소
        selectedSetCount--;

        // 업데이트 함수 호출
        updateSelectedCount();
    }
}

// 예약된 좌석 수 계산 함수 (occupied 클래스를 가진 요소 수)
function calculateReservedSeats() {
    const occupiedSeatElements = document.querySelectorAll('.seat.occupied');
    const reservedSeats = occupiedSeatElements.length;
    return reservedSeats;
}

// "Select Time" 버튼 클릭 이벤트 핸들러 추가
const selectTimeButton = document.querySelector('.rm-button-open');
selectTimeButton.addEventListener('click', (event) => {
    event.preventDefault(); // 기본 동작인 링크 이동을 막음

    // 선택된 좌석 수와 테이블 수 가져오기
    const selectedSeats = document.querySelectorAll('.row .seat.selected');
    const selectedTables = document.querySelectorAll('.row .table.selected');
    const selectedSeatCount = selectedSeats.length;
    const selectedTableCount = selectedTables.length;

    // 만약 좌석 또는 테이블을 하나도 선택하지 않은 경우
    if (selectedSeatCount === 0 && selectedTableCount === 0) {
        alert('좌석 또는 테이블을 선택해야 날짜 선택이 가능합니다.');
    } else {
        // 좌석 또는 테이블이 선택되었을 경우, "realtime.php"로 이동
        window.location.href = 'realtime.php';
    }
});
