<?php
include 'conexiondb.php';

require 'vendor/autoload.php';
// Incluye la biblioteca PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Si se ha enviado el formulario, recupera las fechas y realiza la consulta SQL
if (isset($_POST['descargar'])) {
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];

    // Construye la consulta SQL utilizando BETWEEN para obtener las fechas en el rango especificado
    $consulta = "SELECT * FROM formulario_traspaso WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";

    // Ejecuta la consulta
    $resultado = mysqli_query($conexion, $consulta);

    // Crea un nuevo objeto Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Agrega una hoja al archivo Excel
    $hoja = $spreadsheet->getActiveSheet();

    // Agrega los encabezados de las columnas
    $hoja->setCellValue('A1', 'Fecha');
    $hoja->setCellValue('B1', 'Incidente Grave');

    // Agrega estilo a los encabezados de las columnas
$encabezados = 'A1:B1'; // rango de celdas de los encabezados
$hoja->getStyle($encabezados)->applyFromArray([
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY, 
         \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    ],
]);

    // Agrega los datos de la consulta a las filas de la hoja
    $fila = 2;
    while ($registro = mysqli_fetch_assoc($resultado)) {
        $hoja->setCellValue('A' . $fila, $registro['fecha']);
        $hoja->setCellValue('B' . $fila, $registro['incidentegrave']);

        $hoja->getStyle('A' . $fila)->getAlignment()->setWrapText(true)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);
        $hoja->getStyle('H' . $fila)->getAlignment()->setWrapText(true)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);

            // Ajusta el ancho de las columnas al contenido automáticamente
    foreach(range('A','B') as $columna) {
        $hoja->getColumnDimension($columna)->setAutoSize(true);
    }

        $fila++;
    }

    // Crea un objeto Writer para guardar el archivo Excel en disco
    $writer = new Xlsx($spreadsheet);
    $nombreArchivo = 'registro_incidentes.xlsx';

    ob_end_clean();
    // Configura las cabeceras HTTP para indicar que se descargará un archivo Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
    header('Cache-Control: max-age=0');

    // Guarda el archivo Excel en el buffer de salida del script y lo envía al navegador
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit();
}


?>
