read = false;
function poll() {
		var http = new XMLHttpRequest();
		http.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200) {
				if (this.status === 200) {
					try {
						var json = JSON.parse(this.responseText);
					} catch {
						poll();return;
					}
					

					if (json.status !== true) {
						alert(json.error);return;
					}

					document.getElementById("chatwindow").value = json.content;


					poll();
				} else {
					poll();
				}

			}
		}
		http.open('GET', 'czyt.php', true);
		http.send();


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
    poll();
}
