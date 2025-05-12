<?php
require('fpdf.php');

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->SetFont('Times', 'B', 12);  // Cambié Arial por Times
        $this->Cell(0, 10, 'Hoja de Vida y Estudios', 0, 1, 'C');
        $this->Ln(5); // Salto de línea
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);  // Cambié Arial por Times
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);  // Cambié Arial por Times

// Conexión a la base de datos
$host = 'localhost';
$db = 'empleototal';
$user = 'root';
$password = '';
$charset = 'utf8';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se envió un ID de usuario
    if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
        die("ID de usuario no proporcionado.");
    }

    $id_usuario = $_GET['id_usuario'];

    // Obtener la hoja de vida asociada al usuario
    $stmt_hoja = $pdo->prepare("
        SELECT id_hojade_de_vida, nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, 
               nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, parentezco, 
               numero_referencia, intereses_personales, disponibilidad_trabajo
        FROM hojade_de_vida
        WHERE usuario_id_usuario = :id_usuario
    ");
    $stmt_hoja->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_hoja->execute();
    $hoja_de_vida = $stmt_hoja->fetch(PDO::FETCH_ASSOC);

    if (!$hoja_de_vida) {
        die("No se encontró una hoja de vida asociada al usuario.");
    }

    // Agregar los datos de la hoja de vida al PDF
    $pdf->Cell(0, 10, utf8_decode('Nombre: ' . $hoja_de_vida['nombre'] . ' ' . $hoja_de_vida['apellido']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Dirección: ' . $hoja_de_vida['direccion']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Teléfono: ' . $hoja_de_vida['telefono']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Correo: ' . $hoja_de_vida['correo']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Estado Civil: ' . $hoja_de_vida['estado_civil']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Fecha de Nacimiento: ' . $hoja_de_vida['fecha_nacimiento']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Nacionalidad: ' . $hoja_de_vida['nacionalidad']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Descripción sobre ti: ' . $hoja_de_vida['descripcion_sobre_ti']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Objetivo Profesional: ' . $hoja_de_vida['objetivo_profecional']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Idiomas: ' . $hoja_de_vida['idiomas']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Referencias: ' . $hoja_de_vida['referencias']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Parentesco: ' . $hoja_de_vida['parentezco']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Número de Referencia: ' . $hoja_de_vida['numero_referencia']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Intereses Personales: ' . $hoja_de_vida['intereses_personales']), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Disponibilidad de Trabajo: ' . $hoja_de_vida['disponibilidad_trabajo']), 0, 1);

    // Obtener los estudios asociados a la hoja de vida usando id_hojade_de_vida
    $stmt_estudios = $pdo->prepare("
        SELECT intitucion, titulo, fecha_inicio, fecha_fin 
        FROM estudios 
        WHERE hojade_de_vida_id_hojade_de_vida = :id_hoja
    ");
    $stmt_estudios->bindParam(':id_hoja', $hoja_de_vida['id_hojade_de_vida'], PDO::PARAM_INT);
    $stmt_estudios->execute();
    $estudios = $stmt_estudios->fetchAll(PDO::FETCH_ASSOC);

    // Agregar los estudios al PDF
    if (count($estudios) > 0) {
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('Estudios Asociados:'), 0, 1);
        foreach ($estudios as $estudio) {
            $pdf->Cell(0, 10, utf8_decode('Institución: ' . $estudio['intitucion']), 0, 1);
            $pdf->Cell(0, 10, utf8_decode('Título: ' . $estudio['titulo']), 0, 1);
            $pdf->Cell(0, 10, utf8_decode('Fecha de Inicio: ' . $estudio['fecha_inicio']), 0, 1);
            $pdf->Cell(0, 10, utf8_decode('Fecha de Fin: ' . $estudio['fecha_fin']), 0, 1);
            $pdf->Ln(5);  // Salto de línea entre cada estudio
        }
    } else {
        $pdf->Cell(0, 10, utf8_decode('No hay estudios asociados para esta hoja de vida.'), 0, 1);
    }

    // Salvar el PDF
    $pdf->Output('D', 'hoja_de_vida_' . $id_usuario . '.pdf');
    
} catch (PDOException $e) {
    die("Error al obtener datos: " . $e->getMessage());
}
?>
