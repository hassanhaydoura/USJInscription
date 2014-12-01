<div class="listattributs form">
<?php echo $this->Form->create('Listattribut'); ?>
	<fieldset>
		<legend><?php echo __('Add Listattribut'); ?></legend>
	<?php
		echo $this->Form->input('attribut_id');
		echo $this->Form->input('valeur');
		echo $this->Form->input('attributadditionnelid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Listattributs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('controller' => 'attributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
