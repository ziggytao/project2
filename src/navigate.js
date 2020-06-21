const ROW = 2;
const COL = 6;
var currentpage = 1,pagenumber = 0;
var pagenums = document.getElementsByClassName("page");
function displaypage() {
    console.log(currentpage);
    let pics = document.getElementsByClassName("small");
    for(let i = 0; i < pics.length; i++){
        if(i < (currentpage-1)* ROW * COL || i >= currentpage * ROW * COL ){
            pics[i].style.display = "none";
            pics[i].parentElement.parentElement.parentElement.style.display = "none";
        }else {
            pics[i].style.display = "block";
            pics[i].parentElement.parentElement.parentElement.style.display = "block";
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
    let pics = document.getElementsByClassName("small");
    let size = pics.length;
    let perpage = ROW * COL;
    pagenumber =  Math.ceil(size/perpage);
    if(pagenumber > 5){
        pagenumber = 5;
    }
    console.log("pagenumber="+pagenumber);
    for(let i = (currentpage-1)*perpage; i < currentpage*perpage && i < size; i++){
        pics[i].setAttribute("fun","change");
        pics[i].style.display = "block";
        pics[i].parentElement.parentElement.parentElement.style.display = "block";
        console.log(i);
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

//get result from database
function getresult(query) {
    var resulthttp = new XMLHttpRequest();
    // resulthttp.onreadystatechange=function () {
    //     if(resulthttp.readyState == 4 && resulthttp.status == 200){
    //         document.getElementById("resulthint").innerHTML=resulthttp.responseText;
    //     }
    // };
    resulthttp.open("POST","navigate.php",false);
    resulthttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    resulthttp.send(query);
    document.getElementById("resulthint").innerHTML=resulthttp.responseText;
    divide();
}

getresult("func=1&key=Title&query=");

function resetselect() {
    generatecontent();
    generatecountry();
    document.getElementById("selectcity").innerHTML = "<option value=\"\">Select a city</option>";

}
function clearfields() {
    let click = document.getElementsByClassName("asidelink");
    for(let i= 0; i < click.length; i++){
        let p = click[i].children[0];
        p.style.color = "Black";
    }
}

//search by title
function onclick1() {
    var title = document.getElementById("Title").value;
    var query = "func=1&key=Title&query="+title;
    getresult(query);
    resetselect();
    clearfields();
}
document.getElementById("searchtitle").onclick = onclick1;


//click hot fields
function onclick2() {
    let key = this.className;
    clearfields();
    this.style.color = "Red";
    let value = this.getAttribute("name");
    let query = "func=1&key="+key+"&query="+value;
    getresult(query);
    resetselect();
    document.getElementById("Title").value = "";
}


//filter
function getfilter() {
    let query = "func=2";

    let myselect1 = document.getElementById("selectcontent");　　//获取select对象
    let index1 = myselect1.selectedIndex;　　　　　　　　　//获取被选中的索引
    let content = myselect1.options[index1].value;
    if (content != ""){
        query = query+"&content="+content;
    }
    let myselect2 = document.getElementById("selectcountry");　　//获取select对象
    let index2 = myselect2.selectedIndex;　　　　　　　　　//获取被选中的索引
    let country = myselect2.options[index2].value;
    if (country != ""){
        query = query+"&country="+country;
    }
    let myselect3 = document.getElementById("selectcity");　　//获取select对象
    let index3 = myselect3.selectedIndex;　　　　　　　　　//获取被选中的索引
    let city = myselect3.options[index3].value;
    if (city != ""){
        query = query+"&city="+content;
    }
    return query;
}
document.getElementById("filter-button").onclick = function () {
    getresult(getfilter());
    clearfields();
    document.getElementById("Title").value = "";
};

function gethots() {
    var hotcontent = new XMLHttpRequest();
    hotcontent.open("GET","showhots.php?q=1",false);
    hotcontent.send();
    document.getElementById("hot-content").innerHTML=hotcontent.responseText;

    var hotcountry = new XMLHttpRequest();
    hotcountry.open("GET","showhots.php?q=2",false);
    hotcountry.send();
    document.getElementById("hot-country").innerHTML=hotcountry.responseText;

    var hotcity = new XMLHttpRequest();
    hotcity.open("GET","showhots.php?q=3",false);
    hotcity.send();
    document.getElementById("hot-city").innerHTML=hotcity.responseText;

    let click = document.getElementsByClassName("asidelink");
    for(let i= 0; i < click.length; i++){
        let p = click[i].children[0];
        p.onclick = onclick2;
    }
}
gethots();

function generatecontent() {
    var contentselect = document.getElementById("selectcontent");
    var contenthttp = new XMLHttpRequest();
    contenthttp.open("GET","content.php",false);
    contenthttp.send();
    contentselect.innerHTML = contenthttp.responseText;

}
function generatecountry() {
    var countryselect = document.getElementById("selectcountry");
    var countryhttp = new XMLHttpRequest();
    countryhttp.open("GET","country.php",false);
    countryhttp.send();
    countryselect.innerHTML = countryhttp.responseText;
    countryselect.onchange = function (){
        document.getElementById("Title").value = "";
        generatecity(countryselect.value);
    }
}
function generatecity(country) {
    var cityselect = document.getElementById("selectcity");
    var cityhttp = new XMLHttpRequest();
    cityhttp.open("GET","city.php?country="+country,false);
    cityhttp.send();
    cityselect.innerHTML = cityhttp.responseText;
}
generatecontent();
generatecountry();


