<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

$host = 'localhost';
$usuario = 'root';
$contraseña = ''; // tu contraseña si tenés
$base_de_datos = 'tablero_php'; // CAMBIAR

// Ruta a mysqldump
$mysqldump = '"F:\\xampp\\mysql\\bin\\mysqldump.exe"'; // CAMBIAR si está en otro lado

// Carpeta de destino
$carpeta_destino = __DIR__ . '/backups';
if (!file_exists($carpeta_destino)) {
    mkdir($carpeta_destino, 0777, true);
}

// Nombre del archivo de salida
$nombre_archivo = $base_de_datos . '_backup_' . date('d-m-Y_H-i-s') . '.sql';
$ruta_archivo = $carpeta_destino . DIRECTORY_SEPARATOR . $nombre_archivo;

// Comando para ejecutar
$comando = "$mysqldump --host=$host --user=$usuario --password=$contraseña $base_de_datos > \"$ruta_archivo\"";

// Ejecutar el comando
$output = [];
$return_var = null;
exec($comando, $output, $return_var);

// Resultado
if ($return_var === 0 && file_exists($ruta_archivo)) {
    echo "✅ Backup creado correctamente: <strong>$nombre_archivo</strong>";
} else {
    echo "⚠️ El backup fue creado pero el sistema devolvió código $return_var.<br>";
    echo "👉 Podés verificar el archivo manualmente en: <code>$ruta_archivo</code>";
}
?>
