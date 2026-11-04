<?php
     include_once("connection.php");
     $con = connection();

     function getUsers(){
        $con = connection();
        $sql = "SELECT * FROM users";
        $query = mysqli_query($con, $sql);

        $users = [];
        while($row = mysqli_fetch_assoc($query)){
            $users[] = $row;

        }
        $con->close();
        return ["status" => "success", "data" => $users];

     }

     function registerUsers(){
        $con = connection();
            $name =trim( $_POST['name']?? '');

            $lastname =trim( $_POST['lastname']?? '');
            $username =trim( $_POST['username']?? '');
            $password = $_POST['password'] ?? '';
            $email =trim( $_POST['email']?? '');

            if (empty($name) || empty($lastname) || empty($username) || empty($password) || empty($email)) {
                return ["status" => "error", "message" => "Todos los campos son obligatorios"];
               
                
            }



            $passwordHash = password_hash("$password", PASSWORD_DEFAULT);


            $sql = "INSERT INTO users (name, lastname, username, password, email) VALUES(?, ?, ?, ?, ?)";

            $stmt = $con->prepare ($sql);
            $stmt->bind_param ("sssss", $name, $lastname, $username, $passwordHash, $email);

            if($stmt->execute()){

                $response = ["status" => "success", "message" => "usuario registrado de manera exitosa", "data" => getUsers()["data"]];

            }else{
                $response = ["status" => "error", "message" => "Error al registrar el usuario" . $stmt->error];

            }
            $con->close();
            $stmt->close();

            return $response;


      
     }


     function login(){
        
     }

?>