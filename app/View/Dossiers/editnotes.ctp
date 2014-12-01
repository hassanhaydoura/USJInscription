   <style>
  	.th1{
		border-color: #009cd3;
		border-style: solid;
		text-align: center;
		font-family: Times New Roman;
		font-weight: bold;
		height: 40px;
		
	}
	.tdmat{
		
		border-color: #009cd3;
		border-style: solid;
		text-align: left;
		font-family: Times New Roman;
		font-weight: bold;
		height: 40px;
		
		
	}
	.tdvalue{
		border-color: #009cd3;
		border-style: solid;
		text-align: center;
		font-family: Times New Roman;
		font-weight: bold;
		font-size: 22;
		height: 40px;
	}
	
	.tdappleft{
		border-color: #009cd3;
		border-style: solid;
		text-align: left;
		font-family: Times New Roman;
		font-weight: bold;
		padding-left: 10;
	}
	.tabfin{
		text-align: left;
		font-family: Times New Roman;
		font-weight: italic;
		padding-left: 10;
		margin-left: 30;
		margin-right: 30;
		color: #009cd3; 
		border: 0
	}
	.font18{
		font-family: Times New Roman;
		font-size:18;
	}
	.font22{
		font-family: Times New Roman;
		font-size:22;
	}
	.font18bold{
		font-family: Times New Roman;
		font-size:18;
		font-weight: bold;
	}
	
	.font25bold{
		font-family: Times New Roman;
		font-size:25;
		font-weight: bold;
	}
	
	.font32{
		font-family: Times New Roman;
		font-size:32;
	}
	.textarea18{
		font-family: Times New Roman;
		font-size:18;
	}
	.value{
		font-size: 18;
		font-style: normal;
		font-weight: normal;
		color: #000000;
		border: 0px  none;
		word-spacing: normal;
		letter-spacing: normal;
		text-align: center;
	}
	
	.value1{
		font-size: 18;
		font-style: normal;
		font-weight: normal;
		color: #000000;
		word-spacing: normal;
		letter-spacing: normal;
		text-align: center;
		margin-left: 15;
	}
	.value2{
		font-size: 18;
		font-style: normal;
		font-weight: normal;
		border-color: #009cd3;
		border-style: solid;
		border-collapse: collapse;
		color: #000000;
		word-spacing: normal;
		letter-spacing: normal;
		text-align: center;
	}
	
	.tab{
		border-color: #009cd3;
		border-collapse: collapse;
		border-style: solid;
		font-size: 17;
		color: #009cd3; 
		table-layout: fixed;
		width:250px;

	}
  </style> 
  <div style="margin: 30;color: #009cd3"> 
<?php
 $this->layout = 'login2';
echo $this->Form->create('Note');
if($valid==1){
	?>
	<span style="float: left" class="font25bold">NOM DE L’&Eacute;TABLISSEMENT:  &nbsp;&nbsp; </span>
	<span class="value1"><?php echo $etablissement ;?></span>	
	<br><br>
	<div align="right" class=font32><b>RÉCAPITULATIF DES NOTES</b></div>
  	<div align="right" class=font18>À remplir par l’établissement</div>
  	<br><br>
  	<span style="float: left;" class="font18"><b>Nom et pr&eacute;nom du (de la) candidat(e): &nbsp;&nbsp; </b></span>
  	<span class="value1"><?php echo $prenom.' '.$nom; ?></span>	
  	<br><br>
  	<center><span   class="font22" >(Notes sur vingt)</span></center>
	<br><br>
	
	<table width="100%" align="center" cellspacing="10">
		<tr>
	<?php
	$i=1;
	foreach($sections as $section){
	echo '<td>';	
?>

<table align="center" class="tab" border="2">
	
			<tr> 
			  <td class="th1" width="40%">Mati&egrave;re</td>
			  <td class="th1"  >
			  <?php echo $section['Section']['nom']  ?> 
			  </td>
			</tr>
			<?php
			
foreach($section['Attribut'] as $matiere){		
			
			echo '<tr >';  
			  echo '<td class="tdmat">';
			  echo $matiere['nom'].'</td>';
			  echo '<td class="tdvalue">';
			   echo $this->Form->input($matiere['id'],array('id'=>$i,'onblur'=> 'check('.$i.');','label'=>'','size'=>'10','class'=>'value'));
			   ++$i;
			  echo '</td></tr>';
		}
		?>
	
</table>
<br><br>

<?php
	echo '</td>';
	}
	echo '</tr></table>';
	?>
	<span style="float: left;margin-left: 70;font-style: italic;" class="font18" ><b>Date: &nbsp;&nbsp; </b></span>
  	<span style="float: left;" class="value1"><?php echo $date; ?></span>	
	<span style="float: right;margin-right: 70" ><?php echo $this->Form->input('sigCachet',array('label'=>'','size'=>'30','class'=>'value2')); ?></span>	
	<span style="float: right;font-style: italic;" class="font18" ><b>Signature et Cachet: &nbsp;&nbsp; </b></span>
  	
	
	<?php
 }
else{
	echo '<h3><center>D&eacute;sol&eacute;! Vous ne pouvez plus modifier les notes.</center></h3>';
}

?>
<br><br><br>
<div align="center"><?php if($valid==1)	 	echo $this->Form->end(array('label'=>'Sauvegarder','style'=>'background-color: #99AABB;color:"white";height:"20px";margin-top:"5px";margin-bottom:"5px";width:"180px";')); ?>	</div>

</div>
<script>
function check(id){
var textCheck = document.getElementById(id).value;
  if(isNaN(textCheck))
  {
  alert('Vous ne pouvez entrer que des nombres');
  document.getElementById(id).focus();
 
  }
  else{
  var valeur= parseFloat(textCheck);
  if(valeur>20||valeur<0){
alert('Valeur doit être entre 0 et 20');
document.getElementById(id).focus();
}
  }
}
 
 
 
$('form').submit(function(event)
{ var $complete=1;
event.preventDefault();
  $(".value").each(function(){
if($(this).val()==""){
$(this).css({
        "box-shadow": " 0 0 4px #F00"});
              $complete=0;
}
else{
$(this).css({
        "box-shadow": " 0 0 0 #F00"});
}
});
if($complete==1)
{
 this.submit();
}
});

 
</script>



