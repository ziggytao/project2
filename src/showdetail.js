function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return r[2]; return null;
}

function showdetail() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("pichint").innerHTML=xmlhttp.responseText;
            if(document.getElementById("signin").getAttribute("href") != "signin.html"){
                var username = document.getElementById("displayusername").innerHTML;
                var favor = getfavor(username);
                var likenode =  document.getElementsByClassName("like")[0];
                if(favor){
                    likenode.children[0].style.backgroundColor = "Red";
                    likenode.children[1].innerHTML = "Liked";
                    likenode.onclick = function (){
                        unfavor(username);
                        location.reload();
                    }
                }else {
                    likenode.children[0].style.backgroundColor = "inherit";
                    likenode.children[1].innerHTML = "Like";
                    likenode.onclick = function (){
                        favor_(username);
                        location.reload();
                    }
                }
            }else {
                document.getElementsByClassName("like")[0].onclick = function () {
                    alert("Please sign in to like this photo!");
                }
            }
        }
    };
    xmlhttp.open("GET","showdetails.php?id="+getQueryString("id"),true);
    xmlhttp.send();
}
showdetail();
function unfavor(username) {
    var un = new XMLHttpRequest();
    un.open("GET","favor.php?func=un&id="+getQueryString("id")+"&username="+username,false);
    un.send();
}
function favor_(username) {
    var fa = new XMLHttpRequest();
    fa.open("GET","favor.php?func=on&id="+getQueryString("id")+"&username="+username,false);
    fa.send();
}
function getfavor(username) {
    var whether = new XMLHttpRequest();
    whether.open("GET","getfavor.php?id="+getQueryString("id")+"&username="+username,false);
    whether.send();
    return whether.responseText;
}
