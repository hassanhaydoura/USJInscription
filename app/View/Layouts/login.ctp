<html><head>
		



<title>USJ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
		echo $this->Html->css('jquery-ui-1.9.2.custom.min');
	    echo $this->HTML->script('jquery-1.9.1.min');
       	echo $this->HTML->script('jquery.validate');
       	echo $this->HTML->script('jquery-ui-1.9.2.custom.min');
       	echo $this->HTML->script('jquery.fileupload');
       	echo $this->HTML->script('jquery.iframe-transport');
       	echo $this->HTML->script('jquery.ui.widget');
        echo $this->HTML->script('jquery.knob');
       
?>
<!-- Feuille de style -->

<style>
.clS,.clS2{	color: #;	background-color:#CDDBEB;layer-background-color:#CDDBEB;}
.clSover,.clS2over,.clTover,.clB,.clBar{layer-background-color:#; background-color:#;}
</style>
<?php echo $this->Session->flash('flash', array('element' => 'flashmsg')); ?>
</head>


<body>


<?php 		echo $this->Html->css('main'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
     <td height="130" background="<?php echo $this->Html->url( '/banner.png', true )?>"><table width="60%" border="0" align="right" cellpadding="5" cellspacing="0">
           <tbody><tr>
             <td height="80" colspan="4" align="right" valign="top" class="vergr8b"><a href="http://www.usj.edu.lb" target="_blank" class="vergr9b"><b>Site de l'Université Saint-Joseph</b></a>          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
           </td></tr>
           <tr>
         
            <td width="45%" valign="bottom"><span class="typevent">&nbsp;
        
        <span style="margin-left:40%;">
             <?php
                    if ($this->Session->read('Auth.User')){
						
						echo $this->Html->link('Home',array('controller'=>'users','action'=>'profile'));
						echo "&nbsp;&nbsp;&nbsp;";
						echo $this->Html->link('Déconnexion', array('controller' => 'users', 'action' => 'logout'));
						echo "&nbsp;&nbsp;&nbsp;";
						echo $this->Html->link('Paramètres du compte', array('controller' => 'users', 'action' => 'changeAccountSettings')); 
						
                	}
					
                else
                {
                     echo $this->Html->link(__('Se connecter'), array('controller' => 'users', 'action' => 'login')); 
                }
                ?>
        </span>
        
        
            </span></td><td width="2%" valign="bottom"><span class="bordeau">
                          </span></td>
            </tr>
        </tbody></table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td>
    
      <table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          
          
           <tr>
            <td valign="top" bgcolor="#FFFFFF">
  
 	
<hr>

              </td></tr><tr>
            
                <td valign="top" bgcolor="#FFFFFF">
            
			
			<?php echo $this->fetch('content'); ?>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
</body></html>