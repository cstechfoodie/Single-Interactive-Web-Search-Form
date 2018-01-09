<?php
    session_start();
    include "q_4_LogInService.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shunyu's Apartment Search Form</title>
    <style>
        body {background-color: skyblue; }
        #firstfield {background-color:darkseagreen; border-color:blue;}
        #legend1 {color:blue;}
        #secondfield {background-color:cornsilk;border-color:red;}
        #legend2 {color: red;}
        p {font-weight:bold; color: #035eff;}
        .sub {font-weight: normal; color:black;}
        #unorderlist {font-weight:bold;color: #ffa39c;}
        label {font-weight:normal;}
        .specify {font-weight: bold;}
        img {height: 1.5cm; width: 3cm}
        #thirdfield {
            visibility: hidden;
            background-color: cornsilk;
            border-width: medium;
            border-color: blueviolet;
        }
        #legend3{
            color:fuchsia;
        }
        #advise{
            font-weight: bold;
            color: red;
        }
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

    <?php include 'header.html'; ?>

    <table id="login">
        <tr>
            <td><input type="button" value="Log In" onclick="location.href = 'q_4_LogInUI.php'"></td>
            <td>
            <?php
            if(isset($_SESSION["message"])){
                display_message_home();
            }
            ?>
            </td>
        </tr>

    </table>
    <form name="searchForm" action="q_4_SearchFormService.php" method="post">
        <fieldset id="firstfield">
            <legend id="legend1">Renter(s) Information</legend>
            <p>How many people will live in the apartment?
                <label ><select name="number">
                        <option>&nbsp;</option>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select></label>
            </p>
            <p>Smoker?
                <label><input type="radio" name="isSmoker" value="Yes">Yes </label>
                <label><input type="radio" name="isSmoker" value="No">No</label>
            </p>
            <p>Any pets?</p>
            <p>
                <label><input type="checkbox" name="petname[]" value="Y" />Cat(s)</label><br>
                <label><input type="checkbox" name="petname[]" value="Y" />Dog(s)</label><br>
                <label><input type="checkbox" name="petname[]" value="Y"/>Other</label>
                <label class="specify" >Specify:</label><label><input type="text" name="petname[]" ></label><br>
                <label><input type="checkbox" name="petname[]" value="N" />No Pets</label><br>
            </p>
        </fieldset>
        <fieldset id="secondfield">
            <legend id="legend2">What are you looking for?</legend>
            <div>* ALL criteria must be selected for a functional search</div>
            <ul id="unorderlist">
                <li id="size">Size of apartment:<br>
                    <label><input type="checkbox" name="size[]" value="Studio" />Studio</label>
                    <label><input type="checkbox" name="size[]" value="3.5" />3&frac12;</label>
                    <label><input id="at4_5" type="checkbox" name="size[]" value="4.5" />4&frac12;</label>
                    <label><input id="at5_5" type="checkbox" name="size[]" value="5.5" />5&frac12;</label>
                    <label><input id="moreThan5_5" type="checkbox" name="size[]" value="more than 5.5" />More than 5&frac12;</label>
                    <br>
                    <br>
                </li>

                <li id="location">Do you have preferred location?<br>
                    <label><input type="checkbox" name="location[]" value="West Island" />West Island</label>
                    <label><input type="checkbox" name="location[]" value="South Island" />South Island</label>
                    <label><input id="atDowntown" type="checkbox" name="location[]" value="Downtown" />Downtown</label>
                    <label><input type="checkbox" name="location[]" value="Lower Westmount" />Lower Westmount</label>
                    <label><input type="checkbox" name="location[]" value="NDG" />NDG</label>

                    <label><input type="checkbox" name="location[]" value="Laval" />Laval</label>
                    <br>
                    <br>
                </li>
                <li>Price Range/month:<br>
                    <label><select id="priceRange" name="price">
                            <option id="op1" value="500">&lt;$500</option>
                            <option id="op2" value="700">$500-700</option>
                            <option id="op3" value="900">$700-900</option>
                            <option id="op4" value="1100">$900-1100</option>
                            <option id="op5" value="1300">&gt;$1100-$1300</option>
                            <option id="op6" value="1000000">No price limit</option>
                        </select></label>
                    <br>
                    <br>
                </li>
                <li>Would be nice to have<br>
                    <label><input type="checkbox" name="facility[]" value="Fire place" />Fire place</label>
                    <label><input type="checkbox" name="facility[]" value="Laundromat in building" />Laundromat in building</label>
                    <label><input type="checkbox" name="facility[]" value="Indoor Parking" />Indoor Parking</label>
                    <label><input type="checkbox" name="facility[]" value="Outdoor Parking" />Outdoor Parking</label>
                    <label><input type="checkbox" name="facility[]" value="Balcony" />Balcony</label>
                    <br>
                    <br>
                </li>
            </ul>
        </fieldset>
        <fieldset id="thirdfield">
            <legend id="legend3">Expert Suggestions</legend>
            <div id="advise"></div>
        </fieldset>

            <p class="sub">Let's see what we can find...</p>
            <p class="sub">
                <input type="submit" name="done" value="Search" />
                <input type="reset" name="clear" value="Start over" />
            </p>

    </form>


<script>
    var suggestionField = document.getElementById("thirdfield");
    var advise = document.getElementById("advise");
    //register listener to first event
    document.getElementById("moreThan5_5").addEventListener("change",display,false);
    document.getElementById("atDowntown").addEventListener("change",display,false);

    //register listener to second event
    document.getElementById("moreThan5_5").addEventListener("change", display, false);
    document.getElementById("at4_5").addEventListener("change", display, false);
    document.getElementById("at5_5").addEventListener("change", display, false);
    document.getElementById("atDowntown").addEventListener("change", display, false);
    document.getElementById("priceRange").addEventListener("change", display, false);


    //eventhandler to handle the display
    function display() {
        var fact1 = (document.getElementById("moreThan5_5").checked || document.getElementById("at5_5").checked
            || document.getElementById("at4_5").checked);
        var fact2 =
            (document.getElementById("op1").selected || document.getElementById("op2").selected || document.getElementById("op3").selected || document.getElementById("op4").selected);
        advise.innerHTML="";

        if (document.getElementById("moreThan5_5").checked &&
            document.getElementById("atDowntown").checked) {
            advise.innerHTML =
                "It is very difficult to find an apartment larger than 51/2 in downtown";
            suggestionField.style.visibility = "visible";

            if (fact1 &&
                document.getElementById("atDowntown").checked && fact2){
                advise.innerHTML = advise.innerHTML + "<br>" + "Normally an apartment of 4 1/2 and above costs more than $1000 in downtown area";
            }
        }


        else {
            if (fact1 &&
                document.getElementById("atDowntown").checked && fact2){
                advise.innerHTML = "Normally an apartment of 4 1/2 and above costs more than $1000 in downtown area";
                suggestionField.style.visibility = "visible";
            }
            else{
                suggestionField.style.visibility = "hidden";
                advise.innerHTML = "";
            }
        }
    }

</script>
    <?php include "footer.html"; ?>
</body>

</html>