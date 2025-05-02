require("dotenv").config();
const express = require("express");
const cors = require("cors");
const morgan = require("morgan");
const mysql = require("mysql2");
const path = require("path");
const jwt = require("jsonwebtoken");
const bcrypt = require("bcryptjs");
const multer = require("multer");
const fs = require("fs");

const app = express();
const PORT = process.env.PORT || 5000;
const SECRET_KEY = "empleo_secret";

// Middleware
app.use(cors());
app.use(morgan("dev"));
app.use(express.json());

// Carpeta de uploads
const uploadsDir = path.join(__dirname, "uploads");
if (!fs.existsSync(uploadsDir)) {
  fs.mkdirSync(uploadsDir);
}
app.use("/uploads", express.static(uploadsDir));

// Multer config
const storage = multer.diskStorage({
  destination: (req, file, cb) => cb(null, uploadsDir),
  filename: (req, file, cb) => cb(null, `${Date.now()}-${file.originalname}`),
});
const upload = multer({ storage });

// BD
const db = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "empleototal",
});

db.getConnection((err, connection) => {
  if (err) console.error("❌ Error conectando a MySQL:", err.message);
  else {
    console.log("✅ Conectado a MySQL");
    connection.release();
  }
});

// 🔐 Login
app.post("/login", (req, res) => {
  const { usuario, contrasena } = req.body;
  if (!usuario || !contrasena) return res.status(400).json({ success: false, message: "Faltan datos" });

  const sql = "SELECT * FROM usuario WHERE usuario = ?";
  db.query(sql, [usuario], async (err, result) => {
    if (err) return res.status(500).json({ success: false, message: "Error en la BD" });
    if (result.length === 0) return res.status(401).json({ success: false, message: "Usuario no encontrado" });

    const user = result[0];
    const isMatch = await bcrypt.compare(contrasena, user.contrasena);
    if (!isMatch) return res.status(401).json({ success: false, message: "Contraseña incorrecta" });

    const token = jwt.sign(
      { id_usuario: user.id_usuario, rol_id_rol: user.rol_id_rol },
      SECRET_KEY,
      { expiresIn: "1d" }
    );
    res.status(200).json({ success: true, token, rol_id_rol: user.rol_id_rol });
  });
});

// 📥 Empleos
app.get("/empleos", (req, res) => {
  const sql = "SELECT * FROM oferta_empleo";
  db.query(sql, (err, result) => {
    if (err) return res.status(500).json({ success: false, message: "Error al obtener empleos" });
    const updated = result.map((emp) => ({
      ...emp,
      oferta_empleocol: emp.oferta_empleocol
        ? `http://192.168.101.12:5000/${emp.oferta_empleocol}`
        : null,
    }));
    res.json(updated);
  });
});

app.get("/empleos/:id", (req, res) => {
  const id = req.params.id;
  const sql = "SELECT * FROM oferta_empleo WHERE id_oferta_empleo = ?";
  db.query(sql, [id], (err, result) => {
    if (err || result.length === 0) return res.status(404).json({ success: false, message: "Empleo no encontrado" });
    const job = result[0];
    job.oferta_empleocol = job.oferta_empleocol
      ? `http://192.168.101.12:5000/${job.oferta_empleocol}`
      : null;
    res.json(job);
  });
});

// 📤 Subcategorías
app.get("/subcategorias", (req, res) => {
  const sql = "SELECT id_sub_cat, nombre_sub_cat FROM sub_cat";
  db.query(sql, (err, result) => {
    if (err) return res.status(500).json({ success: false });
    res.json(result);
  });
});

// 📋 Perfil de usuario
app.get("/perfil_usuario", (req, res) => {
  const authHeader = req.headers.authorization;
  if (!authHeader) return res.status(401).json({ success: false, message: "Token no proporcionado" });

  const token = authHeader.split(" ")[1];

  try {
    const decoded = jwt.verify(token, SECRET_KEY);
    const id_usuario = decoded.id_usuario;

    const sql = `
      SELECT 
        u.id_usuario, 
        u.usuario, 
        u.correo, 
        h.id_hojade_de_vida,
        h.nombre, h.apellido, h.descripcion_sobre_ti
      FROM usuario u
      LEFT JOIN hojade_de_vida h ON u.id_usuario = h.usuario_id_usuario
      WHERE u.id_usuario = ?
    `;

    db.query(sql, [id_usuario], (err, result) => {
      if (err) {
        console.error("❌ Error al obtener perfil:", err);
        return res.status(500).json({ success: false, message: "Error al obtener perfil" });
      }

      const user = result[0];
      if (!user) return res.status(404).json({ success: false, message: "Usuario no encontrado" });

      if (!user.id_hojade_de_vida) {
        user.estudios = [];
        return res.status(200).json(user);
      }

      const sqlEstudios = `SELECT * FROM estudios WHERE hojade_de_vida_id_hojade_de_vida = ?`;
      db.query(sqlEstudios, [user.id_hojade_de_vida], (err2, estudios) => {
        if (err2) {
          console.error("❌ Error al obtener estudios:", err2);
          return res.status(500).json({ success: false });
        }
        user.estudios = estudios || [];
        res.json(user);
      });
    });
  } catch (error) {
    return res.status(401).json({ success: false, message: "Token inválido" });
  }
});

