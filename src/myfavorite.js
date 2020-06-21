var currentpage = 1,pagenumber = 0;
const PAGE = 3;
var username = document.getElementById("displayusername").innerHTML;
var pagenums = document.getElementsByClassName("page");
function displaypage() {
    console.log(currentpage);
    let pics = document.getElementsByClassName("pic");
    for(let i = 0; i < pics.length; i++){
        if(i < (currentpage-1)* PAGE || i >= currentpage * PAGE ){
            pics[i].style.display = "none";
        }else {
            pics[i].style.display = "block";
        }
    }
    pagenums[currentpage-1].className = "active-page page";
}

function nextpage() {
    pagenums[currentpage-1].className = "page";
    currentpage++;
    if(currentpage > pagenumber){
        currentpage = 1;
    }
    displaypage();
}
function prepage() {
    pagenums[currentpage-1].className = "page";
    currentpage--;
    if(currentpage < 1){
        currentpage = pagenumber;
    }
    displaypage();
}
function divide() {
    currentpage = 1;
    let pics = document.getElementsByClassName("pic");
    let size = pics.length;
    let perpage = PAGE;
    pagenumber =  Math.ceil(size/perpage);
    if(pagenumber > 5){
        pagenumber = 5;
    }
    console.log("pagenumber="+pagenumber);
    for(let i = (currentpage-1)*perpage; i < currentpage*perpage && i < size; i++){
        pics[i].style.display = "block";
    }
    let p = document.getElementById("pagenums");
    let childs = p.childNodes;
    for(let i = childs.length-1; i >= 0; i--){
        p.removeChild(childs[i]);
    }
    for(let i = 0; i < pagenumber; i++){
        let n = document.createElement("div");
        if(i > 0){
            n.className = "page";
        }else {
            n.className = "active-page page";
        }
        n.onclick = function(){
            pagenums[currentpage-1].className = "page";
            currentpage = i+1;
            displaypage();
        };
        let t = document.createTextNode(i+1);
        n.appendChild(t);
        p.appendChild(n);
    }
}

function display() {
    var displayhttp = new XMLHttpRequest();
    displayhttp.open("GET","myfavorite.php?username="+username,false);
    displayhttp.send();
    document.getElementById("displayfavor").innerHTML = displayhttp.responseText;
    var btns = document.getElementsByClassName("delete-btn");
    for(let i = 0; i < btns.length; i++){
        let id = btns[i].parentElement.parentElement.firstElementChild.getAttribute("id");
        btns[i].onclick = function () {
            deletephoto(id);
            // alert(id);
        }
    }
    divide();
}
display();
function deletephoto(id) {
    var delhttp = new XMLHttpRequest();
    delhttp.open("GET","favor.php?func=un&id="+id+"&username="+username,false);
    delhttp.send();
    display();
}