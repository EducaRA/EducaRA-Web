import disciplinas from "./disciplinas.json" assert {type: 'json'};
import aulas from "./aulas.json" assert {type: 'json'};
import objetos from "./objetos.json" assert {type: 'json'};

import express from "express";

const app = express();


app.get("/", (req, res) => {
  res.send("Alive!!!");
});

app.get("/disciplinas", (req, res) => {
  res.send(disciplinas);
});

app.get("/aulas", (req, res) => {
  res.send(aulas);
});

app.get("/objetos", (req, res) => {
  res.send(objetos);
});

app.listen(3000);