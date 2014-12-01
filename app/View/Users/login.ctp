<?php
 $this->layout = 'login2';

?>

                <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
                <tr valign="top">	
                  <td valign="top">


  
  <p align="center" class="bordeau" style="font-size:'10pt';">Ce portail vous permet de remplir un dossier pour l'USJ.	</p>
<?php	echo $this->Form->create('User', array('action' => 'login')); ?>
		<table width="500" border="0" cellspacing="1" cellpadding="5" align="center" bgcolor="#000033" style="border-collapse:'collapse';">
		<tr bgcolor="#996699"> 
		  <td colspan="2" align="center" bgcolor="#003366" class="titresection"><strong>Identification 
			obligatoire </strong></td>
		</tr>
		<tr bgcolor="#CCCCCC" class="textenormal"> 
		  <td width="31%"><div align="right"><b><font color="#0D3246">Nom du compte :</font></b></div></td>
		  <td width="69%">
		  		<?php echo $this->Form->input('username',array('label'=>'','class'=>'textenormal','size'=>'40')); ?>
		  		
		  </td>
		</tr>
		<tr bgcolor="#CCCCCC" class="verbl10"> 
		  <td width="31%" class="textenormal"><div align="right"><b><font color="#0D3246">Mot de passe :</font></b></div></td>
		  <td width="69%">		  		<?php echo $this->Form->input('password',array('label'=>'','placeholder'=>'','class'=>'textenormal','size'=>'40')); ?>
</td>
		</tr>
		<tr bgcolor="#F1F1E4"> 
		  <td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="textenormal"> 
		<?php	echo $this->Form->end(array('label'=>'Se connecter','style'=>'background-color: #99AABB;color:"white";height:"20px";margin-top:"5px";margin-bottom:"5px";width:"180px";')); ?>
						<?php echo $this->Session->flash(); ?>
						   <?php echo $this->Html->link(__('S\'enregistrer'), array('controller' => 'users', 'action' => 'register')); ?>
		</td>
		</tr>
		</table>
		<br>
		
      </td></tr></table>        
      
