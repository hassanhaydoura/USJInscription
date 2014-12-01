

<?php
 $this->layout = 'login';
 echo $this->Form->create('Dossier',array('url'=>array('controller'=>'dossiers','action'=>'blancform')));	
	?>
<input type="hidden" name="redirectionpage" value="blancform" />
<table width="500" border="0" cellspacing="1" cellpadding="5" align="center" bgcolor="#000033" style="border-collapse:'collapse';">
		<tr bgcolor="#996699"> 
		  <td colspan="2" align="center" bgcolor="#003366" class="titresection"><strong>Creation d'un dossier</strong></td>
		</tr>
		
		<?php 
 	foreach($AttExistInMain as $att){     
		echo '<tr bgcolor="#CCCCCC" class="textenormal"> 
		  <td width="31%"><div align="right"><b><font color="#0D3246">';
		  echo $att['Attribut']['nom'].' :';  
		  echo ' </font></b></div></td><td >';
		 
		 
		 switch ($att['Attribut']['type'])
		{
			
		 case "string":
		$options =  array('label'=>'','type' => 'text');
		echo $this->Form->input('attribut'.$att['Attribut']['id'], $options );	
		break;
		
		 case "date":
		 $options = array('label'=>'' ,'class'=>'date','type' => 'text');
		 echo $this->Form->input('attribut'.$att['Attribut']['id'],$options);
         break;
        
        case "liste":
        $listatt= array();
  				 	foreach($listattributs as $element)
          					{ 
								if($att['Attribut']['id']==$element['Listattribut']['attribut_id']){
									$listatt[$element['Listattribut']['id']]=$element['Listattribut']['valeur'];
								}		
    					     }         
        $options =  array('options'=>$listatt, 'label'=>'');
      		echo   $this->Form->input('attribut'.$att['Attribut']['id'],$options);
	 
        break;
		
		case "file":
			echo $this->Form->input("file".$att['Attribut']['id'],array('label'=> '',  'type' => 'file'));

		break;
		
		}
		 
		  echo '</td></tr>';
		 } ?>
		 <tr align="center" bgcolor="#ffffff" b ><td colspan="2">
		 	
<input type="submit" value="Sauvegarder"  style='background-color: #9AB;color:"white";height:"50px";margin-top:"5px";font-weight: bold ;margin-bottom:"5px";width:"200px"'>

			</td>
			
		 </tr>
		 
		</table>

<div>


			<div align="center"><i>Glisser et d&eacute;poser vos choix <br>de gauche &agrave; droite </i></div>
	

	<div>
<h4 style="float: right;"> Liste des cursus choisis par ordre de pr&eacute;f&eacute;rence </h4>
	<h4 style="float:left"> Liste des cursus </h4>
	</div>
 <ul class='sort ui-sortable' id="source" style="overflow: scroll; width: 200px; height: 100px;border:solid black 2px;width:45%;float:left;min-height:500px;">
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


<ol class='sort ui-sortable' style="border:solid black 2px;float:right;width:45%;min-height:500px;">

</ol>


	</div>
	
	





  <script>
$( "form" ).validate();
jQuery.validator.addClassRules("date", {
       date: true
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

$('form').submit(function(event){
 if($( ".choisi" ).length==0)
   {
    alert('Il faut choisir au moins un cursus!');
    event.preventDefault();
    return;
   }
   
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
  source: <?php echo '"'.$this->Html->url( '/', true ).''; ?>ecolessecondaires/find,
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

