const mysql = require("mysql2");

const db = mysql.createConnection({
  host: process.env.DB_HOST || "localhost",
  user: process.env.DB_USER || "root",
  password: process.env.DB_PASSWORD || "",
  database: process.env.DB_NAME || "empleototal",
});

db.connect((err) => {
  if (err) {
    console.error("❌ Error conectando a MySQL:", err.message);
    return;
  }
  console.log("🔥 Conectado a la BD de XAMPP:", process.env.DB_NAME || "empleototal");
});

module.exports = db;
