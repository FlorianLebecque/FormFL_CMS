<?php
    $properties = fopen("properties.prop","r");

    $propertiesName=["title","backColor","ConteneurColor","HeadFooterColor","OverLigneColor","TextColor","ErrorColor","GoodColor","WarningColor"];

    $props = array();

    $i = 0;
    while($ligne = fgets($properties)){
        
        $ligne = str_replace("\n","",$ligne); 
        $ligne = str_replace("\r","",$ligne); 
        $ligne = str_replace("\t","",$ligne); 
        $props[$propertiesName[$i]] = $ligne;
        $i++;
    }

    fclose($properties);

?>