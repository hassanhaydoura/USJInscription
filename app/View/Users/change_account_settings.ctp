<?php
	 $this->layout = 'login';
	echo $this->Form->create('User');	
?>
 <script type="text/javascript">
  	
	
$('#UserChangeAccountSettingsForm').submit(function()
{
    if ($("#UserNew").val()!=$("#UserConfirm").val())
    { 
        alert("Le mot de passe n'est pas confirmé correctement!");
        return false; 
    }

});
	
  </script>

<table width="500" border="0" cellspacing="1" cellpadding="5" align="center" bgcolor="#663366" style="border-collapse:'collapse';">
	
			<tr bgcolor="#996699"> 
			  <td colspan="2" align="center" class="titresection">
			  <strong>Modification</strong>
			  </td>
			</tr>
			<tr bgcolor="#CCCCCC" class="textenormal"> 
			  
			  <td width="40%"><div align="right"><b>
			  <font color="#0D3246">Nouveau mail:</font></b></div></td>
			  <td width="60%">
			  <?php  echo $this->Form->input('mail',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>

<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="40%"><div align="right"><b>
			  <font color="#0D3246">Ancien  mot de passe:</font></b></div></td>
			  <td width="60%">
			  <?php  echo $this->Form->input('old',array('label'=>'','type'=>'password','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>
<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="40%"><div align="right"><b>
			  <font color="#0D3246">Nouveau mot de passe:</font></b></div></td>
			  <td width="60%">
			  <?php  echo $this->Form->input('new',array('label'=>'','type'=>'password','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>
<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="40%"><div align="right"><b>
			  <font color="#0D3246">Confirmer votre mot de passe:</font></b></div></td>
			  <td width="60%">
			  <?php  echo $this->Form->input('confirm',array('label'=>'','type'=>'password','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>

			<tr bgcolor="#F1F1E4"> 
			  <td colspan="2" align="center" class="textenormal" valign="middle"> 
			<?php	echo $this->Form->end(array('label'=>'Sauvegarder','style'=>'background-color: #99AABB;color:"white";height:"20px";margin-top:"5px";margin-bottom:"5px";width:"180px";')); ?>
			</tr>
			</table>
		<br>
		
      </td></tr></table>     

