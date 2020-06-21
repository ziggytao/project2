function showpics() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("pichint").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","getpics.php",true);
    xmlhttp.send();
}
function showmostfavored() {
    var favorhttp = new XMLHttpRequest();
    favorhttp.onreadystatechange=function()
    {
        if (favorhttp.readyState==4 && favorhttp.status==200)
        {
            document.getElementById("mainpic").innerHTML=favorhttp.responseText;
        }
    };
    favorhttp.open("GET","getpics.php?q=favor",true);
    favorhttp.send();
}
showpics();
showmostfavored();
document.getElementById("refreshicon").onclick = showpics;
function check() {
    var checkhttp = new XMLHttpRequest();

    checkhttp.open("GET","src/status.php?func=3",false);
    checkhttp.send();
    document.getElementById("displayusername").innerHTML=checkhttp.responseText;
    if(document.getElementById("displayusername").innerHTML == "Sign in!"){
        return false;
    }else {
        return true;
    }
}
if(check()){
    document.getElementById("dropdown").className = "dropdown-active";
}else {
    var signin = document.getElementById("signin");
    signin.setAttribute("href","src/signin.html");
}

