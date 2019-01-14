read = false;
function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chatwindow").value =
                this.responseText;
        }
    };
    xhttp.open("GET", "chat.txt", true);
    xhttp.send();
}
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    if (checkBox.checked == true){
        chatwindow.style.display = "block";
        chatnick.style.display = "block";
        chatmsg.style.display = "block";
        bt.style.display = "block";
        read = true;
    } else {
        chatwindow.style.display = "none";
        chatnick.style.display = "none";
        chatmsg.style.display = "none";
        bt.style.display = "none";
    }
}
function Reading(){
    loadDoc()

    setTimeout(Reading, 1000);
}
function submit_msg(){
    if (chatnick.value == "")
    {
        alert("Podaj nick")
    }
    else if (chatmsg.value == "")
        alert("Podaj wiadomosc")
    else
    {
        m=chatnick.value + ": " + chatmsg.value;
        writing("zapisz.php?m=" + m);
    }

}
function writing(url)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

if(read = true)
{
    Reading();
}