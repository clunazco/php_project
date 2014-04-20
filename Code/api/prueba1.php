<html>

<head>
<meta charset="UTF-8">
<title>¡Maldito pervertido!</title>

</head>



<?php

// Capture the values posted to this php program from the text fields

// which were named 'YourName' and 'FavoriteWord' respectively



$YourName = $_REQUEST['YourName'] ;

$FavoriteWord = $_REQUEST['FavoriteWord'] ;

$miOS = php_uname('a') ;

?>



<body bgcolor="#FFFFFF" text="#000000">

<p>



Hola maldito <?php print $YourName; ?>



<p>



Te gusta la palabra <b> <?php print $FavoriteWord; ?>?!</b>



<p>Dejame decirte... no tienes imaginación...
<p>
El sistema operativo en el cual me estoy ejecutando es <?php print $miOS; ?>
</p>

</body>



</html>
