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
 <span style="margin-left:90%;">
<?php echo $this->Html->link(__('Annuler'), array('controller' => 'users', 'action' => 'viewinfo'));  ?>
</span>
<?php echo $this->Form->create('User',array('type' => 'file')); ?>
<table border="0" cellspacing="1" cellpadding="1" align="left" width="100%" style="border-collapse:'collapse';">

<?php

//print_r($sections);

	foreach ($sections as $section) 
	{
	
	 if($section['Section']['id']!=$sectionid && $sectionid!='all')
	   continue;
	   echo '<tr><td colspan="4" style="font-size:"1pt";">&nbsp;</td>
			</tr>
			 <tr>
			 <td class="bg1" colspan="2"><b>'.$section['Section']['nom'].'</b></td>
			 
			 <td colspan="2">
			 <select  style="font-size:10pt" >
			 <option value="2011">2010 / 2011</option>
			 <option value="2012">2011 / 2012</option>
			 <option value="2013">2012 / 2013</option>
			 <option selected="" value="2014">2013 / 2014</option>
			 </select>
			 </td>
			
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
	  	 	  if ($formation['Userformationsec']['formationsecondaire_id']==$formationid)
	  	 	  {
	  	 	   $key=$idx;
	  	 	    break;
	  	 	  }
	  	 	  
	  	 	}
	
	$ecolnom = isset($formationsecdejaexist[$key]['Ecolessecondaire']['nom']) ? $formationsecdejaexist[$key]['Ecolessecondaire']['nom']:'' ;
	$ecoladress= isset($formationsecdejaexist[$key]['Ecolessecondaire']['adresse'])? $formationsecdejaexist[$key]['Ecolessecondaire']['adresse'] : '';
        echo  '<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$formationsec['Formationsecondaire']['nom'].'</span></td>';
			echo   '<th class="th_r" align="left"><span class="spaced_span">'.$this->Form->input('formationsececolnom'.$formationid, array('label'=> '' ,'default' => $ecolnom, 'required' => 'required',
            'class' => 'schooltxt',
            'autocomplete' => 'off')).'</span></th>';
		
         echo	'<td class="td_r" align="left" width="200"><span class="spaced_span">'. $formationsec['Formationsecondaire']['nom'].' Adresse'.'</span></td>';
			echo   '<th class="th_r" align="left" ><span class="spaced_span">'.$this->Form->input('formationsecadress'.$formationid, array('type'=>'text','label'=>'','class'=>'ecole-adresse-input','default' => $ecoladress, 'required' => 'required' )).'</span></th>';
			echo '</tr>'; 
	
	     }
	    }
	    
	  
	 foreach ($section['Attribut'] as $att)
		{	
		 
		 	if($att['pardefault']=='0')
		 	   break;
		  switch ($att['type'])
		{
			
		 case "string":
		$options =  array('label'=>'','type' => 'text');
	
		    if($att['obligatoire'])
                array_push($options,'required');
			if(!$att['rtl'])
			{
			echo	'<tr><td class="td_r"  align="left" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'], $options ).'</span></th>';
			echo '<td/>';
			echo '</tr>';
			}
			else
			{
			echo	'<tr>';
			echo   '<td/>';
		    echo   '<th class="th_r"  style="direction:rtl" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'], $options ).'</span></th>';
			echo '<td class="td_r" style="direction:rtl" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo '</tr>';
			}		
		 break;
		
		 case "date":
		 
		 $options = array('label'=>'' ,'class'=>'date','type' => 'text');
		   if($att['obligatoire'])
                array_push($options,'required');
		   
		   	echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'],$options).'</span></th>';
			echo '</tr>';

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
       
       		echo	'<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo   '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input('attribut'.$att['id'],$options).'</span></th>';
			echo '<td/></tr>';
       
        break;
		
		case "file":
		//	echo $this->Form->input('image',array('label'=> $att['nom'],  'type' => 'file'));	
			echo  '<tr><td class="td_r" align="left" width="200"><span class="spaced_span">'.$att["nom"].'</span></td>';
			echo  '<th class="th_r" align="left" colspan="2"><span class="spaced_span">'.$this->Form->input("file".$att["id"],array('label'=> '',  'type' => 'file')).'</span></th>';
			echo  '<td/></tr>';
		break;
			}
		}
	}
		
	?>
		
	</table>
	<div>
	
<h3 style="float:right"> Liste des cursus choisis par ordre </h3>
	<h3 style="float:left"> Liste des cursus </h3>
	</div>
 <ul class='sort ui-sortable' id="source" style="overflow: scroll; width: 200px; height: 100px;border:solid black 2px;width:45%;float:left;min-height:500px;">
<?php 
		foreach ($formations as $formation) 
  			{  
  			 ?>
  				<li class="ui-state-default nonchoisi" style="" id="formation<?php echo $formation['Formation']['id'] ?>">
  			   <span><?php echo $formation['Institution']['nom'] ?> </span>  <span style="marign-left:15px" class="numero petittext"></span>
  			   <table class="formationtab">
    		 <tr bgcolor="#F7F7F7">
			    <td height="20" colspan="2" bgcolor="#D8E0E7" class="textepetit">
				<img style="width: 20px;height: 30px;" src="http://www.usj.edu.lb/logos/100/esib.jpg"><span>	<?php echo $formation['Formation']['nom'] ?></span> <span class="textepetit" bgcolor="#F7F7F7" width="18%"><?php echo $this->Html->link('Plus de détails', "http://".$formation['Formation']['url'], null); ?> </span>	
			</td>
			</tr>
 			 </table>
			  </li>
  		<?php	}  ?>
</ul>


<ol class='sort ui-sortable' style="border:solid black 2px;float:right;width:45%;min-height:500px;">
<?php 

	  usort($formationdejaexist, function($a, $b)
	   {        
        	return $a['Userformation']['priorite'] > $b['Userformation']['priorite'] ? 1 : -1;
    });

		foreach ($formationdejaexist as $formation) 
  			{ ?>
  				<li class="ui-state-default choisi" style="" id="formation<?php echo $formation['Formation']['id'] ?>">
  			   <span><?php echo $formation['Formation']['Institution']['nom'] ?> </span>  <span style="marign-left:15px" class="numero petittext"><?php /*echo "(".$formation['Userformation']['priorite'].")";*/ ?> </span>
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
	
	<?php	echo $this->Form->end(array('label'=>'Modifier','style'=>'background-color: #99AABB;color:"white";height:"50px";margin-left:35%;margin-top:"5px";margin-bottom:"5px";width:320px;')); ?>

</div>



  <script>
// $( "form" ).validate();
// jQuery.validator.addClassRules("date", {
//        date: true
// });

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
  	    
       $( ".choisi" ).each(function( index, element )
       {
		//$(element).find("span.numero").html("("+ (index+1)+")");
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
  </script>
<script>




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
function isDate(txtDate)
{
    var currVal = txtDate;
    if(currVal == '')
        return false;
    
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    
    if (dtArray == null) 
        return false;
    
    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[3];
    dtDay= dtArray[1];
    dtYear = dtArray[5];        
    
    if (dtMonth < 1 || dtMonth > 12) 
        return false;
    else if (dtDay < 1 || dtDay> 31) 
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31) 
        return false;
    else if (dtMonth == 2) 
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap)) 
                return false;
    }
    return true;
}

</script>
