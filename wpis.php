<?php
include('wstep.php');
echo '<h1>Dodawanie wpisu</h1>';
include("menu.php");

$login = $_POST['login'];
$podaneHaslo = md5($_POST['haslo']);
$opis = $_POST['opis'];
$lista = scandir("blogi/");
$nazwaBloga = "";

for($i=2;$i<count($lista);$i++){
    if(trim(file("blogi/".$lista[$i]."/info.txt")[0]) == $login){
        $nazwaBloga = $lista[$i];
        $haslo = trim(file("blogi/".$lista[$i]."/info.txt")[1]);
    }
}

if($login == "" && $opis == ""){
    
	echo "<script>
	var x = document.getElementById("data");
	var y = document.getElementById("godzina");
	if(x.getMonth() >12 || x.getYear() <0 || x.getDate() > 31 || x.getDate()<0 || y.getMinutes() > 60 || y.getHours() > 24 || y.getHours() < 0)  
	{
		var x = new Date();
		var d = new Date();
		d.setHours(getHours(), getMinutes());
		document.getElementById("data") = x.yyyymmdd();;
		document.getElementById("godzina") = d;
	
	</script>
	<br/>
        <form action='' method='post'>
        <br>
        Login<input name='login'/>
        <br>
        Hasło<input type='password' name='haslo'/>
        <br>
        Data<input type='date' readonly value=".date('Y-m-d')." name='data' id='data'/>
        <br>
        Godzina<input type='time' readonly name='godzina' value=".date('H:i')." id ='godzina'>
        <br>
        Tresc wpisu<textarea name='opis'/></textarea>
		<br>
        <input type='checkbox' name='sendFile1'><input type='file' name='file1'/>
		<br>
        <input type='checkbox' name='sendFile2'><input type='file' name='file2'/>
		<br>
        <input type='checkbox' name='sendFile3'><input type='file' name='file3'/>
		<br>
        <input type='submit' name='zapisz' value='zapisz'>
        <input type='reset' value='Wyczyść''/>
        </form>";
    
}elseif($nazwaBloga != ""){
    if($podaneHaslo == $haslo){
        if(strlen($_POST['opis']) > 0){
            $opis = $_POST['opis'];
            $data = substr($_POST['data'],0,4).substr($_POST['data'],5,2).substr($_POST['data'],8,2).substr($_POST['godzina'],0,2).substr($_POST['godzina'],3,2).date('s')."00";
            
            $directory = "blogi/".$nazwaBloga."/";
            $filecount = 0;
            $files = glob($directory . "*.w");
            if ($files){
                $filecount = count($files);
            }
            $data += $filecount;
                        
            $file = fopen("blogi/".$nazwaBloga."/$data.w", "w");
            fwrite($file,$opis."\r\n");
                        
            echo "Wpis dodano pomyślnie";
                
        }else{
            echo "Treść wpisu nie może być pusta!";
        }
    }else{
        echo "Wprowadzone hasło jest nieprawidłowe";
    }
}else{
    echo "Nie istnieje blog dla podanych danych!";
}
echo '</body></html>';
?>
