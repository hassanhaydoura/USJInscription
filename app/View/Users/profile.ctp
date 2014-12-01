<div class="users form">
<style>
.progress-outer {
    background: white;
    border:solid black 1px;
    height: 5px;
    width: 100%;;
    padding: 3px;
}

.progress-inner {
    height: 100%;
    float:left;
}
.greenbg
{
  background: green;
}
.blubg
{
  background: #0C68B3;
}
</style>
<?php
	 $this->layout = 'login';
	
		//////////////////////


if($activated==0){
	echo '<h4 align="center"><font color="#ff0000" size="2px">';
	echo 'Un mail d\'activation vous a &eacute;t&eacute; envoy&eacute;, pri&egrave;re d\'activer votre compte pour pouvoir compl&eacute;ter votre dossier';
	echo '</font></h4>';

}
	
	//////////////////
	
	echo '<div align="right">';
		if($isAdmin==1)
	echo $this->Html->image('exporticon.jpg',array('width'=>'80px','id'=>'exportbtn','url'=>'#','height'=>'80px','title'=>'Exportation des dossiers'));
	echo $this->Html->link($this->Html->image('add.png',array('width'=>'80px','height'=>'80px','title'=>'Ajouter un dossier')), array('controller' => 'creerdossiers', 'action' => 'index'),array('escape'=>false));
	echo '</div>';
	
	if($isAdmin==1)
		$colsp=9;
	else
		$colsp=8;
	
	echo '<table width="650" border="1" cellspacing="1"  cellpadding="5" align="center" bgcolor="#000033";">';
	echo '<tr bgcolor="#996699">  <td colspan="'.$colsp.'" align="center" bgcolor="#003366" class="titresection"><strong>Liste des dossiers</strong></td></tr>';
	echo '<tr align="center" class="font11" bgcolor="#CCCCCC" ><th>Dossiers</th><th>Cr&eacute;er Par</th><th>Progr&egrave;s</th><th>Saisie</th><th>Ecole secondaire</th><th>Valid&eacute; par &eacute;tudiant</th><th>Valid&eacute; par administrateur</th>';
	if($isAdmin==1)
		echo '<th>Export</th>';
	echo '<th>Actions</th></tr>'	;
	foreach($listeDossiers as $dossier){
	   $bgcolor  =$dossier["CreatUser"]["username"]=="admin"?"#aaffff":"#ffffff";
		echo '<tr id="dossier"'.h($dossier['Dossier']['id']).'" class="font11" align="center" bgcolor="'.$bgcolor.'"><td>';
		echo $this->Html->link($dossier['Dossier']['nom'],array('controller'=>'dossiers','action'=>'blancform','?'=>array("dossierid"=>$dossier['Dossier']['id'])));
		echo '</td><td>';
		echo $dossier['CreatUser']['username'];
		echo '</td><td style="padding-right: 15px;">';
		  $class="";
		if($dossier['Dossier']['progres']=='100')
           $class="greenbg";
  		else
  		  $class ="blubg";
		  echo '<div title="'.round($dossier['Dossier']['progres'],2).'%" class="progress-outer">
    <div class="progress-inner '.$class.'" style="width:'.round($dossier['Dossier']['progres'],2).'%;"></div>
			</div>';
			
		  	echo '</td><td>';
		  	
		$class="";
		if($dossier['Dossier']['level']!="Dossier Complet")
		 { 
		   $class='tooltip dossiertooltip';
		  echo  $this->Html->link($dossier['Dossier']['level'],array('controller'=>'dossiers','action'=>'blancform','?'=>array("dossierid"=>$dossier['Dossier']['id'])),array("class"=>$class));
		}
		else
		  echo  $this->Html->image('valid.png',array('width'=>'20px','height'=>'20px','title'=>'validé','url'=>array('controller'=>'dossiers','action'=>'blancform','?'=>array("dossierid"=>$dossier['Dossier']['id']))));

		   echo '</td><td>';
		   if($dossier['Dossier']['ecolecomplet'])
		    {
		    	echo $this->Html->image('valid.png',array('width'=>'20px','height'=>'20px','title'=>'validé','url'=>array('controller'=>'dossiers','action'=>'blancform','?'=>array("dossierid"=>$dossier['Dossier']['id']))));

		     // echo  $this->Html->link($this->Html->image('valid.png',array('width'=>'20px','height'=>'20px','title'=>'validé')),array('controller'=>'dossiers','action'=>'blancform','?'=>array("dossierid"=>$dossier['Dossier']['id'])));
		    }
		    else
		    {
		    $class='tooltip ecoletooltip';
		     echo  $this->Html->link("En attente",array('controller'=>'dossiers','action'=>'blancform','?'=>array("dossierid"=>$dossier['Dossier']['id'])),array("class"=>$class));
		 	}
		  echo '</td><td>';
		 
		  
		if($dossier['Dossier']['valideparetudiant']==1){
			echo $this->Html->image('valid.png',array('width'=>'20px','height'=>'20px','title'=>'validé'));
		}
		else{
			echo '-';
		}
		  echo '</td><td>';
		if($dossier['Dossier']['valideparadmin']==1){
			echo $this->Html->image('valid.png',array('width'=>'20px','height'=>'20px','title'=>'validé'));
		}
		else{
			echo '-';
		}
	echo '</td><td>';
	if($isAdmin){
		echo $this->Form->checkbox('export'.$dossier['Dossier']['id'],array("class"=>"exportcheck"));	
		echo '</td><td>';
		
	}
	
		echo $this->Form->postLink($this->Html->image('delete.png',array('width'=>'20px','height'=>'20px','title'=>'Supprimer')), array('controller' => 'dossiers', 'action' => 'delete/'.h($dossier['Dossier']['id'])),array('escape'=>false),'Etes vous sures?');
	 if($isAdmin && $dossier['Dossier']['valide'])
		echo $this->Form->postLink($this->Html->image('unlock-icon.png',array('width'=>'20px','height'=>'20px','title'=>'Invalider')), array('controller' => 'dossiers', 'action' => 'invalider/'.h($dossier['Dossier']['id'])),array('escape'=>false),'Etes vous sures?');
		echo '</td></tr>';	
	}
	
	
	
	echo '</table>';
	echo "<br><br><br>";
	
	?>
