<div class="formations form">
<?php echo $this->Form->create('Formation'); ?>
	<fieldset>
		<legend><?php echo __('Add Formation'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('nom');
		echo $this->Form->input('institution_id');
		echo $this->Form->input('url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Formations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformations'), array('controller' => 'userformations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformation'), array('controller' => 'userformations', 'action' => 'add')); ?> </li>
	</ul>
</div>
