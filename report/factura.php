<?php
session_start();
require './fpdf/fpdf.php';
include '../Consultas/consultasSql.php';

// Sanitización del parámetro id
$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    die("Error: ID de pedido inválido.");
}

// Consulta de venta
$sVenta = ejecutar::consultar("SELECT * FROM venta WHERE NumPedido='$id'");
if (!$sVenta || mysqli_num_rows($sVenta) == 0) {
    die("Error: No se encontró el pedido.");
}
$dVenta = mysqli_fetch_array($sVenta, MYSQLI_ASSOC);

// Consulta del cliente
$sCliente = ejecutar::consultar("SELECT * FROM cliente WHERE NIT='" . $dVenta['NIT'] . "'");
if (!$sCliente || mysqli_num_rows($sCliente) == 0) {
    die("Error: No se encontró el cliente.");
}
$dCliente = mysqli_fetch_array($sCliente, MYSQLI_ASSOC);

// Clase para el PDF
class PDF extends FPDF
{
}

// Configuración del PDF
ob_end_clean();
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont("Times", "", 20);
$pdf->SetMargins(25, 20, 25);
$pdf->SetFillColor(0, 255, 255);

// Encabezado
$pdf->Cell(0, 5, 'E-Market', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont("Times", "", 14);
$pdf->Cell(0, 5, 'Factura de pedido número ' . $id, 0, 1, 'C');
$pdf->Ln(20);

// Información del cliente
$pdf->SetFont("Times", "b", 12);
$pdf->Cell(33, 5, 'Fecha del pedido:', 0);
$pdf->SetFont("Times", "", 12);
$pdf->Cell(37, 5, $dVenta['Fecha'], 0);
$pdf->Ln(12);

$pdf->SetFont("Times", "b", 12);
$pdf->Cell(37, 5, 'Nombre del cliente:', 0);
$pdf->SetFont("Times", "", 12);
$pdf->Cell(100, 5, $dCliente['NombreCompleto'] . " " . $dCliente['Apellido'], 0);
$pdf->Ln(12);

$pdf->SetFont("Times", "b", 12);
$pdf->Cell(30, 5, 'Documento:', 0);
$pdf->SetFont("Times", "", 12);
$pdf->Cell(25, 5, $dCliente['NIT'], 0);
$pdf->Ln(12);

$pdf->SetFont("Times", "b", 12);
$pdf->Cell(20, 5, 'Dirección:', 0);
$pdf->SetFont("Times", "", 12);
$pdf->Cell(70, 5, $dCliente['Direccion'], 0);
$pdf->Ln(12);

$pdf->SetFont("Times", "b", 12);
$pdf->Cell(19, 5, 'Teléfono:', 0);
$pdf->SetFont("Times", "", 12);
$pdf->Cell(70, 5, $dCliente['Telefono'], 0);
$pdf->SetFont("Times", "b", 12);
$pdf->Cell(14, 5, 'Email:', 0);
$pdf->SetFont("Times", "", 12);
$pdf->Cell(40, 5, $dCliente['Email'], 0);
$pdf->Ln(10);

// Tabla de productos
$pdf->SetFont("Times", "b", 12);
$pdf->Cell(76, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio', 1, 0, 'C');
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(30, 10, 'Subtotal', 1, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont("Times", "", 12);
$suma = 0;

// Consulta de los detalles de venta
$sDet = ejecutar::consultar("SELECT * FROM detalle WHERE NumPedido='$id'");
if ($sDet && mysqli_num_rows($sDet) > 0) {
    while ($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)) {
        $consulta = ejecutar::consultar("SELECT * FROM producto WHERE CodigoProd='" . $fila1['CodigoProd'] . "'");
        if ($consulta && $fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $subtotal = $fila1['PrecioProd'] * $fila1['CantidadProductos'];
            $pdf->Cell(76, 10, $fila['NombreProd'], 1, 0, 'C');
            $pdf->Cell(30, 10, '$' . number_format($fila1['PrecioProd'], 2), 1, 0, 'C');
            $pdf->Cell(30, 10, $fila1['CantidadProductos'], 1, 0, 'C');
            $pdf->Cell(30, 10, '$' . number_format($subtotal, 2), 1, 0, 'C');
            $pdf->Ln(10);
            $suma += $subtotal;
        }
        mysqli_free_result($consulta);
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron productos para este pedido.', 1, 1, 'C');
}

// Total
$pdf->SetFont("Times", "b", 12);
$pdf->Cell(76, 10, '', 1, 0, 'C');
$pdf->Cell(30, 10, '', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total:', 1, 0, 'C');
$pdf->Cell(30, 10, '$' . number_format($suma, 2), 1, 0, 'C');
$pdf->Ln(10);

// Salida del PDF
$pdf->Output('I', 'Factura-#' . $id . '.pdf');

// Liberación de recursos
mysqli_free_result($sVenta);
mysqli_free_result($sCliente);
mysqli_free_result($sDet);
?>
