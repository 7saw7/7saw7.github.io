<?php

class HeaderFooterSingleton {
    private static $instancia;
    private $header;
    private $footer;

    // Constructor privado para evitar la creación directa de instancias
    private function __construct() {
        define('BASE_URL', '/BoticaPolonia_IngSoftware');  // Ajusta '/Proyecto' según la estructura de tu proyecto

        $this->header = '
        <header>
            <table border="0" align="center">
                <tr>
                    <td>
                        <img src="' . BASE_URL . '/Presentacion/assets/Imagen/logopolonia.png" width="1300" height="110">
                    </td>
                </tr>
            </table>
        </header>
';

        $this->footer = '
            <footer id="site-footer" style="text-align: center; font-weight: bold; position: fixed; bottom: 0; width: 100%;">
                <p>Derechos de autor &copy; 2023 Mi Sitio Web. Todos los derechos reservados.</p>
            </footer>
        ';
    }

    // Método estático para obtener la instancia
    public static function obtenerInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new HeaderFooterSingleton();
        }
        return self::$instancia;
    }

    // Método para obtener el encabezado
    public function obtenerHeader() {
        return $this->header;
    }

    // Método para obtener el pie de página
    public function obtenerFooter() {
        return $this->footer;
    }
}
?>
