<?php
namespace sgbdtrue\utils\secretariat;


class MysqlConnection
{
    /**
     * @var \PDO
     */
    private static $pdo = null;

    public function __construct()
    {}


    public static function getConnection()
    {
        if(self::$pdo === null)
        {
            self::$pdo = new \PDO('mysql:host=localhost;port=3306','root','');
            //new \PDO('mysql:host='.\DBConf::HOST.';port=3306', \DBConf::LOGIN, \DBConf::PASSWORD, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }




}
