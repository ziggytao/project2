function check() {
    var checkhttp = new XMLHttpRequest();

    checkhttp.open("GET","status.php?func=3",false);
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
    signin.setAttribute("href","signin.html");
}