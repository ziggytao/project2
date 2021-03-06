function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return r[2]; return null;
}
if(getQueryString("err") == 1){
    var text = document.createTextNode("用户名重复！");
    document.getElementById("err").appendChild(text);
}
function validateForm()
{
    var username=document.forms["signupform"]["username"].value;
    var email=document.forms["signupform"]["email"].value;
    var pass=document.forms["signupform"]["password"].value;
    var repass=document.forms["signupform"]["re_password"].value;
    var usr = /^[a-zA-Z_0-9]{5,18}$/;
    if(username.length < 6 ||username.length > 18){
        remove(document.getElementById("err"));
        let text = document.createTextNode("用户名长度应为5-18个字符!");
        document.getElementById("err").appendChild(text);
        return false;
    }else if(!usr.test(username)){
        remove(document.getElementById("err"));
        let text = document.createTextNode("用户名格式错误！只能包含英文、数字、字母和下划线");
        document.getElementById("err").appendChild(text);
        return false;
    }

    var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
    if(!reg.test(email)){
        remove(document.getElementById("err"));
        let text = document.createTextNode("邮箱格式错误！请输入正确的邮箱地址");
        document.getElementById("err").appendChild(text);
        return false;
    }

    var p = /^(?![A-Z]+$)(?![a-z]+$)(?!\d+$)\S{6,}$/;
    // alert(pass);
    // alert(p.test(pass));
    if(pass.length < 6){
        remove(document.getElementById("err"));
        let text = document.createTextNode("密码长度至少为6位!");
        document.getElementById("err").appendChild(text);
        return false;
    }else if(!p.test(pass)){
        remove(document.getElementById("err"));
        alert(pass);

        let text = document.createTextNode("密码格式错误！密码必须至少由数字,大写字母,小写字母其中两种组成，且长度不小于6，同时第一位不能为数字");
        document.getElementById("err").appendChild(text);
        return false;
    }

    if(pass != repass) {
        remove(document.getElementById("err"));
        let text = document.createTextNode("两次密码输入不一致！");
        document.getElementById("err").appendChild(text);
        return false;
    }

    return true;
}
function remove(element) {
    element.innerHTML = '';
}
