<?php
session_start();
if($_POST) {
    if($_POST['username'] === "admin" and $_POST['password'] === "123456") {
        $_SESSION['login'] = true;
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo '<meta http-equiv="refresh" content="0">';
    }
} else {
    if(isset($_SESSION['login'])) {
        echo '
            <!DOCTYPE html>
            <html lang="tr">
                <head>
                    <title>BEMAR ALSANCAK</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                </head>
                
                <body>
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-6">
        ';     

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bemar";

        try{
            $db = new pdo ("mysql:host=$servername; dbname=$dbname", $username, $password);
        } catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }

        $rows = $db->query("SELECT * FROM iletisim ORDER BY date DESC", PDO::FETCH_ASSOC);

        if ( $rows->num_rows > 0 ) {
            
            foreach($rows as $row){
                echo '
                <div class="box border p-4 rounded-3 my-5">
                    <div class="text-end text-secondary small">'.$row["date"].'</div>
                    <div><strong>Ad:</strong> '.$row["name"].'</div>
                    <hr>
                    <div><strong>Telefon:</strong> '.$row["phone"].'</div>
                    <hr>
                    <div><strong>Mail:</strong> '.$row["mail"].'</div>
                    <hr>
                    <div><strong>Eğitim:</strong> '.$row["statu"].'</div>
                    <hr>
                    <div><strong>Mesaj:</strong> '.$row["message"].'</div>
                </div>
            ';
        }

        }

        echo '
                            </div>
                        </div>
                    </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                </body>
                
            </html>
        ';
    } else {
        echo '
            <!DOCTYPE html>
            <html lang="tr">
            <!-- admin page falanfıtı.com/admin-->
                <head>
                    <title>BEMAR ALSANCAK</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                </head>
                
                <body>
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-4">
                            
                                <div class="box border p-4 rounded-3 my-5">
                                    <form action="admin.php" method="POST">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Kullanıcı adı</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Şifre</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                </body>
                
            </html>
        ';
    }
}