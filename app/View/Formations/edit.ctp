<div class="formations form">
<?php echo $this->Form->create('Formation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Formation'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Formation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Formation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Formations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformations'), array('controller' => 'userformations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformation'), array('controller' => 'userformations', 'action' => 'add')); ?> </li>
	</ul>
</div>
