<?php 

Class Db {
    const host = 'localhost';
    const user = 'root';
    const password = '';
    const dbName = 'api_tester';

    final public static function Connection(){
        $db = mysqli_connect(self::host,self::user,self::password,self::dbName);

        return $db;
    }
}