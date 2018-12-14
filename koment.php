<?php
include('wstep.php');
echo '<h1>Dodaj komentarz</h1>';   
include("menu.php");

if($_POST['opis'] == ""){
	echo "
        <br/>
        <form action='' method='post'>
		Rodzaj komentarza<select name='rodzaj'><option value='pozytywny'>Pozytywny</option><option value='neutralny'>Neutralny</negatywny><option value='negatywny'>Negatywny</negatywny></select> 
        <br/>
        Autor<input name='autor'>
        <br/>
        Tresc komentarza<textarea name='opis'/></textarea>
        <br/>
        <input type='reset' value='Wyczyść' />
        <button type='submit' name='zapisz' value='zapisz'>Wyślij</button>
        </form>"; 
}elseif(strlen($_POST['opis']) > 0){
    
    $autor = $_POST['autor'];
    $rodzaj_komentarza = $_POST['rodzaj'];
    $opis = $_POST['opis'];
    
    if(!is_dir("blogi/".$_GET['blog']."/".$_GET['wpis']))
        mkdir("blogi/".$_GET['blog']."/".$_GET['wpis']);
    
    $list = scandir("blogi/".$_GET['blog']."/".$_GET['wpis']);
    $numer = count($list) - 2;
    
    $file = fopen("blogi/".$_GET['blog']."/".$_GET['wpis']."/$numer", "w");
    
    fwrite($file,$rodzaj_komentarza."\r\n");
    fwrite($file,date('Y-m-d H:i:s')."\r\n");
    fwrite($file,$autor."\r\n");
    fwrite($file,$opis);
    
    echo 'Komentarz dodany!';
    
}
echo '</body></html>';
?>