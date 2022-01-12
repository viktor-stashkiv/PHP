<?php 

****************** SELECT ******************

    $user     = 'root';
    $password = '';
    $dsn = "mysql:host=localhost;dbname=IP_DB;charset=UTF8";

try {

    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    $db = new PDO($dsn, $user, $password, $options);

    $sql = 'SELECT publisher_id, name FROM publishers';

    $statement = $db->query($sql);

    $fetch = $statement->fetchAll(PDO::FETCH_ASSOC); // витягнути дані з БД у вигляді асоціативного масиву

    }catch (PDOException $e) {
		die($e->getMessage());
	} 


    ********* Підготовлений запит ********

    $user     = 'root';
    $password = '';
    $dsn = "mysql:host=localhost;dbname=IP_DB;charset=UTF8";
try{

    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    $db = new PDO($dsn, $user, $password, $options);

    $sql = 'SELECT publisher_id, name FROM publishers WHERE publisher_id = :publisher_id';

    $statement = $db->prepare($sql);

    $statement->bindParam(':publisher_id', $publisher_id, PDO::PARAM_INT); // зв'язати параметри із зміннами

    $statement->execute();

    $fetch = $statement->fetch(PDO::FETCH_ASSOC);

    }catch (PDOException $e) {
		die($e->getMessage());
	}

****************** INSERT ********************

    $user     = 'root';
    $password = '';
    $dsn = "mysql:host=localhost;dbname=IP_DB;charset=UTF8";

try {

    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $db = new PDO($dsn, $user, $password, $options);

    $sql = 'INSERT INTO ips(IP,USER_AGENT,PAGE,COOKIE) VALUES(:IP,:USER_AGENT,:PAGE,:COOKIE)';
    
    $statement = $db->prepare($sql);

    $statement->execute([':IP' => $ip,':USER_AGENT' => $userAgent,':PAGE' => $page,':COOKIE' => $cookie]);

	} catch (PDOException $e) {
		die($e->getMessage());
	}

    
****************** UPDATE ********************

    $user     = 'root';
    $password = '';
    $dsn = "mysql:host=localhost;dbname=IP_DB;charset=UTF8";

try {

    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $db = new PDO($dsn, $user, $password, $options);

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

    ****************** DELETE ********************

    $user     = 'root';
    $password = '';
    $dsn = "mysql:host=localhost;dbname=IP_DB;charset=UTF8";

    try {

        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $db = new PDO($dsn, $user, $password, $options);

        $sql = "DELETE FROM ips WHERE id=?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$id]);
    }catch(IOExeption $e){
        echo $e->getMessage();
    }


?>