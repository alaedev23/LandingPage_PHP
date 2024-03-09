<?php 

if ($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["lang"])) {
    $lang = $_GET["lang"];
    setcookie("lang",$lang,time()+3600);
} else {
    if (isset($_COOKIE["lang"])) {
        $lang = $_COOKIE["lang"];
    } else {
        $lang = "gb";
    }
}

?>