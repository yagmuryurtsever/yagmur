<?php

$servername = "localhost";
$username = "root";
$password = "";


if($_POST) {
    if($_POST['name'] and $_POST['email'] and $_POST['phone'] and $_POST['egitim'] and $_POST['message']) {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $egitim = $_POST['egitim'];
        $message = $_POST['message'];

        try {
            $db = new PDO("mysql:host=$servername; dbname=bemar;charset=utf8",$username,$password);
        } catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
        
        $insert = $db->prepare("INSERT INTO iletisim SET
                            name = :name,
                            phone = :phone,
                            mail = :mail,
                            statu = :statu,
                            message = :message
                            ");
        
        $data = array(
            "name" => $name,
            "phone" => $phone,
            "mail" => $email,
            "statu" => $egitim,
            "message" => $message,
        );
        
        try {
            $result = $insert->execute($data);
        } catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
        
        if($result) {
            echo '<div style="width:fit-content;padding: 1rem;background: green;color:white;">Mesajınız başarıyla gönderildi.</div>';
        } else {
            echo '<div style="width:fit-content;padding: 1rem;background: red;color:white;">Mesaj gönderilirken bir sorun oldu.</div>';
        }
    } else {
        echo '<div style="width:fit-content;padding: 1rem;background: orange;color:white;">Lütfen boş alan bırakmayın.</div>';
    }
} else {
    echo "Yetkisiz erişim isteği.";
    die();
}