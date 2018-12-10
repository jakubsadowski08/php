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
    if(trim(file("blogi/".$lista[$i]."/info")[0]) == $login){
        $nazwaBloga = $lista[$i];
        $haslo = trim(file("blogi/".$lista[$i]."/info")[1]);
    }
}

if($login == "" && $opis == ""){
    
	echo "<br/>
        <form action='' method='post'  enctype='multipart/form-data'>
        <br>
        Login<input name='login'/>
        <br>
        Hasło<input type='password' name='haslo'/>
        <br>
        Data<input type='text' readonly value=".date('Y-m-d')." name='data'/>
        <br>
        Godzina<input type='text' readonly name='godzina' value=".date('H:i').">
        <br>
        Tresc wpisu<textarea name='opis'/></textarea>
		<br>
        <input type='file' name='file1' />
		<br>
        <input type='file' name='file2' />
		<br>
        <input type='file' name='file3' />
		<br>
        <input type='submit' name='zapisz' value='zapisz'>
        <input type='reset' value='Wyczyść''/>
        </form>";
    
}elseif($nazwaBloga != ""){
    if($podaneHaslo == $haslo){
        if(strlen($_POST['opis']) > 0){
            $opis = $_POST['opis'];
            $data = substr($_POST['data'],0,4).substr($_POST['data'],5,2).substr($_POST['data'],8,2).substr($_POST['godzina'],0,2).substr($_POST['godzina'],3,2).date('s');
            $directory = "blogi/".$nazwaBloga."/";
			$cdir = scandir($directory); 
            foreach($cdir as $file)
				if($file == $data)
					$data = $data.substr(uniqid(),0, -11);
		$target_file = "/home/eaiibgrp/jsadows/public_html/php/blogi/".$nazwaBloga."/file1";
		$target_file_ = "/home/eaiibgrp/jsadows/public_html/php/blogi/".$nazwaBloga."/file2";
		$target_file__ = "/home/eaiibgrp/jsadows/public_html/php/blogi/".$nazwaBloga."/file3";
		move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file);
		move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file_);
		move_uploaded_file($_FILES["file3"]["tmp_name"], $target_file__);
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