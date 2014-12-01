


<?php
 $this->layout = 'login';
?>
<?php echo $this->Form->create('User'); ?>

<table width="500" border="0" cellspacing="1" cellpadding="5" align="center" bgcolor="#663366" style="border-collapse:'collapse';">
	
			<tr bgcolor="#996699"> 
			  <td colspan="2" align="center" class="titresection">
			  <strong>S'inscrire</strong>
			  </td>
			</tr>
			<tr bgcolor="#CCCCCC" class="textenormal"> 
			  
			  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">Username:</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('username',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>

<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">Mot de passe :</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('password',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>


<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">Retapper mot de passe:</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('passwordconfirm',array('label'=>'','type'=>'password','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>

<!--<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">Nom:</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('firstname',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>
<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">Prénom:</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('lastname',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>-->
<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">Numero de téléphone:</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('phone',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>
<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="35%"><div align="right"><b>
			  <font color="#0D3246">E-mail:</font></b></div></td>
			  <td width="65%">
			  <?php  echo $this->Form->input('email',array('label'=>'','size'=>'40','class'=>'textenormal'));?>
			  </td>
			</tr>


			<tr bgcolor="#F1F1E4"> 
			  <td colspan="2" align="center" class="textenormal" valign="middle"> 
			<?php	echo $this->Form->end(array('label'=>'S\'inscrire','style'=>'background-color: #99AABB;color:"white";height:"20px";margin-top:"5px";margin-bottom:"5px";width:"180px";')); ?>
			</tr>
			</table>
		<br>
		
      </td></tr></table>      
  <script type="text/javascript">
  
  
  $(document).ready(function()
  { 
   $('body').append('<div id="ajaxBusy"><p><img src="<?php echo $this->Html->url( '/', true ).''; ?>img/loading.gif"></p></div>');
   $('#ajaxBusy').css({
    display:"none",
    margin:"0px",
    paddingLeft:"0px",
    paddingRight:"0px",
    paddingTop:"0px",
    paddingBottom:"0px",
    position:"absolute",
    right:"3px",
    top:"3px",
     width:"auto"
  });
    
});
 	
	
$('form').submit(function()
{
    if ($("#UserPasswordconfirm").val()!=$("#UserPassword").val())
    { 
        alert("Passwords does not match!");
        return false; 
    }
$('#ajaxBusy').show();
});
	
  </script>


