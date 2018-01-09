<?php
$file = fopen("userRepository.txt","r+") or die("Unable to open file!");
$userMap = array();
while(!feof($file)){
    $each = trim(fgets($file));
    $eachPair = explode(":",$each);
    $userMap["$eachPair[0]"] = $eachPair[1];
}
fclose($file);


function checkname($userName){
    global $userMap;
    $exists = false;
    foreach($userMap as $name => $password){
        if($userName == $name){
            $exists = true;
            break;
        }
    }
    return $exists;
}

function userValidation($userName,$userPwd){
    global $userMap;
    $isAUser = false;
    foreach($userMap as $name => $password){
        if($userName == $name && $userPwd == $password) {
            $isAUser = true;
            $_SESSION["username"] = $userName;
            $_SESSION["password"] = $userPwd;
            $_SESSION["message"] = "Welcome, ". $userName;
            header("Location: q_4_SearchFormUI.php");
        }
    }
    if(!$isAUser){
        if(!checkname($userName)){
            $userMap += array($userName => $userPwd);
            $file = fopen("userRepository.txt","a");
            fwrite($file,"\n");
            fwrite($file,"$userName".":"."$userPwd");
            header("Location: q_4_LogInUI.php");
        }
        else{
            $_SESSION["message"] = "Invalid login! Please use correct name/password combination";
            header("Location: q_4_LogInUI.php");
        }
    }
    exit();
}


function display_message_login(){
    echo "<div"." style=\"color:red \"".">";
        echo $_SESSION["message"];
        unset($_SESSION["message"]);
    echo "</div>";
}

function display_message_home(){
    echo $_SESSION["message"];
    unset($_SESSION["message"]);
}


?>


