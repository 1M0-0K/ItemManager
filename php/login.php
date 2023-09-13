<?php

    session_start();

    include_once "config.php";


    $user = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if(!empty($user) && !empty($password)){
        $sql = $connection->prepare("SELECT * FROM users WHERE name = ? AND password = PASSWORD(?) ;");
        $sql->bind_param("ss",$user, $password);
        $sql->execute();
        $result = $sql->get_result();
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row[admin] == 1){
                $_SESSION["user_id"] = $row[id];
                echo true;
            }else{
                echo "You are not an administrator";
            }
        }else{
            echo "Username or Password is incorrect";
        }

        $sql->close();
    }else{
        echo "All input fileds are required!";
    }

?>
