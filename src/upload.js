function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return r[2]; return null;
}
function generatecontent() {
    var contentselect = document.getElementById("selectcontent");

    contentselect.innerHTML = "<option value=\"\">Select a content</option>" +
        "<option value=\"scenery\">Scenery</option>" +
        "<option value=\"city\">City</option>" +
        "<option value=\"people\">People</option>" +
        "<option value=\"animal\">Animal</option>" +
        "<option value=\"buliding\">Building</option>" +
        "<option value=\"wonder\">Wonder</option>" +
        "<option value=\"other\">Other</option>";

}
function generatecountry() {
    var countryselect = document.getElementById("selectcountry");
    var countryhttp = new XMLHttpRequest();
    countryhttp.open("GET","country.php",false);
    countryhttp.send();
    countryselect.innerHTML = countryhttp.responseText;
    countryselect.onchange = function (){
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
if(getQueryString('id')){
    var infothttp = new XMLHttpRequest();
    infothttp.open("GET","getphotoinfo.php?id="+getQueryString('id'),false);
    infothttp.send();
    var info = infothttp.responseText;
    info  = JSON.parse(info);
    // alert(info.title);
    document.getElementById('title').value = info.title;
    document.getElementById('description').innerHTML = info.description;
    document.getElementById('selectcontent').value = info.content;
    document.getElementById('selectcountry').value = info.country;
    generatecity(info.country);
    document.getElementById('selectcity').value = info.city;
    document.getElementById('img0').src = '../img/normal/medium/'+info.path;
    document.getElementById("upload-file").style.display = "none";
    document.getElementById("upload-file").parentElement.setAttribute("action",
        "upload_file.php?update=1&id="+getQueryString('id'));
    document.getElementById("img0").style.maxWidth = "1000px";
    document.getElementById("img0").style.maxHeight = "800px";
}
