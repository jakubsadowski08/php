<?php
include('wstep.php');
echo '<h1>Lista blogów</h1>';
include("menu.php");

$lista = scandir("blogi/");
$indeks = 0;
foreach($lista as $key=>$value){
    if($key > 1){
        $file = file("blogi/$value/info.txt");
        $blog[$indeks]['nazwa'] = $value;
        $blog[$indeks++]['owner'] = trim($file[0]);
    }
}
    
echo '<br/>Lista blogów:';
echo '<ul>';
foreach($blog as $key=>$value){
    echo "<li>".$value['owner']." - <a href='blog.php?nazwa=".$value['nazwa']."'>".$value['nazwa']."</a></li>";
}
echo '</ul></body></html>';
?>