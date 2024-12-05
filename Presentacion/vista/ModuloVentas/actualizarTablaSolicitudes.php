<?php
session_start();
$solicitudes = $_SESSION['solicitudes'] ?? array();

$html = '';

foreach ($solicitudes as $orden) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($orden['numero_orden']) . '</td>';
    $html .= '<td>';
    $html .= '<form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">';
    $html .= '<input type="hidden" name="numero_orden" value="' . htmlspecialchars($orden['numero_orden']) . '">';
    $html .= '<button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Mostrar Detalles">Mostrar Detalles</button>';
    $html .= '</form>';
    $html .= '</td>';
    $html .= '<td>';
    $html .= '<form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">';
    $html .= '<input type="hidden" name="numero_orden" value="' . htmlspecialchars($orden['numero_orden']) . '">';
    $html .= '<button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Cancelar Orden">Cancelar</button>';
    $html .= '</form>';
    $html .= '</td>';
    $html .= '</tr>';
}

echo $html;