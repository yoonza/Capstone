const express = require("express");
const mongoose = require("mongoose"); // 데이터베이스 연결
require('dotenv').config(); // env 사용을 위함.
const cors = require("cors");
const app = express();
app.use(cors());

mongoose.connect(process.env.DB, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
}).then(()=>console.log("connected to database"));

module.exports = app;