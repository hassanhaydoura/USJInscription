<?php $this->layout='login2';
  		
  	if(isset($succes) && $succes)
  	  {
  		echo '<h3><center>La lettre d\'appr&eacute;ciation a &eacute;t&eacute; sauvgard&eacute;e avec succ&egrave;s.</center></h3>';
  		echo '<h3><center>Merci.</center></h3>';
  	}
  	else{
  	 	echo '<h3><center>Erreur grave.</center></h3>';
  		echo '<h3><center>Merci.</center></h3>';	
  		}
 ?>