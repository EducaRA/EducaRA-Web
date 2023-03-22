const express = require("express");

const app = express();

app.get("/", (req, res) => {
  res.send("Alive!!!");
});

app.get("/objetos", (req, res) => {
  res.send("Objetos!!!");
});

app.get("/disciplinas", (req, res) => {
  res.send("disciplinas!!!");
});

app.get("/aulas", (req, res) => {
  res.send("aulas!!!");
});

app.listen(3000);