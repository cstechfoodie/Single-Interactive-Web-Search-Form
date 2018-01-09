<?php
    session_start();

    include "q_4_LogInService.php";

    if(isset($_POST["done"])){
        userValidation($_POST["name"],$_POST["password"]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LogIn</title>
    <style>
        body {background-color: skyblue}
    </style>

</head>

<body onload="clock()">
    <?php include "header.html"; ?>

    <script>
        function nfocused(){
            document.getElementById("nformat").style = "color : black";
            document.getElementById("nformat").innerHTML = " Letters and digits only";
        }

        function nblur() {
            document.getElementById("nformat").innerHTML = " ";
            var name = document.getElementById("name").value;
            var reg = /\w+/;
            var ok = reg.exec(name);
            if(!ok){
                document.getElementById("nformat").style = "color : red";
                document.getElementById("nformat").innerHTML = " Error: Not a valid name";
                document.getElementById("name").value = "";
            }
        }

        function pfocused(){
            document.getElementById("pformat").style = "color : black";
            document.getElementById("pformat").innerHTML = " At least 4 characters, one letter and digit required";
        }
        
        function pblur() {
            document.getElementById("pformat").innerHTML = " ";
            var pw = document.getElementById("password").value;
            var reg = /^(?=.*\d)(?=.*[a-zA-Z])(\w{4,})$/;
            var ok = reg.exec(pw);
            if(!ok){
                document.getElementById("pformat").style = "color : red";
                document.getElementById("pformat").innerHTML = " Error: Not a valid password";
                document.getElementById("password").value = "";
            }
        }

        function error() {
            document.getElementById("error").innerHTML = "Invalid Login"
        }

    </script>
    <div id="error" onload="<?php if(strlen($error) > 0) {echo "error()";}; ?>"></div>
    <fieldset style="width: 20cm">
        <legend>Sign In/Create New Account</legend>
        <?php
            if(isset($_SESSION["message"])){
                display_message_login();
            }
        ?>
        <form method="post" action="q_4_LogInUI.php">
            <label>User Name: <input type="text" name="name" id="name" onfocus="nfocused()" onblur="nblur()"><span id="nformat"></span> </label>
            <div>
                <br>
            </div>
            <label>Password:&nbsp;&nbsp; &nbsp;<input type="text" name="password" id="password" onfocus="pfocused()" onblur="pblur()"><span id="pformat"><span></label>
            <br>
            <label><input type="submit" name="done" value="Log in"></label>
        </form>

    </fieldset>


<?php include "footer.html"; ?>

</body>
</html>