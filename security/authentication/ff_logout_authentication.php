<?php
session_start();
// Esvazia as Variaves.
session_unset();
// Finaliza a Sessão.
session_destroy();
header("location: ../../index.php");
?>