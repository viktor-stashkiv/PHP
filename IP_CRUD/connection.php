<?php

class Connection {
    private const user     = 'root';
    private const password = '';
    private const dsn = "mysql:host=localhost;dbname=IP_DB;charset=UTF8";
    private const options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    public static function getConnection(){
        return new PDO(self::dsn, self::user, self::password, self::options);
    }
}


?>