<?php
class koneksi
{
    private static $dbName = 'kasir_amaa';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbPass = '';

    private static $connection = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        if (null == self::$connection)
        {
            try
            {
                self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbPass);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>
