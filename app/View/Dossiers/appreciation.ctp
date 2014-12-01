<style>
	
a.button {
    color: #000000;
    font: bold 12px Helvetica, Arial, sans-serif;
    text-decoration: none;
    padding: 7px 12px;
    position: relative;
    display: inline-block;
    text-shadow: 0 1px 0 #fff;
    -webkit-transition: border-color .218s;
    -moz-transition: border .218s;
    -o-transition: border-color .218s;
    transition: border-color .218s;
    background: #c5c5c5;
    background: -webkit-gradient(linear,0% 40%,0% 70%,from(#F5F5F5),to(#F1F1F1));
    background: -moz-linear-gradient(linear,0% 40%,0% 70%,from(#F5F5F5),to(#F1F1F1));
    border: solid 1px #dcdcdc;
    border-radius: 2px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    margin-right: 20px;
    cursor:pointer;
}
a.button:hover{
    color: #333;
    border-color: #999;
    -moz-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.2); 
-webkit-box-shadow:0 2px 5px rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
}
a.button:active {
    color: #000;
    border-color: #444;
}
	
</style>



<?php
 $this->layout = 'login2';
  echo $this->Form->create('Appreciation',array('type' => 'file')); 
  ?>
  
  
  <center>
  
  <?php
  if($valid==1){
  	
  	 if($type=="appreciation_scientifique")
    { 
   
    $inputform= $this->Form->input('lettre',array('label'=>'','name'=>'inputfile'.$attid, 'type' => 'file'));
    $typemsg="scientifique";
    }
    else
       if($type=="appreciation_non_scientifique")
          {
            $inputform = $this->Form->input('lettre',array('label'=>'','name'=>'inputfile'.$attid, 'type' => 'file')); 
           	$typemsg="non scientifique";
          }
    else
    {
       echo "erreur";
            exit;
    }
  	
  	
  	 echo 'La lettre d\'appr&eacute;ciation remplie par un professeur d\'une mati&egravere '.$typemsg.'  pour l\'&eacute;tudiant '.$prenom.' '.$nom.' : ';
 
  ?>
  
  <table cellspacing="30px" align="center">
  	<tr align="center">
  		<td colspan="2" align="center">Vous pouvez:
	</td>
  	</tr>
  	<tr>
  		<td>
  		1-La t&eacute;l&eacute;verser:
  		</td>
  		<td><?php
  			echo '2-La remplir manuellement : ';
  
		?>  
  		</td>
  	</tr>
  	<tr align="center">
  		<td>		
  		<?php
  			 echo $this->Form->input('lettre',array('label'=>'', 'type' => 'file')); 		
  		?>
  		</td>
  		<td>
  			<?php echo $this->Html->link('Saisie manuelle', array('controller' => 'dossiers', 'action' => 'appreciationManuelle/'.$code), array('escape'=>false,'class'=>'button'));  ?>
  		</td>
  	</tr>
  	<tr align="center">
  		<td>
  			<?php  echo $this->Form->end(array('label'=>'Sauvegarder','style'=>'background-color: #99AABB;color:"white";height:"20px";margin-top:"5px";margin-bottom:"5px";width:"180px";')); ?>
  		</td>
  		<td>
  			
  			
  		</td>
  	</tr>
  	
  	
  	
  </table>
  
 <?php
  
  }
  else{
  	if($succes)
  		echo '<h3><center>La lettre d\'appr&eacute;ciation a &eacute;t&eacute; sauvgard&eacute;e avec succ&egrave;s.</center></h3>';
  	else
  		echo '<h3><center>D&eacute;sol&eacute;! Vous ne pouvez plus attacher une lettre d\'appr&eacute;ciation.</center></h3>';
  }

	

?>
</center>
