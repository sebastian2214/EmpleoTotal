const express = require("express");
const db = require("../config/database"); 

const router = express.Router();

// 📌 🔥 PRIMERO la ruta que obtiene un solo empleo por ID
router.get("/:id", (req, res) => {
  const { id } = req.params;

  db.query("SELECT * FROM oferta_empleo WHERE id_oferta_empleo = ?", [id], (err, result) => {
    if (err) {
      console.error("❌ Error al obtener el empleo:", err.message);
      return res.status(500).json({ error: "Error al obtener el empleo" });
    }
    if (result.length === 0) {
      return res.status(404).json({ error: "Empleo no encontrado" });
    }
    res.json(result[0]); // 📌 Enviamos solo el primer resultado
  });
});

router.get("/", (req, res) => {
    db.query(
      "SELECT id_oferta_empleo, titulo_emp, descripcion, requisitos, ubicacion, salario, CONCAT('http://192.168.101.1:5000/', oferta_empleocol) AS oferta_empleocol FROM oferta_empleo",
      (err, result) => {
        if (err) {
          console.error("❌ Error al obtener empleos:", err.message);
          return res.status(500).json({ error: "Error al obtener los empleos" });
        }
        res.json(result);
      }
    );
  });
  
  
module.exports = router;
