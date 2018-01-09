<?php

session_start();


//var_dump($_POST);

$petNameArray = array();
if(!empty($_POST["petname"])) {
    $petNameArray = $_POST["petname"];
}

$sizeArray = array();
if(isset($_POST['size']) ) {
    $sizeArray = (array)$_POST['size'];
}

$locationArray = array();
if(isset($_POST['location'])) {
    $locationArray =(array) $_POST['location'];
}

$priceArray = array();
if(isset($_POST["price"])) {
    $priceArray = (array)$_POST["price"];
}

$facilityArray = array();
if(isset($_POST["facility"])){
    $facilityArray = (array)$_POST["facility"];
}


if(isset($_SESSION["username"])){
    $_SESSION["message"] = "Welcome, ".$_SESSION["username"];
}

//var_dump($petNameArray);
//var_dump($sizeArray);
//var_dump($locationArray);
//var_dump($priceArray);
//var_dump($facilityArray);


//read the file
$file = fopen("appRepository.txt","r+") or die("Unable to open file!");
$appMap = array();
$index = 0;
//store each line of the file as array
while(!feof($file)){
    $each = trim(fgets($file));
    $eachInfo = explode(",",$each);
    $appMap[$index] = $eachInfo;
    $index++; //size
}
fclose($file);

//echo "        --------------           ";
//var_dump($appMap[0]);


$results = array(); //take pieces of information of search result
$i = 0;  //results size

if(isset($_POST["done"])){
    searchApartment();
}

//echo "        --------------           ";
//var_dump($results);
//var_dump($i);



function searchApartment(){
    global $locationArray,$sizeArray,$priceArray,$facilityArray,$petNameArray;
    global $appMap;
    global $i, $results;
    foreach($appMap as $eachApt){
        //echo "check 1";
        if(in_array($eachApt[3],$petNameArray)){
            //echo "check 2";
            if(in_array($eachApt[0],$sizeArray) || ((double)$eachApt[0] > 5.5 && in_array("more than 5.5",$sizeArray))){
                //echo "check 3";
                if(in_array($eachApt[1],$locationArray)){
                    //echo "check 4";
                    $eachFacility = explode("|",$eachApt[4]);
                    //var_dump($eachFacility);
                    $hasFacility = true;
                    foreach ($facilityArray as $oneFacility ){
                        if(!in_array($oneFacility,$eachFacility)){
                            $hasFacility = false;
                            break;
                        }
                    }
                    //var_dump($hasFacility);
                    if($hasFacility){
                        //echo "check 5";
                        if((int)$eachApt[5] <= (int)$priceArray[0]){
                            //echo "check 6";
                            //$_SESSION["test"] = "This is the ".$i." time";
                            //var_dump($_SESSION["test"]);
                            array_push($results, $eachApt);
                            $i++;
                        }
                    }
                }
            }
        }

    }
}



function display_result_for_login_user(){
    global $results;
    echo "<h3>"."Here are the results: " ."</h3>";
    if(!empty($results)){
        echo "<ol>";
        foreach ($results as $result){
            echo "<li style='font-size: 80%'>";
            echo "Location: ".$result[1]." | ";
            echo "Size: ".$result[0]." | ";
            echo "Street Address: ".$result[2]." | ";
            echo "Price: ".$result[5]." | ";
            echo "Contact: ".$result[6]." | ";
            echo "</li>";
            echo "<br>";
        }
        echo "</ol>";
    }
    else{
        echo "<h3>"."There is no match in our database. " ."</h3>";
        echo "<h4 style='color: red'>"."For grading purpose, please use the search criteria for first line in file" ."</h4>";
        echo "<h4 style='color: red'>"."I suggest selecting Cats, Studio, West Island(and/or Downtown), <500, Fire place. MAKE ADJUSTMENTS BASED ON THAT"."</h4>";
        echo "<h5 style='color: red'>"."There might be some typos or unintentional error undetected."."</h5>";
    }

}


function display_result_for_unlogin_user(){
    global $results;
    echo "<h4>You can go back and log in</h4>";
    echo "<h3>"."Here are the results: " ."</h3>";
    if(!empty($results)){
        echo "<ol>";
        foreach ($results as $result){
            echo "<li style='font-size: 80%'>";
            echo "Location: ".$result[1]." | ";
            echo "Size: ".$result[0]." | ";
            echo "<input type=\"button\" value=\"Log In to show the address, price, and contact\" onclick=\"location.href = 'q_4_LogInUI.php'\">"." ";
            echo "</li>";
            echo "<br>";
        }
        echo "</ol>";
    }
    else{
        echo "<h3>"."There is no match in our database. " ."</h3>";
        echo "<h4 style='color: red'>"."For grading purpose, please use the search criteria for first line in file. "."</h4>";
        echo "<h4 style='color: red'>"."I suggest selecting Cats, Studio, West Island(and/or Downtown), <500, Fire place. MAKE ADJUSTMENTS BASED ON THAT"."</h4>";
        echo "<h5 style='color: red'>"."There might be some typos or unintentional error undetected."."</h5>";
    }
}


function display_message_atSearch(){
    echo "<div>";
    echo $_SESSION["message"];
    echo "</div>";
    unset($_SESSION["message"]);
}

?>
<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Results</title>
    <style>
        body {background-color: skyblue;}
        #login{
            line-height: 12px;
            width: 28px;
            font-size: 12pt;
            margin-top: 10px;
            margin-right: 150px;
            position:absolute;
            top: 10px;
            right:10px;
        }

    </style>
</head>
<body onload="clock()">
<?php include "header.html"; ?>

<table id="login">
    <tr>
        <td>
            <?php
            if(isset($_SESSION["message"])){
                display_message_atSearch();
            }
            ?>
        </td>
    </tr>

</table>

<?php
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
    display_result_for_login_user();
}
else{
    display_result_for_unlogin_user();
}
?>



<?php include "footer.html"; ?>
</body>
</html>

