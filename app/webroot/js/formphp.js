 $(function() {
    $( ".date" ).datepicker({
     yearRange: "1950:2000",
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
       

    // Helper function that formats the file sizes
// var img = $('<img src="<?php echo $this->Html->url( '/', true );?>img/delete-icon.png" class="testpass"  ></img>');
// $('.fichierli').append($('<img src="<?php echo $this->Html->url( '/', true );?>img/delete-icon.png" class="testpass"  ></img>').click(function(){
// alert($(this).attr('id'));
// })).after($('#filename'));
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
