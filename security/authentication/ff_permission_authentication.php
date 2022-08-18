<?php
	if($permissao != $_SESSION['permissao']){
		if($_SESSION['permissao']=="0"){
			header("Location: //127.0.0.1/legends_of_world/system/admin/ff_main_admin.php?msg=Permissão restrita para esta página.");
			//sai,encerra
			exit;
		}else if($_SESSION['permissao']=="1"){
				
				header("Location: //127.0.0.1/legends_of_world/system/client/ff_main_client.php?msg=Permissão restrita para esta página.");
				//sai,encerra
				exit;
			}else{
				header("Location: //127.0.0.1/legends_of_world/security/authentication/ff_logout_authentication.php");
				//sai,encerra
				exit;
			}
	}
	
?>