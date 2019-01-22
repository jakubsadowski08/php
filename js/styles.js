function swapStyleSheet(){
    var coo = getCookie("css");
    document.getElementById('pagestyle') .setAttribute('href', coo);
    setCookie("css",coo);
}
function swapStyleSheets(sheet){
    document.getElementById('pagestyle').setAttribute('href', sheet);
    setCookie("css",sheet);
}
function find()
{

    for( i = 0; i < document.styleSheets.length; i++ )
    {
        var btn = document.createElement("BUTTON");
        var att = document.createAttribute("onclick");
        btn.appendChild(document.createTextNode(document.styleSheets[i].title));
        if(i ==0)
        {
            att.value = "swapStyleSheets('" + "cs.css" +"')";
        }
        else
        {
            att.value = "swapStyleSheets('" + document.styleSheets[i].href +"')";
        }

        btn.setAttributeNode(att);
        document.body.appendChild(btn);
    }
}
function setCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue + ";";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
swapStyleSheet()

