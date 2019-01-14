function swapStyleSheet(sheet){
    document.getElementById('pagestyle').setAttribute('href', sheet);
}
function find()
{
    for( i = 0; i < document.styleSheets.length; i++ )
    {
        var btn = document.createElement("BUTTON");
        var att = document.createAttribute("onclick");
        btn.appendChild(document.createTextNode(document.styleSheets[i].title));
        att.value = "swapStyleSheet('" + document.styleSheets[i].href +"')";
        btn.setAttributeNode(att);
        document.body.appendChild(btn);
    }
}

swapStyleSheet(document.cookie);