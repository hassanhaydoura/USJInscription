<div class="sections form">
<?php echo $this->Form->create('Section'); ?>
	<fieldset>
		<legend><?php echo __('Add Section'); ?></legend>
	<?php
		echo $this->Form->input('nom');
		echo $this->Form->input('ordre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('controller' => 'attributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
