<?php
include('../../conexion.php');

// Obtener los datos del formulario
$id_hojade_de_vida = $_POST['id_hojade_de_vida'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$estado_civil = $_POST['estado_civil'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$nacionalidad = $_POST['nacionalidad'];
$descripcion_sobre_ti = $_POST['descripcion_sobre_ti'];
$objetivo_profecional = $_POST['objetivo_profecional'];
$idiomas = $_POST['idiomas'];
$referencias = $_POST['referencias'];
$parentezco = $_POST['parentezco'];
$numero_referencia = $_POST['numero_referencia'];
$intereses_personales = $_POST['intereses_personales'];
$disponibilidad_trabajo = $_POST['disponibilidad_trabajo'];
$usuario_id_usuario = $_POST['usuario_id_usuario'];

// Preparar la consulta de actualización
$query = "
    UPDATE hojade_de_vida
    SET 
        nombre = :nombre,
        apellido = :apellido,
        direccion = :direccion,
        telefono = :telefono,
        correo = :correo,
        estado_civil = :estado_civil,
        fecha_nacimiento = :fecha_nacimiento,
        nacionalidad = :nacionalidad,
        descripcion_sobre_ti = :descripcion_sobre_ti,
        objetivo_profecional = :objetivo_profecional,
        idiomas = :idiomas,
        referencias = :referencias,
        parentezco = :parentezco,
        numero_referencia = :numero_referencia,
        intereses_personales = :intereses_personales,
        disponibilidad_trabajo = :disponibilidad_trabajo,
        usuario_id_usuario = :usuario_id_usuario
    WHERE id_hojade_de_vida = :id_hojade_de_vida
";

// Ejecutar la consulta de actualización
$actualizar = $base_de_datos->prepare($query);
$actualizar->execute([
    ':nombre' => $nombre,
    ':apellido' => $apellido,
    ':direccion' => $direccion,
    ':telefono' => $telefono,
    ':correo' => $correo,
    ':estado_civil' => $estado_civil,
    ':fecha_nacimiento' => $fecha_nacimiento,
    ':nacionalidad' => $nacionalidad,
    ':descripcion_sobre_ti' => $descripcion_sobre_ti,
    ':objetivo_profecional' => $objetivo_profecional,
    ':idiomas' => $idiomas,
    ':referencias' => $referencias,
    ':parentezco' => $parentezco,
    ':numero_referencia' => $numero_referencia,
    ':intereses_personales' => $intereses_personales,
    ':disponibilidad_trabajo' => $disponibilidad_trabajo,
    ':usuario_id_usuario' => $usuario_id_usuario,
    ':id_hojade_de_vida' => $id_hojade_de_vida
]);

// Redirigir al usuario a la página de listado de hojas de vida (o alguna otra página relevante)
header("Location: ../../hojas_vida_admin.php");
exit;
?>
