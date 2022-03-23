<?php

function emptyInput($name,$email ,$uid ,$pwd ,$pwdRepeat){
$result;
if (empty($name) || empty($email) || empty($uid) ||empty($pwd) || empty($pwdRepeat)) {
$result = true;
}else{
    $result = false;
}
return $result;

}

function pwdMatch($pwd ,$pwdRepeat){

    if ($pwd !== $pwdRepeat) {
        $result = true;
        }else{
            $result = false;
        }
        return $result;

}

function uidExists($conn,$email){
    $sql = "SELECT * FROM users WHERE userEmail =?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../signIn.html?error=fuuuuult");
        exit();

    }
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
       return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);



}





function creatUser($conn, $name, $email, $uid, $pwd){
    $sql = "INSERT INTO users(username, userEmail, userUid,userPwd) VALUES (?, ?, ?,?); ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../signIn.html?error=somthingrowng");
        exit();    }


        mysqli_stmt_bind_param($stmt,"ssss",$name, $email, $uid, $pwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../index.html?error=none");

        $uidExistss = uidExists($conn,$email);
        session_start();
        $_SESSION["userid"] = $uidExistss["userId"];
        $ss =$_SESSION["userid"];



  


        java($conn,$ss);
        html($conn,$ss);
        data($conn,$ss);
    
        exit();

   

}


function emptyLogin($email ,$pwd ){
    $result;
    if ( empty($email) || empty($pwd) ) {
    $result = true;
    }else{
        $result = false;
    }
    return $result;
    
    }


    function getjava ($conn,$email){

        
        if(!$conn){
        
            die("connection faild:". mysqli_connect_error());
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $uidExists = uidExists($conn,$email);
        $check = $uidExists["userId"];

        
        $sql = "SELECT * FROM java WHERE java.userId = $check ";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               return $row;
        }
    } else {
           return false;
        }
        
        $conn->close();

    }
    function gethtml ($conn,$email){

        
        if(!$conn){
        
            die("connection faild:". mysqli_connect_error());
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $uidExists = uidExists($conn,$email);
        $check = $uidExists["userId"];
        
        $sql = "SELECT * FROM html WHERE html.userId = $check";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               return $row;
        }
    } else {
           return false;
        }
        
        $conn->close();

    }

    function getdata ($conn,$email){

        
        if(!$conn){
        
            die("connection faild:". mysqli_connect_error());
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $uidExists = uidExists($conn,$email);
        $check = $uidExists["userId"];
        
        $sql = "SELECT * FROM datebasee WHERE datebasee.userId = $check";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               return $row;
        }
    } else {
           return false;
        }
        
        $conn->close();

    }

    function java($conn,$ss){




$sql = "INSERT INTO java (userId,mod1,mod2,mod3,mod4,mod5)
VALUES ($ss,0,0,0,0,0)";

$conn->query($sql);

    }

    function html($conn,$ss){




        $sql = "INSERT INTO html (userId,mod1,mod2,mod3,mod4,mod5)
        VALUES ($ss,0,0,0,0,0)";
        
        $conn->query($sql);
        
            }

            function data($conn,$ss){




                $sql = "INSERT INTO datebasee (userId,mod1,mod2,mod3,mod4)
                VALUES ($ss,0,0,0,0)";
                
                $conn->query($sql);
                
                $conn->close();
                    }


    

   function logInUser($conn,$email,$pwd){

    $uidExists = uidExists($conn,$email);
    $java = getjava($conn,$email);
    $html = gethtml($conn,$email);
    $data = getdata($conn,$email);

        if ($uidExists === false) {

             header("location: ../logIn.html?error=wrongLogIn");
        exit();
        }
        $pwdd = $uidExists["userPwd"];
         if ($pwd !== $pwdd) {
            header("location: ../logIn.html?error=wrongpass");
        exit();

        } else if($pwd === $pwdd){
            session_start();
            $_SESSION["useruid"] = $uidExists["userUid"];
            $_SESSION["userid"] = $uidExists["userId"];

            $_SESSION["java"] = $java["mod1"] + $java["mod2"] +$java["mod3"] +$java["mod4"]+ $java["mod5"];
            $_SESSION["html"] = $html["mod1"] + $html["mod2"]+ $html["mod3"]+ $html["mod4"]+ $html["mod5"];
            $_SESSION["data"] = $data["mod1"] + $data["mod2"]+ $data["mod3"]+ $data["mod4"];
         
            header("location: ../index.html");
            exit();

        }

        }


       function add($conn, $id){
          

        if(!$conn){
        
            die("connection faild:". mysqli_connect_error());
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
       
        
        $sql = "UPDATE `java` SET `mod1`='1' WHERE java.userId = $id";
        $result = $conn->query($sql);

        
       
        
        $conn->close();
        
        }

        function reload($conn,$email){

            $uidExists = uidExists($conn,$email);
            $java = getjava($conn,$email);
            $html = gethtml($conn,$email);
            $data = getdata($conn,$email);


            session_start();
            $_SESSION["useruid"] = $uidExists["userUid"];
            $_SESSION["userid"] = $uidExists["userId"];

            $_SESSION["java"] = $java["mod1"] + $java["mod2"] +$java["mod3"] +$java["mod4"]+ $java["mod5"];
            $_SESSION["html"] = $html["mod1"] + $html["mod2"]+ $html["mod3"]+ $html["mod4"]+ $html["mod5"];
            $_SESSION["data"] = $data["mod1"] + $data["mod2"]+ $data["mod3"]+ $data["mod4"];

        }



    


?>