</div>
    <script type="text/javascript">
    
    (function( $ ) {
  $.widget( "custom.tooltipX", $.ui.tooltip, {
    options: {
        autoShow: true,
        autoHide: true
    },

    _create: function() {
      this._super();
      if(!this.options.autoShow){
        this._off(this.element, "mouseover focusin");
      }
    },

    _open: function( event, target, content ) {
      this._superApply(arguments);

      if(!this.options.autoHide){
        this._off(target, "mouseleave focusout");
      }
    }
  });

}( jQuery ) );
    
   $(function() {

$(".dossiertooltip").tooltipX({
     items: "a",
      content: function() {
        var element = $( this );
        
         return '<?php echo $this->Html->image("loading.gif",array()) ?>'; 
      },
       show: {
    effect: "slideDown",
    delay: 300
  },
  autoShow:true,
  autoHide:false,
    open: function(evt, ui) {
        var elem = $(this);
        $( ".tooltip" ).not(elem).tooltipX( "close" );
        var dossierid=qs(elem.attr('href'),'dossierid');
        $.ajax('<?php echo $this->Html->url( '/', true ).''; ?>dossiers/getmissingfields?dossierid='+dossierid).always(function(data) {
          console.log(data);
           var res=$.parseJSON(data);
           var ul=$("<ul />");
            $.each( res, function( key, value ) {
            var li=$("<li>"+key+"</li>");
             $(ul).append(li);
             var ol=$("<ol />");
          $(li).append($(ol));
        $.each( value, function( key2, value2 ){
           $(ol).append($("<li>"+value2+"</li>"));
 
           })      
   });
        elem.tooltipX('option', 'content', ul.html());
         })
         ;
         
         }
    });
    
 $(".ecoletooltip").tooltipX({
     items: "a",
      content: function() {
        var element = $( this );
        
         return '<?php echo $this->Html->image("loading.gif",array()) ?>'; 
      },
       show: {
    effect: "slideDown",
    delay: 300
  },
  autoShow:true,
  autoHide:false,
    open: function(evt, ui) {
        var elem = $(this);
        $( ".tooltip" ).not(elem).tooltipX( "close" );
        var dossierid=qs(elem.attr('href'),'dossierid');
        $.ajax('<?php echo $this->Html->url( '/', true ).''; ?>dossiers/getecolemissing?dossierid='+dossierid).always(function(data) {
          console.log(data);
           var res=$.parseJSON(data);
           var ul=$("<ul />");
            $.each( res, function( key, value ) {
            var li=$("<li>"+key+"</li>");
             $(ul).append(li);
             var ol=$("<ol />");
          $(li).append($(ol));
        $.each( value, function( key2, value2 ){
           $(ol).append($("<li>"+value2+"</li>"));
 
           })      
   });
        elem.tooltipX('option', 'content', ul.html());
         })
         ;
         
         }
    });   

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
$("#exportbtn").click(function () {
var dossiertab=new Array();
$('input').each(function()
{
  var elem= $(this);

     if(elem.attr('type')=="checkbox" && elem.hasClass("exportcheck") && this.checked)
   			{
   			     dossiertab.push(elem.attr('id'));
   			 }    	  
});


if(dossiertab.length>0)
{
$.ajax({
    		url:'<?php echo $this->Html->url( '/', true ).''; ?>dossiers/export' ,
    		type:'POST',
    		data:{ 'dossiers': dossiertab },
    		success: function(result) 
    		{ 
    		   var a = JSON.parse(result);
    		   window.location = a.url;
    		   $('#ajaxBusy').hide();
    		     
        	},
        	fail: function(result)
        	{
        	 alert('Erreur!');
        	 $('#ajaxBusy').hide();
        	},
        	beforeSend: function()
        	{
        	console.log("begin");
        	 $('#ajaxBusy').show();
        	}
		  }); 
}
else
{
 alert("aucun dossier n'est choisi!");
}		  

});

     $('html').click(function () {
$( ".tooltip" ).tooltipX( "close" );    });
  });

function qs(url,key) {
    key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
    var match = url.match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
    return match && decodeURIComponent(match[1].replace(/\+/g, " "));
}
    </script>
