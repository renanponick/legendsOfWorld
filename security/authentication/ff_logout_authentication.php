<?php
session_start();
// Esvazia as Variaves.
session_unset();
// Finaliza a Sess�o.
session_destroy();
header("location: ../../index.php");
?>