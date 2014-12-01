<div class="ecolessecondaires form">
<?php echo $this->Form->create('Ecolessecondaire'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ecolessecondaire'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nom');
		echo $this->Form->input('adresse');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ecolessecondaire.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Ecolessecondaire.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ecolessecondaires'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Userformationsecs'), array('controller' => 'userformationsecs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformationsec'), array('controller' => 'userformationsecs', 'action' => 'add')); ?> </li>
	</ul>
</div>
