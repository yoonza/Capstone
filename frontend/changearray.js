const fs = require('fs');


// CSV 파일을 읽어서 데이터를 객체 배열로 변환하는 함수
function readCSVFile(filePath) {
  const fileData = fs.readFileSync(filePath, 'utf8');
  const lines = fileData.trim().split('\n');
  const header = lines[0].split(',');

  const data = [];

  for (let i = 1; i < lines.length; i++) {
    const line = lines[i].split(',');
    const entry = {
      title: line[0].trim(),
      lat: Number(line[1]),
      long: Number(line[2])
    };

    data.push(entry);
  }

  return data;
}

// CSV 파일 경로
const csvFilePath = '/Users/yoonza/Desktop/Capstone/frontend/전국스타벅스.csv';

// CSV 파일을 읽고 데이터를 객체 배열로 변환
const starbucksLocations = readCSVFile(csvFilePath);

for (const location of starbucksLocations) {
  console.log(`{
        title: '${location.title}',
        lat: ${location.lat},
        long: ${location.long}
    }`);
}
