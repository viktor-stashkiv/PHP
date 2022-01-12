<?php

require_once('connection.php');

class DB{
    public static function saveIP($userAgent,$cookie,$ip,$page){

        $db = Connection::getConnection();

        try{
           
            $sql = 'INSERT INTO ips(IP,USER_AGENT,PAGE,COOKIE) VALUES(:IP,:USER_AGENT,:PAGE,:COOKIE)';
    
            $stmt = $db->prepare($sql);
    
            $stmt->execute([':IP' => $ip,':USER_AGENT' => $userAgent,':PAGE' => $page,':COOKIE' => $cookie]);
    
    
        }catch(IOExeption $e){
            echo $e->getMessage();
        }
    }

    public static function showIP(){

        $db = Connection::getConnection();

        try{
            $sql = 'SELECT * FROM ips';

            $stmt = $db->query($sql);

            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $fetch;

        }catch(IOExeption $e){
            echo $e->getMessage();
        }

    }

    public static function showIPtoID($id){

        $db = Connection::getConnection();

        try{
            $sql = 'SELECT * FROM ips WHERE id = :id';
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

            return $fetch;

        }catch(IOExeption $e){
            echo $e->getMessage();
        }

    }

    public static function deleteIP($id){

        $db = Connection::getConnection();

        try{
            $sql = "DELETE FROM ips WHERE id=?";
            $stmt= $db->prepare($sql);
            $stmt->execute([$id]);
        }catch(IOExeption $e){
            echo $e->getMessage();
        }
    }

    public static function updateIP($id,$idUpdate,$userAgentUpdate,$pageUpdate,$cookieUpdate="NULL"){

        $db = Connection::getConnection();
        try{
            $sql = 'UPDATE ips SET IP = :ip, USER_AGENT = :user_agent, PAGE = :page, COOKIE = :cookie WHERE id = :id';

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ip', $idUpdate);
            $stmt->bindParam(':user_agent', $userAgentUpdate);
            $stmt->bindParam(':page', $pageUpdate);
            $stmt->bindParam(':cookie', $cookieUpdate);

            $stmt->execute();
            
        }catch(IOExeption $e){
            echo $e->getMessage();
        }
    }
}


?>