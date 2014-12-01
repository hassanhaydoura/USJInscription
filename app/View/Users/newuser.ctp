<?php
 $this->layout = 'login';
?>
<?php echo $this->Form->create('User'); ?>

<table width="700" border="0" cellspacing="1" cellpadding="5" align="center" bgcolor="#663366" style="border-collapse:'collapse';">
	
			<tr bgcolor="#996699"> 
			  <td colspan="3" align="center" class="titresection">
			  <strong>S'inscrire</strong>
			  </td>
			</tr>
			<tr bgcolor="#CCCCCC" class="textenormal"> 
			  
			  <td width="25%"><div align="right"><b>
			  <font color="#0D3246">Username:</font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('username',array('label'=>'','size'=>'40','class'=>'textenormal width100'));?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>

<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="25%"><div align="right"><b>
			  <font color="#0D3246">Mot de passe :</font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('password',array('label'=>'','size'=>'40','class'=>'textenormal width100'));?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>


<tr bgcolor="#CCCCCC" class="textenormal"> 
  <td width="25%"><div align="right"><b>
			  <font color="#0D3246">Retapper mot de passe:</font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('passwordconfirm',array('label'=>'','type'=>'password','size'=>'40','class'=>'textenormal'));?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>
	<?php		
			foreach ($sections as $section) 
	{ ?>
			<tr bgcolor="#996699"> 
			<td colspan="3" align="center" class="titresection">
			<strong><?php echo $section['Section']['nom'] ?></strong>
			  </td>
			</tr>
    <?php

	 usort($section['Attribut'], function($a, $b)
	   {        
        	return $a['ordre'] > $b['ordre'] ? 1 : -1;
    });

 if($section['Section']['nom'] =='ÉTABLISSEMENTS SCOLAIRES DES ANNÉES SECONDAIRES')
	     {
	     
	     foreach($formationsecs as $formationsec)
	  	{
	  		 $formationid = $formationsec['Formationsecondaire']['id'];
	  	?>
 			<tr bgcolor="#CCCCCC" class="textenormal"> 
  			<td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $formationsec['Formationsecondaire']['nom'];?>
			 
			  </font></b></div></td>
			  <td width="50%">
			  <?php echo  $this->Form->input('formationsececolnom'.$formationid, array('label'=> '' ,
            'class' => 'schooltxt textenormal width100','size'=>'40',
            'autocomplete' => 'off')) ?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>

 			<tr bgcolor="#CCCCCC" class="textenormal"> 
  			<td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $formationsec['Formationsecondaire']['nom'];?>
			 
			  </font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('formationsecadress'.$formationid, array('type'=>'text','label'=>'','size'=>'40','class'=>'ecole-adresse-input textenormal width100')) ?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>
			
			<?php

	
	     }
	    }

if($section['Section']['nom'] =='Choix Cursus')
	     {
	     
	     }
    
     foreach ($section['Attribut'] as $att)
		{	
		 
		 	if($att['pardefault']=='0')
		 	   break;
		  switch ($att['type'])
		{
			
		 case "string":
	
		    if($att['obligatoire'])
                array_push($options,'required');
			if(!$att['rtl'])
			{
			$options =  array('label'=>'','type' => 'text','size'=>'40','class'=>'textenormal width100');
			?>
 			<tr bgcolor="#CCCCCC" class="textenormal"> 
  			<td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $att["nom"];?>
			 
			  </font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('attribut'.$att['id'], $options ) ?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>
			
			<?php
			}
			else
			{
			$options =  array('label'=>'','type' => 'text','size'=>'40','class'=>'textenormal width100 rtl');
			?>
 			<tr bgcolor="#CCCCCC" class="textenormal"> 
 			  <td width="25%">
				
 			  </td>
			  <td width="50%">
			  <?php  echo $this->Form->input('attribut'.$att['id'], $options ) ?>
			  </td>
			  <td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $att["nom"];?>
			 
			  </font></b></div></td>
			</tr>
			
			<?php
			}		
		 break;
		
		 case "date":
		 
		 $options = array('label'=>'' ,'class'=>'date','type' => 'text','size'=>'40','class'=>'textenormal width100');
		   if($att['obligatoire'])
                array_push($options,'required');
		   
			?>
 			<tr bgcolor="#CCCCCC" class="textenormal"> 
  			<td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $att["nom"];?>
			 
			 </font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('attribut'.$att['id'], $options ) ?>
			  </td>
		      <td width="25%">
 			  </td>
			</tr>
			
			<?php

         break;
        
        case "liste":
       
        $listatt= array();
  
  		foreach($att['Listattribut'] as $attribut)
    	{ 
          	$listatt[$attribut['id']] = $attribut['valeur'];
    	}         

        $options =  array('options'=>$listatt, 'label'=>'');
        
          if(!$att['obligatoire'])
               $options['empty']='aucun';      
       	
       	?>
 			<tr bgcolor="#CCCCCC" class="textenormal"> 
  			<td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $att["nom"];?>
			 
			  </font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input('attribut'.$att['id'], $options) ?>
			  </td>
			    <td width="25%">
 			  </td>
			</tr>
			
			<?php
       
        break;
		
		case "file":
		//	echo $this->Form->input('image',array('label'=> $att['nom'],  'type' => 'file'));	
		?>
 			<tr bgcolor="#CCCCCC" class="textenormal"> 
  			<td width="25%"><div align="right"><b>
			  <font color="#0D3246">
			 <?php echo $att["nom"]; ?>
			 
			  </font></b></div></td>
			  <td width="50%">
			  <?php  echo $this->Form->input("file".$att["id"],array('label'=> '',  'type' => 'file')) ?>
			  </td>
			    <td width="25%">
				
 			  </td>
			</tr>
			
			<?php
		break;
			}
		}
	
		
		
		
	?>
<?php
	}
	?>

			</table>
		<br>
		
      </td></tr></table>      
  <script type="text/javascript">
  
  
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
  source: <?php echo '"'.$this->Html->url( '/', true ).''; ?>ecolessecondaires/find",
  minLength: 1,
  delay: 2,
   focus: function( event, ui ) {
        $(this).val( ui.item.Ecolessecondaire.nom );
        return false;
      },
        selectFirst: true,
      select: function( event, ui ) {
        $(this).val( ui.item.Ecolessecondaire.nom);
        $('body').find('.ecole-adresse-input').val(ui.item.Ecolessecondaire.adresse);
        $('body').find('.ecole-adresse-input').attr('readonly','readonly');
        return false;
      }
            
    }).data( "ui-autocomplete" )._renderItem = function( ul, item )
    {
      return $( "<li>" )
        .append( "<a>" + item.Ecolessecondaire.nom + "<br>" + item.Ecolessecondaire.adresse + "</a>" )
        .appendTo( ul );
    }
});	
	
$('form').submit(function()
{
    if ($("#UserPasswordconfirm").val()!=$("#UserPassword").val())
    { 
        alert("Passwords does not match!");
        return false; 
    }

});
	
  </script>


