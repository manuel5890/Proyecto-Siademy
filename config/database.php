<?php
// "Usamos una clase con propiedades privadas para guardar las credenciales de la base de datos (host, usuario, contraseña, y nombre de la DB).

// Lo hacemos así para que nadie fuera de la clase pueda acceder o modificar esos datos directamente.

class Conexion
{
    private $host = "localhost";
    private $db = "siademy";
    private $user = "root";
    private $pass = "";
    private $conexion;

    // El constructor (__construct) se ejecuta automáticamente cuadno creamos un objeto  de la clase, y se encarga de abrir la conexión con la base de datos usando PDO

    public function __construct()
    {
        // La palabra $this significa literalmente "esta clase". La usamos para acceder a las variables internas de la misma clase.
        // Por ejemplo, $this->conexion hace referencia a la conexión que pertenece a esta instancia de la clase.
        try {
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Finalmente, el método getConexion() sirve para obtener la conexión ya creada. en vez de abrir una nueva conexión cada vez, simplemente pedimos la que ya existe dentro del objeto
    public function getConexion()
    {
        return $this->conexion;
    }
}

// En resumen:
// La clase guarda las credenciales de forma segura
// El constructor abre la conexión automáticamente
// $this permite acceder a las variables internas de la clase
// getConexion() nos devuelve la conexión para poder ejecutar consultas
// De esta forma el código queda más limpio, reutilizable y fácil de mantener.
