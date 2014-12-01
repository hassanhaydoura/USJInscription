<style>
.form table {
	border-right:0;
	clear: both;
	color: #333;
	margin-bottom: 10px;
	width: 100%;
}
.form th {
	border:0;
	border-bottom:2px solid #555;
	padding:4px;
}

.form table tr td {
	padding: 6px;
	vertical-align: top;
	border-bottom:1px solid #ddd;
}
.form  table tr:nth-child(even) {
	background: #f9f9f9;
}

.formationtab{
border-bottom-color: rgb(128, 128, 128);
border-collapse: separate;
border-left-color: rgb(128, 128, 128);
border-right-color: rgb(128, 128, 128);
border-top-color: rgb(128, 128, 128);
color: rgb(0, 0, 0);
display: table-row-group;
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 16px;
font-style: normal;
font-variant: normal;
font-weight: normal;
height: 20px;
line-height: normal;
text-align: start;
vertical-align: middle;
white-space: normal;
width: 100%;
}
.textepetit {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 10px;
font-style: normal;
font-weight: normal;
color: #000000;
}

</style>
 

<?php
 $this->layout = 'login';
?>
<div class="users form"><!--dossiers form ??? -->
 <span style="margin-left:50%;">
 <?php echo $this->Html->link(__('Generer PDF'), array('controller' => 'Dossiers', 'action' => 'pdf3'), array('target'=>'_blank','escape'=>false)); ?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link(__('Generer PDF'), array('controller' => 'Dossiers', 'action' => 'pdf'), array('target'=>'_blank','escape'=>false)); ?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link(__('Generer PDF'), array('controller' => 'Dossiers', 'action' => 'pdf2'), array('target'=>'_blank','escape'=>false)); ?>
