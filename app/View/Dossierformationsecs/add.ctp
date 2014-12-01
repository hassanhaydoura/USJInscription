<div class="userformationsecs form">
<?php echo $this->Form->create('Userformationsec'); ?>
	<fieldset>
		<legend><?php echo __('Add Userformationsec'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('ecolessecondaire_id');
		echo $this->Form->input('formationsecondaire_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Userformationsecs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ecolessecondaires'), array('controller' => 'ecolessecondaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ecolessecondaire'), array('controller' => 'ecolessecondaires', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formationsecondaires'), array('controller' => 'formationsecondaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formationsecondaire'), array('controller' => 'formationsecondaires', 'action' => 'add')); ?> </li>
	</ul>
</div>
