<?php
    /**
     * method.php handles every input
     */

    if(isset($_POST['username']) && $_POST['password']){
        $user = $_POST['username'];
        $password = $_POST['password'];
        #check if username is longer than...
        if(strlen($user) <= 5){
            echo"Your username is to short, please edit it.";
            exit();
        }elseif(strlen($user) >= 15){
            echo"Your username is to long, please edit it.";
            exit();
        }
        try{
            #Including db connection, which can be called from $dbh
            include_once('db_conn.php');
            #Preparing SELECT query to check if the user exists
            $statement = $dbh->prepare("SELECT id FROM users WHERE user = :user");
            $statement->execute(array(':user' => $user));
            #fetching the result into $result
            $result = $statement->fetch();
            $id = $result['id'];

            #checking if there is a result
            if($id == 0){
                #Encrypting password
                $password = password_hash($password, PASSWORD_DEFAULT);
                echo "Password is now $password";
                $statement = $dbh->prepare("INSERT INTO users(user, password)
                VALUES(:user, :password)");
                $statement->execute([
                    ':user' => "$user",
                    ':password' => "$password"
                ]);
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        echo"ok";
    }

?>
