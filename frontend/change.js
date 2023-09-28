const fs = require("fs");
const csv = require('csvtojson');
const { Parser } = require('json2csv');

(async () => {

    const cafes = await csv().fromFile("전국스타벅스.csv");

    console.log(cafes);

    const carsIncsv = 
    fs.writeFileSync("전국스타벅스.csv",)
})();