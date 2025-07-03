<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

if (isset($_POST['restaurar']) && isset($_FILES['backup_sql'])) {
    $archivo_tmp = $_FILES['backup_sql']['tmp_name'];
    $nombre_archivo = $_FILES['backup_sql']['name'];

    // Datos de conexión
    $host = 'localhost';
    $usuario = 'root';
    $contraseña = ''; // poné tu contraseña si tenés
    $base_de_datos = 'tablero_php';

    // Ruta a mysql.exe (F:\ en tu caso)
    $mysql = '"C:\\xampp\\mysql\\bin\\mysql.exe"';

    // Comando para restaurar la base de datos
    $comando = "$mysql --host=$host --user=$usuario --password=$contraseña $base_de_datos < \"$archivo_tmp\"";

    // Ejecutar comando
    $output = [];
    $return = null;
    exec($comando, $output, $return);

    if ($return === 0) {
        $mensaje = "<p style='color:green;'>✅ La base de datos <strong>$base_de_datos</strong> fue actualizada correctamente desde <strong>$nombre_archivo</strong>.</p>";
    } else {
        $mensaje = "<p style='color:red;'>❌ Error al actualizar la base de datos. Código: $return</p>";
    }
}
?>

<!-- Formulario -->
<h2>Restaurar base de datos desde backup</h2>
<?php if (isset($mensaje)) echo $mensaje; ?>
<form method="post" enctype="multipart/form-data">
    <label>Seleccionar archivo .sql:</label><br>
    <input type="file" name="backup_sql" accept=".sql" required><br><br>
    <button type="submit" name="restaurar">Actualizar base de datos</button>
</form>
