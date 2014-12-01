<div class="ecolessecondaires form">
<?php echo $this->Form->create('Ecolessecondaire'); ?>
	<fieldset>
		<legend><?php echo __('Add Ecolessecondaire'); ?></legend>
	<?php
		echo $this->Form->input('nom');
		echo $this->Form->input('adresse');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ecolessecondaires'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Userformationsecs'), array('controller' => 'userformationsecs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformationsec'), array('controller' => 'userformationsecs', 'action' => 'add')); ?> </li>
	</ul>
</div>
