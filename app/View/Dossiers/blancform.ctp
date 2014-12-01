<script>
$(function() {
var tabs  =$( "#tabs" ).tabs({
collapsible: false
});
//  tabs.find( ".ui-tabs-nav" ).sortable({
//       axis: "xy",
//       stop: function() {
//         tabs.tabs( "refresh" );
//       }
//     });
});
</script>


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
.error
{
color:red;
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

input[type=text] {
clear: both;
font-size: 100%;
font-family: "frutiger linotype", "lucida grande", "verdana", sans-serif;
padding: 1%;
width: 98%;
}


</style>
 
<?php
 $this->layout = 'login';
?>

<div class="users form">

<table border="0" >
	<tr>
	 <td align="left" >(*) requis pour validation</td>
<?php
if(!$edit){
	if($isAdmin){
	
echo '<td width="30px">'.$this->Form->postLink($this->Html->image('ChangePassword.png',array('width'=>'30px','height'=>'30px','title'=>'Régénérer un mot de passe')), array('controller' => 'users', 'action' => 'changePassword/'.h($dossier['Dossier']['id'])),array('escape'=>false),'Etes vous sures?').'</td>';
	
	 echo '<td width="30px">'.$this->Html->link($this->Html->image('pdf.jpg',array('width'=>'30px','height'=>'30px','title'=>'Générer PDF')), array('controller' => 'dossiers', 'action' => 'dossierpdf','?'=>array('dossierid'=>$dossierid)), array('target'=>'_blank','escape'=>false)).'</td>'; 
	}
}
?>
<?php  if($edit){
 echo '<td width="30px">'.$this->Html->link($this->Html->image('annuler.png',array('width'=>'30px','height'=>'30px','title'=>'Annuler')), array('controller' => 'dossiers', 'action' => 'blancform','?'=>array('dossierid'=>$dossierid)), array('escape'=>false)).'</td>';
  } else
  {
   $urlquery = array('dossierid'=>$dossierid,'edit'=>'1');
   if(isset($missing))
     $urlquery['valider']=$userid;
   echo '<td width="30px">'.$this->Html->link($this->Html->image('edit.png',array('width'=>'30px','height'=>'30px','title'=>'Editer')), array('controller' => 'dossiers', 'action' => 'blancform','?'=>$urlquery), array('escape'=>false)).'</td>';  
  }
   ?>
<?php
if(!$edit){
if(!$dossier['Dossier']['valide'])
echo '<td width="30px">'.$this->Html->link($this->Html->image('valider.jpg',array('id'=>'validatebtn','class'=>'estvalide','width'=>'30px','height'=>'30px','title'=>'Soumettre et valider')), '#',array('escape'=>false),NULL).'</td>';
else
echo '<td width="30px">'.$this->Html->link($this->Html->image('download-icon.png',array('id'=>'validatebtn','width'=>'30px','height'=>'30px','title'=>'Télécharger votre dossier')), '#',array('escape'=>false)).'</td>';
}
?>

	</tr>
</table>

<?php  if($edit)  echo $this->Form->create('Dossier',array('type' => 'file')); ?>
<? if($edit){ ?>
<input type="hidden" name="redirectionpage" value="blancform" />
<?php }?>

<div id="tabs">

<?php 
	echo '<ul>';
	foreach ($gsections as $gsection) 
	{
		echo '<li><a href="#tabs-'.$gsection['Sectiongroup']['ordre'].'">'.$gsection['Sectiongroup']['nom'].'</a></li>';	
		
		
	}
	echo '</ul>';
	

?>


<?php

 $forms=array();//upload files with separate forms
	foreach ($gsections as $gsection) 
	{
			 echo '<div id="tabs-'.$gsection['Sectiongroup']['ordre'].'">';
	echo		'<table border="0" cellspacing="1" cellpadding="1" align="left" width="100%" style="border-collapse:\'collapse\';">';

	   echo '<tr><td colspan="4" style="font-size:"1pt";">&nbsp;</td>
			</tr>
			 <tr>
			 <td class="bg1" colspan="4"><b>'.$gsection['Sectiongroup']['nom'].'</b></td>
			</tr>
			<tr><td colspan="4" style="font-size:"1pt";">&nbsp;</td>
			</tr>';
	 
	$sections=$gsection['Section'];		
			
	foreach ($sections as $section) 
	{
	
		   echo '<tr><td colspan="4" style="font-size:"1pt";">&nbsp;</td>
			</tr>
			 <tr>
			 <td class="bg1"  colspan="4"><b>'.$section['nom'].'</b></td>
			</tr>';	
	  usort($section['Attribut'], function($a, $b)
	   {        
        	return $a['ordre'] > $b['ordre'] ? 1 : -1;
    });
	
	
// 	  if($section['nom'] =='ÉTABLISSEMENTS SCOLAIRES DES ANNÉES SECONDAIRES')
// 	     {
// 
// 	     foreach($formationsecs as $formationsec)
// 	  	{
// 	  	 	$formationid = $formationsec['Formationsecondaire']['id'];
// 	  	 	$key=NULL;
// 	  	 	foreach($formationsecdejaexist as $idx=>$formation)
// 	  	 	{  
// 	  	 	  if ($formation['Dossierformationsec']['formationsecondaire_id']==$formationid)
// 	  	 	  {
// 	  	 	   $key=$idx;
// 	  	 	    break;
// 	  	 	  }
// 	  	 	  
// 	  	 }
// 	$ecolnom = isset($formationsecdejaexist[$key]['Ecolessecondaire']['nom']) ? $formationsecdejaexist[$key]['Ecolessecondaire']['nom']:'' ;
// 	$ecoladress= isset($formationsecdejaexist[$key]['Ecolessecondaire']['adresse'])? $formationsecdejaexist[$key]['Ecolessecondaire']['adresse'] : '';
//           
//           
//            $fontred="";
//            if(isset($missing))
//             { 
//              if(isset($missing['Formationsecondaire'][$formationid]))
//     		 $fontred="fontred";
//     		}
//         echo  "<tr><td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>".$formationsec['Formationsecondaire']['nom'].'</span></td>';
// 
// 		if ($edit)	
// 			echo   "<th class='th_r' width='200' align='left'><span class='spaced_span'>".$this->Form->input('formationsececolnom'.$formationid, array('label'=> '' ,'default' => $ecolnom,
//             'class' => 'schooltxt',
//             'autocomplete' => 'off')).'</span></th>';
// 		else
// 		  echo  '<th class="th_r" width="200" align="left"><span class="spaced_span">'.$ecolnom.'</span></th>';
// 		
// 		 echo "<td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>". $formationsec['Formationsecondaire']['nom'].' Adresse'.'</span></td>';
// 			
// 		if($edit)
// 			echo  '<th class="th_r" width="200" align="left" ><span class="spaced_span">'.$this->Form->input('formationsecadress'.$formationid, array('type'=>'text','label'=>'','class'=>'ecole-adresse-input','default' => $ecoladress)).'</span></th>';
// 			else
// 			 echo '<th class="th_r" width="200" align="left" ><span class="spaced_span">'.$ecoladress.'</span></th>';
// 			echo '</tr>'; 
// 	
// 	      }
// 	   }
	 foreach ($section['Attribut'] as $att)
		{	
		 
		 	if($att['pardefault']=='0')
		 	   break;
		  switch ($att['type'])
		{
			
		 case "string":
		$options =  array('label'=>'','type' => 'text');
	
// 		   if($att['obligatoire'])
//                 array_push($options,'');
                 if($att['obligatoire'])
            $att["nom"]=$att["nom"]."*";    
             
            $fontred="";
           if(isset($missing))
            { 
             if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
             
                
			if(!$att['rtl'])
			{
			echo	"<tr><td class='td_r'  align='left' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
		if($edit)
			echo   '<th class="th_r" width="200" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'], $options ).'</span></th>';
		else
			echo   '<th class="th_r" width="200" align="left" colspan="2"><span class="spaced_span">'.(isset($this->request->data['Dossier']['attribut'.$att['id']])?$this->request->data['Dossier']['attribut'.$att['id']]:"").'</span></th>';
			echo '<td/>';
			echo '</tr>';
			}
			else
			{
			echo	'<tr>';
			echo   '<td/>';
	  if($edit)
	      echo   '<th class="th_r" width="200" style="direction:rtl" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'], $options ).'</span></th>';
			else
		echo   '<th class="th_r" width="200" align="right" colspan="2"><span class="spaced_span">'.(isset($this->request->data['Dossier']['attribut'.$att['id']])?$this->request->data['Dossier']['attribut'.$att['id']]:"").'</span></th>';

			echo "<td class='td_r' style='direction:rtl' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
			echo '</tr>';
			}		
		 break;
		
		 case "date":
		 
		 $options = array('label'=>'' ,'class'=>'date','type' => 'text');
		   //if($att['obligatoire'])
             //   array_push($options,'required');
		       if($att['obligatoire'])
            $att["nom"]=$att["nom"]."*";
		$fontred="";
           if(isset($missing))
            { 
             if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
		  
		   	echo	"<tr><td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
		  
		if($edit)  
		    echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'],$options).'</span></th>';
		else
			echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.(isset($this->request->data['Dossier']['attribut'.$att['id']])?$this->request->data['Dossier']['attribut'.$att['id']]:"").'</span></th>';

			echo '</tr>';

         break;
        
        case "liste":
       
        $listatt= array();
         
         		$fontred="";
           if(isset($missing))
            { 
             if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
    		
  				  foreach($att['Listattribut'] as $attribut)
          					{ 
          						$listatt[$attribut['id']] = $attribut['valeur'];
    					     }         

        $options =  array('options'=>$listatt, 'label'=>'');
          //if(!$att['obligatoire'])
              $options['empty']='aucun';
           if($att['obligatoire'])
            $att["nom"]=$att["nom"]."*";
       	
       		echo	"<tr><td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
		 if($edit)
		   echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'],$options).'</span></th>';
		  else
			echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.(isset($this->request->data['Dossier']['attribut'.$att['id']])?$listatt[$this->request->data['Dossier']['attribut'.$att['id']]]:"").'</span></th>';

			echo '<td/></tr>';
       
        break;
		
		case "file":
		//	echo $this->Form->input('image',array('label'=> $att['nom'],  'type' => 'file'));
		    array_push($forms,$att["id"]);	
				$fontred="";
           if(isset($missing))
            { 
             if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
			echo  "<tr><td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
			if($edit)
			echo  '<th class="th_r" align="left" colspan="2"><span class="spaced_span"><a class="dropclick" id="dropclick'.$att['id'].'">Browse</a><ul id="ulfileliste'.$att['id'].'">';
			 else
			  	echo  '<th class="th_r" align="left" colspan="2"><span class="spaced_span"><ul id="ulfileliste'.$att['id'].'">';




$finfo = finfo_open(FILEINFO_MIME_TYPE);
	      foreach($fichiers as $fichier)
			   {
			     if($fichier['Fichier']['attribut_id']==$att["id"]){
			    
			     $filetype=finfo_file($finfo, "files/{$dossierid}/".$fichier['Fichier']['nom']);
			    $filetype = strstr($filetype, '/', true);
			    	if($edit){ 

			     if($filetype=="image")	
			     	echo '<li class="fichierli" id="fichier'.$fichier['Fichier']['id'].'"><span class="filename" style="padding-right:3em">
			     	<img height="100em" border="2px" src="'.$this->Html->url( '/', true ).'dossiers/attachments/'.$fichier['Fichier']['id'].'/1">
			     	 </a></span></li>';
				else
					echo '<li class="fichierli" id="fichier'.$fichier['Fichier']['id'].'"><span class="filename" style="padding-right:3em">'.$this->Html->link($fichier['Fichier']['nom'], array('controller' => 'dossiers', 'action' => 'attachments', $fichier['Fichier']['id']),array('target'=>'_blank')).'</a></span></li>';

			     	
			     	}
			     	else{
			       if($filetype=="image")	
			     		{
			     		echo '<li>'.$this->Html->link($fichier['Fichier']['nom'], array('controller' => 'dossiers', 'action' => 'attachments', $fichier['Fichier']['id']),array('target'=>'_blank'));
		    			echo '<img height="100em" border="2px" src="'.$this->Html->url( '/', true ).'dossiers/attachments/'.$fichier['Fichier']['id'].'/1">';
						echo '</li>';	
						}
					else
					  	echo '<li class="fichierli" id="fichier'.$fichier['Fichier']['id'].'"><span class="filename" style="padding-right:3em">'.$this->Html->link($fichier['Fichier']['nom'], array('controller' => 'dossiers', 'action' => 'attachments', $fichier['Fichier']['id']),array('target'=>'_blank')).'</a></span></li>';
								
					}
				 }
					
			   }
			   finfo_close($finfo);
			echo '</ul></span></th>';
			echo  '<td/></tr>';
		break;
				case "filenote":
			$options =  array('type'=>'checkbox','label'=>'Contacter l\'école');
		   
		    $fontred="";
		    if(isset($missing))
            { 
             if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
		//	echo $this->Form->input('image',array('label'=> $att['nom'],  'type' => 'file'));
		    array_push($forms,$att["id"]);	
			echo  "<tr><td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
			if($edit)
			   {
				 echo  '<th class="th_r" align="left" colspan="2"><span class="spaced_span"><a class="dropclick" id="dropclick'.$att['id'].'">Browse</a>'.$this->Form->input('contacterecol'.$att['id'],$options).'<ul id="ulfileliste'.$att['id'].'">';
			   }
			 else
			  	{
			  	echo  '<th class="th_r" align="left" colspan="2"><span class="spaced_span"><ul id="ulfileliste'.$att['id'].'">';
				
				 $contacter = isset($this->request->data['Dossier']['contacterecol'.$att['id']])?$this->request->data['Dossier']['contacterecol'.$att['id']]:"0";
				 if($contacter)
				   echo "<li>Contacter l'école</li>";
				}
			 foreach($fichiers as $fichier)
			   {
			     if($fichier['Fichier']['attribut_id']==$att["id"])
			      echo '<li class="fichierli" id="fichier'.$fichier['Fichier']['id'].'"><span class="filename" style="padding-right:3em">'.$this->Html->link($fichier['Fichier']['nom'], array('controller' => 'dossiers', 'action' => 'attachments', $fichier['Fichier']['id']),array('target'=>'_blank')).'</a></span></li>';
			   }
			echo '</ul></span></th>';
			echo  '<td/></tr>';
		break;
		
		
		
		 case "fileappreciation":
		$options =  array('label'=>'','type' => 'text');
	
// 		   if($att['obligatoire'])
//                 array_push($options,'');
        if($att['obligatoire'])
            $att["nom"]=$att["nom"]."*";    
             
            $fontred="";
           if(isset($missing))
            { 
             if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
                
			if(!$att['rtl'])
			{
			echo	"<tr><td class='td_r'  align='left' width='200'><span class='spaced_span {$fontred}'>".$att["nom"].'</span></td>';
		if($edit)
			echo   '<th class="th_r" width="200" align="left" colspan="2"><span class="spaced_span">'."Contacter l'école".'</span></th>';
		else
			echo   '<th class="th_r" width="200" align="left" colspan="2"><span class="spaced_span">'."Contacter l'école".'</span></th>';
			echo '<td/>';
			echo '</tr>';
			}
		 break;
		
		
	case "choixcursus":
		$fontred="";
           if(isset($missing))
            { 
			 if(isset($missing['Attribut'][$att['id']]))
    		 $fontred="fontred";
    		}
		
	echo '<tr><td colspan="4" style="font-size:"1pt";">'?>
		<div align="center"><i>Glisser et d&eacute;poser vos choix <br>de gauche &agrave; droite </i></div>
<div>
<h4 style="float: right;" class='<?php echo $fontred; ?>'  > Liste des cursus choisis par ordre de pr&eacute;f&eacute;rence* </h4>
	<h4 style="float:left"> Liste des cursus </h4>
	</div>
		 <ul class='<?php if($edit) echo 'sort' ?> ui-sortable' id="source" style="overflow: scroll; width: 200px; height: 100px;border:solid black 2px;width:45%;float:left;min-height:500px;">
     <?php 
		foreach ($formations as $formation) 
  			{  
  			 ?>
  				<li class="ui-state-default nonchoisi" style="" id="formation<?php echo $formation['Formation']['id'] ?>">
  			   <span><?php echo $formation['Formation']['nom'] ?> </span>  <span style="marign-left:15px" class="numero petittext"></span>
  			   <table class="formationtab">
    		 <tr bgcolor="#F7F7F7">
			    <td height="20" colspan="2" bgcolor="#D8E0E7" class="textepetit">
				<img style="width: 20px;height: 30px;" src="http://www.usj.edu.lb/logos/100/esib.jpg"><span>	<?php echo $formation['Institution']['nom'] ?></span> <span class="textepetit" bgcolor="#F7F7F7" width="18%"><?php echo $this->Html->link('Plus de détails', "http://".$formation['Formation']['url'], null); ?> </span>	
			</td>
			</tr>
 			 </table>
			  </li>
  		<?php	}  ?>
</ul>


<ol class='<?php if($edit) echo 'sort' ?>  ui-sortable' style="overflow: scroll; height: 100px;border:solid black 2px;float:right;width:44%;min-height:500px;">
<?php 

	  usort($formationdejaexist, function($a, $b)
	   {        
        	return $a['Dossierformation']['priorite'] > $b['Dossierformation']['priorite'] ? 1 : -1;
       });

		foreach ($formationdejaexist as $formation) 
  			{ ?>
  				<li class="ui-state-default choisi" style="" id="formation<?php echo $formation['Formation']['id'] ?>">
  			   <span> <?php echo $formation['Formation']['nom'] ?> </span>  <span style="marign-left:15px" class="numero petittext"><?php /*echo "(".$formation['Userformation']['priorite'].")";*/ ?> </span>
  			   <table class="formationtab">
    		 <tr bgcolor="#F7F7F7">
			    <td height="20" colspan="2" bgcolor="#D8E0E7" class="textepetit">
				<img style="width: 20px;height: 30px;" src="http://www.usj.edu.lb/logos/100/esib.jpg"><span> <?php echo $formation['Formation']['Institution']['nom'] ?></span> <span class="textepetit" bgcolor="#F7F7F7" width="18%"><?php echo $this->Html->link('Plus de détails', "http://".$formation['Formation']['url'], null); ?> </span>	
			</td>
			</tr>
 			 </table>
			  </li>
  		<?php	}  ?>
</ol>
		

<?php echo'</td></tr>';
		break;
		 case "choixformationsecondaire":
		   	     foreach($formationsecs as $formationsec)
	  	{
	  	 	$formationid = $formationsec['Formationsecondaire']['id'];
	  	 	$key=NULL;
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
          
          
           $fontred="";
           if(isset($missing))
            { 
             if(isset($missing['Formationsecondaire'][$formationid]))
    		 $fontred="fontred";
    		}
        echo  "<tr><td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>".$formationsec['Formationsecondaire']['nom'].'</span></td>';

		if ($edit)	
			echo   "<th class='th_r' width='200' align='left'><span class='spaced_span'>".$this->Form->input('formationsececolnom'.$formationid, array('label'=> '' ,'default' => $ecolnom,
            'class' => 'schooltxt',
            'autocomplete' => 'off')).'</span></th>';
		else
		  echo  '<th class="th_r" width="200" align="left"><span class="spaced_span">'.$ecolnom.'</span></th>';
		
		 echo "<td class='td_r' align='left' width='200'><span class='spaced_span {$fontred}'>". $formationsec['Formationsecondaire']['nom'].' Adresse'.'</span></td>';
			
		if($edit)
			echo  '<th class="th_r" width="200" align="left" ><span class="spaced_span">'.$this->Form->input('formationsecadress'.$formationid, array('type'=>'text','label'=>'','class'=>'ecole-adresse-input','default' => $ecoladress)).'</span></th>';
			else
			 echo '<th class="th_r" width="200" align="left" ><span class="spaced_span">'.$ecoladress.'</span></th>';
			echo '</tr>'; 
	
	      }

		    break;
			}
		}
	
	}
	echo '</table>';
		echo '</div>';
}		
	?>
	
</div>

<br style="clear:both">
	
	<?php if($edit) echo $this->Form->end(array('label'=>'Sauvegarder','style'=>'background-color: #99AABB;color:"white";height:"50px";margin-left:35%;margin-top:"5px";margin-bottom:"5px";width:320px;')); ?>

  <?php 
    if($edit){
     foreach($forms as $formid)
     { 
       ?>
     		<form id="fileuploadform<?php echo $formid;?>" class="fileuploadform" method="post" style="display:none" action="<?php echo $this->Html->url( '/', true ).''; ?>uploads" enctype="multipart/form-data">
				<input type="file" name="inputfile<?php echo $formid;?>" multiple />
			<input type="hidden" name="dossierid" value="<?php echo $dossierid;?>" />
			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

		</form>
     
     	<?php
     }
     }
  ?>

</div>

<?php if(!$edit){ ?>
<script>


$(document).ready(function() { 
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
 

$('#validatebtn').click(function()
{
if($('#validatebtn').hasClass('estvalide'))

<?php if(isset($dossiercomplet) && !$dossiercomplet) 
echo "if(!confirm('Etes vous sûres?  votre dossier est incomplet et serait definitif, après validation aucun changement ne peut être effectué!'))  return;";
   else 
echo "if(!confirm('Etes vous sûres?  votre dossier serait definitif, après validation aucun changement ne peut être effectué!')) return;";
?>
  $.ajax({
    		url:'<?php echo $this->Html->url( '/', true ).''; ?>dossiers/valider?dossierid=<?php echo $dossierid; ?>' ,
    		type:'post',
    		success: function(result) 
    		{
    		   var a = JSON.parse(result);
    		   window.location = a.url;
    		   $('#ajaxBusy').hide();
     		 $(".estvalide").parent().remove();  
        	},
        	fail: function(result)
        	{
        	 alert('Erreur!');
        	 $('#ajaxBusy').hide();
        	},
        	beforeSend: function()
        	{
        	 $('#ajaxBusy').show();
        	}
		  });
    
});
</script>
<?php }  ?> 

<?php if($edit) { ?>
<script>
 $(function() {
    $( ".date" ).datepicker({
     yearRange: "1950:2014",
      changeMonth: true,
      changeYear: true
    });
  });

$('.sort').sortable({
    connectWith: '.sort',
    items: '> li:not(.pin)',
    revert:false,
    stop: function()
    {
        $('.sort').each(function(event,ui){
       		updatepriorite();
       	
            var $this = $(this);
            $this.sortable('enable');              
        });
       },
        receive: function(e, ui) 
        { 
            if(!$(ui.item).is(".choisi"))
            {
            	$(ui.item).addClass("choisi");
            	$(ui.item).removeClass("nonchoisi");
            }
        else
             {
             $(ui.item).removeClass("choisi");
             $(ui.item).addClass("nonchoisi");
             }
        }
});

function updatepriorite()
{

 	   $( ".numero" ).each(function( index, element )
       {
		$(this).html();
  	   });
  	   
  	   $( ".nonchoisi" ).each(function( index, element )
       {
		$(element).find("span.numero").html("");
  	   });
  	    
  	          $( ".nonchoisi" ).each(function( index, element )
       {
		$(element).find("span.numero").html("");
  	   });
}


$('.sort li').mousedown(function(){
    // Check number of elements already in each sortable
    $('.sort').not($(this).parent()).not($('#source')).each(function(){
        var $this = $(this);

        if($this.find('li').not($('.pin')).length >= 6){
            $this.sortable('disable');
        } else {
            $this.sortable('enable');
        }
    });
})

$('form').submit(function(){
  $( ".choisi" ).each(function( index, element )
       {
			$('<input>').attr({type: 'hidden',value: 'priorite'+(index+1),name: $(this).attr('id') }).appendTo('form');
  	    });
  	 
});


$('.ecole-adresse-input').each(function(i, el) 
{
   $(this).attr('readonly','readonly');
});

$('.schooltxt').each(function(i, el) 
{
 $this = $(el);
 $(this).focus(function() {
  $( this ).val("" );
   $(this).parent().parent().parent().parent().find('.ecole-adresse-input').val("");
   $(this).parent().parent().parent().parent().find('.ecole-adresse-input').removeAttr('readonly');
});

 
 $this.autocomplete
({
  source: '<?php echo $this->Html->url( '/', true ).''; ?>ecolessecondaires/find',
  minLength: 1,
  delay: 2,
   focus: function( event, ui ) {
        $(this).val( ui.item.Ecolessecondaire.nom );
        return false;
      },
        selectFirst: true,
      select: function( event, ui ) {
        $(this).val( ui.item.Ecolessecondaire.nom);
        $(this).parent().parent().parent().parent().find('.ecole-adresse-input').val(ui.item.Ecolessecondaire.adresse);
        $(this).parent().parent().parent().parent().find('.ecole-adresse-input').attr('readonly','readonly');
        return false;
      }
            
    }).data( "ui-autocomplete" )._renderItem = function( ul, item )
    {
      return $( "<li>" )
        .append( "<a>" + item.Ecolessecondaire.nom + "<br>" + item.Ecolessecondaire.adresse + "</a>" )
        .appendTo( ul );
    }
});

   $(function()
   {
    $('.fileuploadform').fileupload({
    	 dataType: 'json',
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data)
        {
				 var fileuploadform="fileuploadform";
 			   	var fileid = $(this).attr("id").slice(fileuploadform.length);
    			var ul = $('#ulfileliste'+fileid);

            var tpl = $('<li class="working"><span class="filename" style="padding-right:3em"></span><img src="<?php echo $this->Html->url( '/', true );?>img/delete-icon.png" class="deletefile hide"  ></img><img src="<?php echo $this->Html->url( '/', true );?>img/ajax-loader.gif" class="loadingimg"  /></li>');

            // Append the file name
            tpl.find('span').text(data.files[0].name);
            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);
  		   
  		   	       
  		   	        
            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit().success(function (result, textStatus, jqXHR) {})
            .error(function (jqXHR, textStatus, errorThrown) {
                var img = $('<img src="<?php echo $this->Html->url( '/', true );?>img/test-fail-icon.png" class="testpass"  ></img>');
                  tpl.append(img).after($('#filename'));
  			$(tpl).find('.loadingimg').remove();
  			 $(tpl).find('.deletefile').remove();
            })
            .complete(function (result, textStatus, jqXHR)
            { 
              //console.log(result.responseText);
              var ret = JSON.parse(result.responseText);
              $(tpl).find('span').text(ret.filename);
              $(tpl).find('.loadingimg').attr('src','<?php echo $this->Html->url( '/', true );?>img/test-pass-icon.png');
            });
       
   
        $(tpl).find('.deletefile').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                tpl.fadeOut(function(){
                    tpl.remove();
                });
                }

            });
       
        },
        
        done :	function(e,data)
        {
     //   alert('done');
        console.log(data);
      data.context.find(".deletefile").click(function()
        {
  		if(!confirm('Vous etes sur d\'effavcer ce fichier?'))
  		   return;
    $.ajax({
    		url:'<?php echo $this->Html->url( '/', true ).''; ?>fichiers/deletefichier/'+data.result.fichierid,
    		type:'delete',
    		success: function(result) 
    		{
    		   //alert('removed');
        		data.context.remove();	
        	},
        	fail: function(result)
        	{
        	  alert('delete fail');
        	}
		  });
        
        });
        },
        progress: function(e, data)
        {
                  // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial


            if(progress == 100){
              data.context.removeClass('working');
            }
        },

        fail:function(e, data)
        {
            // Something has gone wrong!
           // alert("wrong");
           // console.log(data);
              data.context.find('.loadingimg').remove();
              data.context.find('.deletefile').remove();
        }

    });     
}); 

$('.fichierli').each(function()
{
var fichier="fichier";
 	var fileid = $(this).attr("id").slice(fichier.length);
 	var self=this;
    //alert(fileid);
   $(this).append($('<img src="<?php echo $this->Html->url( '/', true );?>img/delete-icon.png" class="testpass"  ></img>').click(function()
   {
   	if(!confirm('Vous etes sur d\'effavcer ce fichier?'))
  		   return;
       $.ajax({
    		url:'<?php echo $this->Html->url( '/', true ).''; ?>fichiers/deletefichier/'+fileid,
    		type:'delete',
    		success: function(result) 
    		{
    		    //alert('removed');
        		$(self).remove();	
        	},
        	fail: function(result)
        	{
        	  alert('delete fail');
        	}
		  });
   })).after($('#filename'));
});

$('.dropclick').click(function(){
    var dropclick="dropclick";
    var fileid = $(this).attr("id").slice(dropclick.length);
        // Simulate a click on the file input button
        // to show the file browser dialog
        $("[name='inputfile"+fileid+"']").click();
    });
    
    


    </script>
<?php } ?>