&nbsp;&nbsp;&nbsp;
<?php echo $this->Html->link(__('Modifier'), array('controller' => 'Dossiers', 'action' => 'blancform'));  ?>
&nbsp;&nbsp;&nbsp;
</span>
<table border="0" cellspacing="1" cellpadding="1" align="left" width="100%" style="border-collapse:'collapse';">
					
					
	<?php

	foreach ($sections as $section) 
	{
	
	       echo '
	       <tr><td colspan="4" style="font-size:"1pt";">&nbsp;</td>
			</tr>
			 <tr>
					<td class="bg1" colspan="4"><b>'.$section['Section']['nom'].'</b></td>
			</tr>
			</tr>
			<tr><td colspan="4" style="font-size:"1pt";">&nbsp;</td>
			</tr>';
	 
	  usort($section['Attribut'], function($a, $b)
	   {        
        	return $a['ordre'] > $b['ordre'] ? 1 : -1;
    });
	
	
	  if($section['Section']['nom'] =='ÉTABLISSEMENTS SCOLAIRES DES ANNÉES SECONDAIRES')
	     {
	     foreach($formationsecs as $formationsec)
	  	{
	  	
	  	 	echo '<span>';
	  	 	$formationid = $formationsec['Formationsecondaire']['id'];
	  	 	$key=0;
	  	 	foreach($formationsecdejaexist as $idx=>$formation)
	  	 	{
	  	 	  if ($formation['Dossierformationsec']['formationsecondaire_id']==$formationid)
	  	 	  {
	  	 	   $key=$idx;
	  	 	    break;
	  	 	  }
	  	 	  
	  	 	}
	
	$ecolnom = isset($formationsecdejaexist[$key]['Ecolessecondaire']['nom']) ? $formationsecdejaexist[$key]['Ecolessecondaire']['nom']:'' ;
	$ecoladress= isset($formationsecdejaexist[$key]['Ecolessecondaire']['adresse'])? $formationsecdejaexist[$key]['Ecolessecondaire']['adresse'] : '';
            
        echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'. $formationsec['Formationsecondaire']['nom'].'</span></td>';
			echo   '<th class="th_r" colspan="2"  align="left"><span class="spaced_span">'.$ecolnom.'</span></th>';
			echo '<td/></tr>';
           echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'. $formationsec['Formationsecondaire']['nom'].' Adresse'.'</span></td>';
			echo   '<th class="th_r" colspan="2"  align="left"><span class="spaced_span">'.$ecoladress.'</span></th>';
			echo '<td/></td></tr>';   
	     }
	    }
	    
	  
	 foreach ($section['Attribut'] as $att)
		{	
		 
		 	if($att['pardefault']=='0')
		 	   break;
		  switch ($att['type'])
		{
			
		 case "string":
		 		 $valeur="";
		 		 if(isset($this->request->data['attribut'.$att['id']]))
		 		 {
                    $valeur= $this->request->data["attribut".$att["id"]];
                }
			if(!$att['rtl'])
			{
			echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo   '<th class="th_r" colspan="2"  align="left"><span class="spaced_span">'.$valeur.'</span></th>';
			echo '<td/.</tr>';
			}
			else
			{
			echo	'<tr><td/>';
			echo   '<th class="th_r" colspan="2"  align="right" style="direction:rtl"   ><span class="spaced_span">'.$valeur.'</span></th>';
			echo	'<td class="td_r"  style="direction:rtl" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo '</tr>';
			}
	// 		echo $att['nom'].'<br>';
// 			echo $this->request->data['attribut'.$att['id']].'<br>';
			
			
		 break;
		
		 case "date":
		 
		  $valeur="";
		 		 if(isset($this->request->data['attribut'.$att['id']]))
		 		 {
                    $valeur= $this->request->data["attribut".$att["id"]];
                }

			echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo   '<th class="th_r" colspan="2"  align="left"><span class="spaced_span">'.$valeur.'</span></th>';
			echo '<td/></tr>';
				

         break;
        
        case "liste":
       
        // $listatt= array();
//   
//   				  foreach($att['Listattribut'] as $attribut)
//           					{ 
//           						$listatt[$attribut['id']] = $attribut['valeur'];
//     					     }         
// 
//         $options =  array('options'=>$listatt, 'label'=>$att['nom']);
//         
//           if(!$att['obligatoire'])
//                $options['empty']='aucun';
//         
//         echo $this->Form->input('attribut'.$att['id'],$options);
  //  $this->loadModel('Listattribut');
   // $d=$this->Listattribut->find('all');
   // print_r($d);
  //  $unmsg =  $this->requestAction('Listattributs/valeurbyid/')
    $valeur="";
		 		 if(isset($this->request->data['attribut'.$att['id']]))
		 		 {
                    $valeur= $this->request->data["attribut".$att["id"]];
                }
         	echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att['nom'].'</span></td>';
			echo   '<th class="th_r" colspan="2"  align="left"><span class="spaced_span">'.$valeur.'</span></th>';
			echo '</td><td/></tr>';
       
        break;
		
		case "file":
 			echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att['nom'].'</span></td>';
			echo   '<th class="th_r" colspan="2"  align="left"><span class="spaced_span">'.'<input type="checkbox" />'.'</span></th>';
			echo '</td><td/></tr>';
       
				break;
		break;
			}
		}
	}
		
	?>

	
	
			</table>
	
<h3 > Liste des cursus choisis par ordre </h3>

<ol style="border:solid black 2px;width:80%;">

<?php 

	  usort($formationdejaexist, function($a, $b)
	   {        
        	return $a['Dossierformation']['priorite'] > $b['Dossierformation']['priorite'] ? 1 : -1;
    });

		foreach ($formationdejaexist as $formation) 
  			{ ?>
  				<li class="ui-state-default choisi" style="" id="formation<?php echo $formation['Formation']['id'] ?>">
  			   <span><?php echo $formation['Formation']['Institution']['nom'] ?> </span>  <span style="marign-left:15px" class="numero petittext"><?php /*echo "(".$formation['Dossierformation']['priorite'].")";*/ ?></span>
  			   <table class="formationtab">
    		 <tr bgcolor="#F7F7F7">
			    <td height="20" colspan="2" bgcolor="#D8E0E7" class="textepetit">
				<img style="width: 20px;height: 30px;" src="http://www.usj.edu.lb/logos/100/esib.jpg"><span>	<?php echo $formation['Formation']['nom'] ?></span> <span class="textepetit" bgcolor="#F7F7F7" width="18%"><?php echo $this->Html->link('Plus de détails', "http://".$formation['Formation']['url'], null); ?> </span>	
			</td>
			</tr>
 			 </table>
			  </li>
  		<?php	}  ?>
</ol>


<br style="clear:both">
	</div>
<br>
		
      </td></tr>
      </table>       
  
