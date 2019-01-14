<?php
include('wstep.php');
echo '<h1>Komentarze</h1>';
include("menu.php");

$file = file("blogi/".$_GET['blog']."/info.txt");
$owner = trim($file[0]);    
$plikKomentowany = file("blogi/".$_GET['blog']."/".$_GET['wpis'].".w");
$wpis['nazwa'] = $_GET['wpis'];
$wpis['data'] = substr($wpis['nazwa'],0,4).".".substr($wpis['nazwa'],4,2).".".substr($wpis['nazwa'],6,2)." ".substr($wpis['nazwa'],8,2).":".substr($wpis['nazwa'],10,2).":".substr($wpis['nazwa'],12,2);
$wpis['kto_dodal'] = $owner;

for($i=0;$i<count($file);$i++){
    $wpis['tresc'] .= "<br/>".$plikKomentowany[$i];
}

echo "<br/>Wpis:<br/>";
echo $wpis['data']."   ".$wpis['kto_dodal'];
echo $wpis['tresc'];

$lista = scandir("blogi/".$_GET['blog']."/".$wpis['nazwa'].".k");
    
$indeks = 0;
foreach($lista as $key=>$value){
    if($key > 1){
        $file = file("blogi/".$_GET['blog']."/".$wpis['nazwa'].".k/$value");
        $komentarz[$indeks]['rodzaj'] = trim($file[0]);
        $komentarz[$indeks]['data'] = trim($file[1]);
        $komentarz[$indeks]['autor'] = trim($file[2]);
        
        for($i=3;$i<=count($file);$i++){
            $komentarz[$indeks]['tresc'] .= "<br/>".$file[$i];
        }
        $indeks++;
    }
}
    
foreach($komentarz as $key=>$value){
    if($value['rodzaj'] == 'pozytywny'){
        echo "<br/> Komentarz(pozytywny): <br/>";
        echo $value['data']."   ".$value['autor'];
        echo $value['tresc'];
    }
    elseif($value['rodzaj'] == 'negatywny'){
        echo "<br/> Komentarz(negatywny): <br/>";
        echo $value['data']."   ".$value['autor'];
        echo $value['tresc'];
    }
    else{
        echo "<br/> Komentarz(neutralny): <br/>";
        echo $value['data']."   ".$value['autor'];
        echo $value['tresc'];        
    }
}

echo '</body></html>';
?>