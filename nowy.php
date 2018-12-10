<?php
include('wstep.php');
echo '<h1>Zakładanie nowego bloga</h1>';
include("menu.php");


if(!isset($_POST['zapisz'])){
    echo '<br/>
        <form action="" method="post">
        Nazwa bloga: <input name="nazwa_bloga"/>
        <br>
        Nazwa użytkownika: <input name="login"/>
        <br>
        Hasło: <input type="password" name="haslo"/>
        <br>
        Opis: <textarea name="opis"></textarea>
        <br>
        <input type="submit" name="zapisz" value="zapisz">
        <input type="reset" value="Wyczyść"/>
        </form>';
}else{
	$nazwa = $_POST["nazwa_bloga"];
	$login = $_POST["login"];
	$haslo = $_POST["haslo"];
    $opis  = $_POST['opis'];    
    $loginIstnieje = false;
    
	$lista = scandir("blogi/");
	$indeks = 0;
	foreach($lista as $key=>$value){
		if($key > 1){
			$file = file("blogi/$value/info");
			if(trim($file[0]) == $login)
			{
				$loginIstnieje = true;
			}
			
		}
	}
    if($nazwa != "" && $login != "" && $haslo != "" && !$loginIstnieje){
        if(!is_dir("blogi"))
            mkdir("blogi");
        
        if(!is_dir("blogi/".$nazwa)){
            
            if(mkdir("blogi/$nazwa"))
                echo "Blog ".$nazwa." założony pomyślnie!";
                    
            $infoFile = fopen("blogi/$nazwa/info", "w");
            fwrite($infoFile,$login."\r\n");
            fwrite($infoFile,md5($haslo)."\r\n");
            fwrite($infoFile,$opis);
            //fwrite($usersFile,$login."\r\n");
            
        }else
            echo "Blog ".$nazwa." już istnieje";
    }elseif($loginIstnieje){
        echo "Login ".$login." już istnieje!";
    }else{
        echo "Nie wszytkie pola zostały wypełnione";
    }
}
echo "</body></html>";
?>