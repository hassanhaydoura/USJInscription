  		<?php
  		
$list_atts=array();
  		foreach($attSc as $att)
  	 {
  	   if($att['Attribut']['type']=='liste')
  	{   
    	array_push($list_atts,$att);
      }
         if($att['Attribut']['type']=='textarea')
  	{ 
  	  if(!isset($text_area_atts))
  	   $text_area_atts=array();
			array_push($text_area_atts,$att) ;
    }
    
            if($att['Attribut']['type']=='string' || $att['Attribut']['type']=='date' || $att['Attribut']['type']=='static')
  	{
  	if($att['Attribut']['type']=='static' && $att['Attribut']['nom']=='Nom et prénom du (de la) candidat(e)')
  	   {
  	      $nom_prenom_att = $att;
  	   }
  	 else if($att['Attribut']['type']=='static' && $att['Attribut']['nom']=='Date de naissance')
  	 {
  	  $date_de_naissance['Attribut']['valeur']="26/1/1992";
  	 } 
  	   else
  	   {
  	  if(!isset($string_atts))
  	   $string_atts=array();
			array_push($string_atts,$att) ;
			}
    }
    
    
}  		

?>
<?php
 $this->layout = 'login2';
  echo $this->Form->create('Appreciation'); 
  
  ?>

  <style>
  	.tdapp{
		border-color: #009cd3;
		border-style: solid;
		text-align: center;
		font-family: Times New Roman;
		font-weight: bold;
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
	.font18bold{
		font-family: Times New Roman;
		font-size:18;
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
	
	.tab{
		border-color: #009cd3;
		border-collapse: collapse;
		border-style: solid;
		font-size: 17;
		color: #009cd3; 
		align: left;
		width: 100%;

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
  </style>  
  <div style="margin: 30;color: #15a0f4; ">
  
  
  	<div align="right" class=font32><b>LETTRE D'APPRÉCIATION CONFIDENTIELLE</b></div>
  	<div align="right" class=font18>&Agrave; remplir par un professeur d'une <b>mati&egrave;re <?php echo $type ?></b> de la classe terminale</div>
  	<br><br><br>
  	 <div style="margin-left: 30">
  <?php if(isset($nom_prenom_att['Attribut']['valeur']))
  { ?>
  	<span style="float: left;" class="font18"><b>Nom et pr&eacute;nom du (de la) candidat(e): &nbsp;&nbsp; </b></span>
  	<span class="value1"><?php echo $nom_prenom_att['Attribut']['valeur'] ?></span>	
  	<?php 
  	} 
  	?> 	
  	  <?php if(isset($date_de_naissance['Attribut']['valeur']))
  { ?>
  	<br><br>
  	<span style="float: left;" class="font18"><b>Date de naissance: &nbsp;&nbsp; </b></span>
  	<span class="value1"><?php echo $date_de_naissance['Attribut']['valeur'] ?></span>	
  	<?php 
  	} 
  	?> 	
  	<br><br>
  	<span style="float: left" class="font18"><i>Le Jury d'admission appr&eacute;cie votre &eacute;valuation du (de la) candidat (e) et vous prie de remplir le tableau suivant.</i></span>
  	<br><br>
  	<span style="float: left;" class="font18">Quel serait, selon vous, le classement du (de la) candidat (e) dans un groupe de 100 &eacute;tudiants de même niveau ?</span>
  	</div>
  	<br><br><br>
  	<table class="tab" border="2">
  		<tr>
  			<td class="tdapp" rowspan="2">Appr&eacute;ciation</td>
  			<td class="tdapp">10 premiers</td>	
  			<td class="tdapp">15 premiers</td>	
  			<td class="tdapp">25 premiers</td>	
  			<td class="tdapp">35 premiers</td>	
  			<td class="tdapp">50 premiers</td>	
  			<td class="tdapp"></td>	
  		</tr>
  		<tr>
  			<td class="tdapp">Exellent</td>	
  			<td class="tdapp">Tr&egrave;s bon</td>	
  			<td class="tdapp">Bon</td>	
  			<td class="tdapp">Assez bon</td>	
  			<td class="tdapp">Passable</td>	
  			<td class="tdapp">Mauvais</td>	
  		</tr>

<?php
  		           
  		foreach($list_atts as $att)
  	 {
  	 $listatt= array();
        		
  		foreach($att['Listattribut'] as $attribut)
          					{ 
          						$listatt[$attribut['id']] = '';
    					     }           	
		echo '<tr>';
		echo '<td class="tdappleft">'.$att['Attribut']['nom'].'</td>';
		echo '<td class="tdapp">';
		$options =  array('type'=>'radio','options'=>$listatt, 'label'=>'', 'separator' => '</td><td class="tdapp">','legend'=>'');
    	echo	$this->Form->input('attribut'.$att['Attribut']['id'],$options);
  echo '</td>';

			echo '</tr>';    
}

  		  ?>

  	</table>
  	<br><br>
  	<?php 
  	if(isset($text_area_atts))
  	foreach($text_area_atts as $text_area_att)
  	 {
  	  echo '<div align="center" class="font18bold">'.$text_area_att['Attribut']['nom'].'</div>';
  		
  		$options =  array('div'=>array('align'=>"center"),'label'=>'','type' => 'textarea','cols'=>"100", 'rows'=>"10" ,'class'=>"textarea18");
  	   echo $this->Form->input('text'.$text_area_att['Attribut']['id'],$options);
//   	 <div align="center" class="font18bold">Appr&eacute;ciation personnelle</div>
//   	 <br>
//   	 <div align="center"><textarea  cols="100" rows="10" class="textarea18" name="data[Appreciation][textarea]"></textarea></div>
//   	 <br>
  	}
  	?>
  	<table class="tabfin" >
<?php
  	if(isset($string_atts))
  {	 
    $idx=0;
  	foreach($string_atts as $string_att)
  	 {
  	  if($idx %2 ==0)
  	   echo "<tr>";
  	  echo "<td  style='padding-left: 20' class='font18'><i>".$string_att['Attribut']['nom'].":</i></td>";
  	  $options =  array('label'=>'','type' => 'text' ,'size'=>'30');
  	    	  if($string_att['Attribut']['type']=='date')
       	   	$options['class']='date';
  	  echo '<td class="value1">';
  	  if($string_att['Attribut']['type']=='static')
  	      echo $string_att['Attribut']['valeur']; 
  	  else
  	  echo $this->Form->input('attribut'.$string_att['Attribut']['id'],$options);
  	  echo "</td>";
  	 if($idx %2 ==1)
  	   echo "</tr>";
  	  ++$idx;
     }
  }  
  	?>
  	</table>

  </div>
  <div align="center"><?php
 	echo $this->Form->end(array('label'=>'Sauvegarder','style'=>'background-color: #99AABB;color:"white";height:"20px";margin-top:"5px";margin-bottom:"5px";width:"180px";'));
?>

	</div>
<script>
 $(function() {
    $( ".date" ).datepicker({
     yearRange: "2000:2020",
      changeMonth: true,
      changeYear: true
    });
  });
  </script>

