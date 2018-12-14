<?php
$nazwaBloga = $_GET['nazwa'];
if(is_dir("blogi/".$nazwaBloga) && $nazwaBloga != NULL){
    include('wstep.php');
    echo '<h1>'.$nazwaBloga.'</h1>';
    include("menu.php");
    
    $plikInfo = file("blogi/$nazwaBloga/info");
    $blogOwner = trim($plikInfo[0]);
    $opisBloga = "";
    for($i=2;$i<count($plikInfo);$i++)
        $opisBloga .= "<br/>".$plikInfo[$i];
    $lista = scandir("blogi/".$nazwaBloga);
    $file_path = []; 
    echo "Opis:".$opisBloga;
    $indeks = 0;
    foreach($lista as $key=>$value){
        if($key > 1 && strpos($value,".w") > 0){
            $file = file("blogi/".$nazwaBloga."/$value");
			array_push($file_path, substr("blogi/".$nazwaBloga."/$value",0,24));
            $iloscKomentarzy = scandir("blogi/".$nazwaBloga."/".substr($value,0,-2));
            if($iloscKomentarzy != false)
                $iloscKomentarzy = count($iloscKomentarzy) - 2;
            else
                $iloscKomentarzy = 0;
            
            $wpis[$indeks]['nazwa'] = substr($value,0,-2);
            $wpis[$indeks]['data'] = substr($value,0,4).".".substr($value,4,2).".".substr($value,6,2)." ".substr($value,8,2).":".substr($value,10,2).":".substr($value,12,2);
            $wpis[$indeks]['kto_dodal'] = $blogOwner;
            $wpis[$indeks]['ile_komentarzy'] = $iloscKomentarzy;
            for($i=0;$i<=count($file);$i++){
                $wpis[$indeks]['tresc'] .= "<br/>".$file[$i];
            }
            $indeks++;
        }
    }
	$indeks = 0;
    foreach($wpis as $key=>$value){
        echo "<br/><br/>".$value['data']."   ".$value['kto_dodal'];
        echo $value['tresc'];
        echo "<a style='cursor: pointer' id='wyswietl_komentarze' href='komentarze.php?blog=".$nazwaBloga."&wpis=".$value['nazwa']."'>Komentarzy(".$value['ile_komentarzy'].")</a>";
        echo "<a id='dodaj_komentarz' href='koment.php?wpis=".$value['nazwa']."&blog=".$nazwaBloga."'>Dodaj komentarz</a><br/><br/>";
	if (file_exists($file_path[$indeks]."0.fil"))
	{
		echo "<a href='".$file_path[$indeks]."0.fil"."'>file1</a><br/><br/>";
	}
		
	if (file_exists($file_path[$indeks]."1.fil"))
	{
		echo "<a href='".$file_path[$indeks]."1.fil"."'>file2</a><br/><br/>";
	}
	if (file_exists($file_path[$indeks]."2.fil"))
		{
		echo "<a href='".$file_path[$indeks]."2.fil"."'>file3</a><br/><br/>";
	}
	$indeks++;
    }
    
}elseif($nazwaBloga != NULL){
    echo "Blog o podanej nazwie nie istnieje!";
}else{
    header("Location: listaBlogow.php");
}
echo '</body></html>';
?>