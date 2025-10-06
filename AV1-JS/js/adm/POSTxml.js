function enviarXML(url, params, msg) {
    let xmlhttp=new XMLHttpRequest();
    console.log("1");
    xmlhttp.onreadystatechange=function() {
        if(this.readyState==4 && this.status==200) {
            console.log("requisicao funcionou: " + this.responseText);
            document.getElementById(msg).innerHTML = this.responseText;
        } 
        else if(this.readyState<4) {
            console.log("3: " + this.readyState);
        } 
        else console.log("requisicao falhou: " + this.status);
    };

    console.log("4");
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
    console.log("5");
}
