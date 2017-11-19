var q1,q2,q3;
var total1 = 0;
var total2 = 0;
var total3 = 0;
var total = 0;

window.addEventListener("load",addEventToButton,false);

function addEventToButton(){
    document.getElementById("sub").addEventListener("click",sum,false);
}

function sum(){
    //if input is not integer, alert and set default as 0
    if(isNaN(document.getElementById("book_1").value)){
        alert("please enter a positive integer! Default is: 0");
        q1 = 0;
        document.getElementById("book_1").value = 0;
    }
    else{
        q1 = parseInt(document.getElementById("book_1").value);

    }
    if(isNaN(document.getElementById("book_2").value)){
        alert("please enter a positive integer! Default is: 0");
        q2 = 0;
        document.getElementById("book_2").value = 0;
    }
    else{
        q2 = parseInt(document.getElementById("book_2").value);


    }
    if(isNaN(document.getElementById("book_3").value)){
        alert("please enter a positive integer! Default is: 0");
        q3 = 0;
        document.getElementById("book_3").value = 0;

    }
    else{
        q3 = parseInt(document.getElementById("book_3").value);
    }

    total1 = q1 * 19.99;
    total2 = q2 * 86.00;
    total3 = q3 * 55.00;
    total = total1 + total2 + total3;

    //generate the original form in the new page
    var content = document.getElementById("container").innerHTML;
    document.write("<div>");
    document.write(content);

    //attach new tags with required information
    document.write("</div>");
    var div1 = document.createElement("div");
    div1.innerHTML ="Basic XHTML (Quantity = " + q1 + "): $" + total1;
    document.body.appendChild(div1);

    var div2 = document.createElement("div");
    div2.innerHTML ="Intro to PHP (Quantity = " + q2 + "): $" + total2;
    document.body.appendChild(div2);

    var div3 = document.createElement("div");
    div3.innerHTML ="Advanced JQuery (Quantity = " + q3 + "): $" + total3;
    document.body.appendChild(div3);

    var br = document.createElement("br");
    document.body.appendChild(br);

    var div = document.createElement("div");
    div.innerHTML ="Final Total: $" + total;
    document.body.appendChild(div);

}


