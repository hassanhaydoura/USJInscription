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

	.tab{
		border-color: #009cd3;
		border-collapse: collapse;
		border-style: solid;
		font-size: 17;
		color: #009cd3; 
		table-layout: fixed;

	}
  </style> 
<?php
 $this->layout = 'login2';
?>
<br><br>
<div class="notes form" ><!--dossiers form ??? -->

<table width="100%" align="center" >
		<tr>
	<?php
	
	foreach($sections as $section){
	echo '<td style="padding:30;">';	
?>

<table width="100%" align="center" class="tab" border="2">
	
			<tr> 
			  <td class="th1" width="40%">Mati&egrave;re</td>
			  <td class="th1" >
			  <?php echo $section['nom']  ?> 
			  </td>
			</tr>
	
<?php foreach($section['notes'] as $matiere=>$valeur){	
			
			echo '<tr >';  
			  echo '<td class="tdmat">';
			  echo $matiere.'</td>';
			  echo '<td class="tdvalue">';
			   echo $valeur;
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

</div>   
  