// 📤 Publicar empleo
app.post("/publicar_empleo", upload.single("oferta_empleocol"), (req, res) => {
  const {
    titulo_emp, descripcion, requisitos, ubicacion, salario,
    telefono, correo, link_test, sub_cat_id_sub_cat
  } = req.body;

  const token = req.headers.authorization?.split(" ")[1];
  let usuario_id = null;

  try {
    const decoded = jwt.verify(token, SECRET_KEY);
    usuario_id = decoded.id_usuario;
  } catch (e) {
    return res.status(401).json({ success: false, message: "Token inválido" });
  }

  const empresaQuery = "SELECT id_empresa FROM empresas WHERE usuario_id_usuario = ?";
  db.query(empresaQuery, [usuario_id], (err, empresaResult) => {
    if (err || empresaResult.length === 0) {
      console.error("❌ Empresa no encontrada:", err);
      return res.status(500).json({ success: false, message: "Empresa no registrada" });
    }

    const empresas_id = empresaResult[0].id_empresa;
    const imagen = req.file ? `uploads/${req.file.filename}` : "uploads/default.png";

    const sql = `
      INSERT INTO oferta_empleo (
        titulo_emp, descripcion, requisitos, ubicacion, salario,
        oferta_empleocol, telefono, correo, link_test, sub_cat_id_sub_cat, empresas_id
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    `;

    db.query(sql, [
      titulo_emp, descripcion, requisitos, ubicacion, salario,
      imagen, telefono, correo, link_test, sub_cat_id_sub_cat, empresas_id
    ], (err2) => {
      if (err2) {
        console.error("❌ Error al guardar empleo:", err2);
        return res.status(500).json({ success: false, message: "Error al guardar empleo" });
      }

      res.json({ success: true, message: "Empleo publicado correctamente" });
    });
  });
});
app.post("/aplicar", async (req, res) => {
  const { id_oferta_empleo } = req.body;
  const token = req.headers.authorization?.split(" ")[1];

  if (!token) return res.status(401).json({ success: false, message: "No autenticado" });

  try {
    const decoded = jwt.verify(token, SECRET_KEY);
    const id_usuario = decoded.id_usuario;

    // 1️⃣ Obtener ID hoja de vida
    const hojaQuery = `SELECT id_hojade_de_vida FROM hojade_de_vida WHERE usuario_id_usuario = ?`;
    db.query(hojaQuery, [id_usuario], (err, hojaRes) => {
      if (err || hojaRes.length === 0) {
        return res.status(404).json({ success: false, message: "Hoja de vida no encontrada" });
      }

      const id_hojade_de_vida = hojaRes[0].id_hojade_de_vida;

      // 2️⃣ Verificar si ya aplicó
      const checkSql = `
        SELECT * FROM hojade_de_vida_has_oferta_empleo
        WHERE hojade_de_vida_id_hojade_de_vida = ? AND oferta_empleo_id_oferta_empleo = ?
      `;
      db.query(checkSql, [id_hojade_de_vida, id_oferta_empleo], (errCheck, rows) => {
        if (errCheck) {
          return res.status(500).json({ success: false, message: "Error al verificar aplicación" });
        }

        if (rows.length > 0) {
          return res.status(409).json({ success: false, message: "⚠️ Ya has aplicado a esta oferta" });
        }

        // 3️⃣ Obtener el título del empleo
        const tituloQuery = `SELECT titulo_emp FROM oferta_empleo WHERE id_oferta_empleo = ?`;
        db.query(tituloQuery, [id_oferta_empleo], (errTitle, titleRes) => {
          if (errTitle || titleRes.length === 0) {
            return res.status(404).json({ success: false, message: "Oferta no encontrada" });
          }

          const titulo = titleRes[0].titulo_emp;

          // 4️⃣ Insertar la aplicación
          const insertApp = `
            INSERT INTO hojade_de_vida_has_oferta_empleo 
            (hojade_de_vida_id_hojade_de_vida, oferta_empleo_id_oferta_empleo)
            VALUES (?, ?)
          `;
          db.query(insertApp, [id_hojade_de_vida, id_oferta_empleo], (errInsert) => {
            if (errInsert) {
              console.error("❌ Error al aplicar:", errInsert);
              return res.status(500).json({ success: false, message: "Error al aplicar" });
            }

            // 5️⃣ Insertar notificación con fecha y título
            const contenido = `✅ Has aplicado exitosamente a la oferta: ${titulo}`;
            const fecha_envio = new Date().toISOString().slice(0, 19).replace("T", " ");
            const notiQuery = `
              INSERT INTO notificaciones (contenido, fecha_envio, usuario_id_usuario)
              VALUES (?, ?, ?)
            `;

            db.query(notiQuery, [contenido, fecha_envio, id_usuario], (errNoti) => {
              if (errNoti) {
                console.error("❌ Error al guardar notificación:", errNoti);
                return res.status(500).json({ success: false, message: "Aplicado pero notificación falló" });
              }

              return res.json({ success: true, message: "Aplicación y notificación exitosas" });
            });
          });
        });
      });
    });
  } catch (e) {
    return res.status(401).json({ success: false, message: "Token inválido" });
  }
});

app.get("/notificaciones", (req, res) => {
  const authHeader = req.headers.authorization;
  if (!authHeader) return res.status(401).json({ success: false, message: "Token no proporcionado" });

  const token = authHeader.split(" ")[1];
  try {
    const decoded = jwt.verify(token, SECRET_KEY);
    const id_usuario = decoded.id_usuario;

    const sql = `
      SELECT n.idnotificaciones, n.contenido, n.fecha_envio
      FROM notificaciones n
      WHERE n.usuario_id_usuario = ?
      ORDER BY n.fecha_envio DESC
    `;

    db.query(sql, [id_usuario], (err, result) => {
      if (err) {
        console.error("❌ Error al obtener notificaciones:", err);
        return res.status(500).json({ success: false, message: "Error interno" });
      }

      res.json({ success: true, notificaciones: result });
    });
  } catch (error) {
    return res.status(401).json({ success: false, message: "Token inválido" });
  }
});


// ▶️ Iniciar servidor
app.listen(PORT, () => {
  console.log(`🚀 Servidor corriendo en http://localhost:${PORT}`);
});
