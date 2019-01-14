<?php
$nazwaBloga = $_GET['nazwa'];
if(is_dir("blogi/".$nazwaBloga) && $nazwaBloga != NULL){
    include('wstep.php');
    echo '<h1>'.$nazwaBloga.'</h1>';
    include("menu.php");
    
    $plikInfo = file("blogi/$nazwaBloga/info.txt");
    $blogOwner = trim($plikInfo[0]);
    $opisBloga = "";
    for($i=2;$i<count($plikInfo);$i++)
        $opisBloga .= "<br/>".$plikInfo[$i];
    $lista = scandir("blogi/".$nazwaBloga);
    
    echo "Opis:".$opisBloga;
    $indeks = 0;
    foreach($lista as $key=>$value){
        if($key > 1 && strpos($value,".w") > 0){
            $file = file("blogi/".$nazwaBloga."/$value");
            $iloscKomentarzy = scandir("blogi/".$nazwaBloga."/".substr($value,0,-2).".k");
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
    foreach($wpis as $key=>$value){
        echo "<br/><br/>".$value['data']."   ".$value['kto_dodal'];
        echo $value['tresc'];
        echo "<a style='cursor: pointer' id='wyswietl_komentarze' href='komentarze.php?blog=".$nazwaBloga."&wpis=".$value['nazwa']."'>Komentarzy(".$value['ile_komentarzy'].")</a>";
        echo "<a id='dodaj_komentarz' href='koment.php?wpis=".$value['nazwa']."&blog=".$nazwaBloga."'>Dodaj komentarz</a><br/><br/>";
    }
    
}elseif($nazwaBloga != NULL){
    echo "Blog o podanej nazwie nie istnieje!";
}else{
    header("Location: listaBlogow.php");
}
echo '</body></html>';
?>