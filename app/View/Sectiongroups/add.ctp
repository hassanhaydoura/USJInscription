<div class="sectiongroups form">
<?php echo $this->Form->create('Sectiongroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Sectiongroup'); ?></legend>
	<?php
		echo $this->Form->input('nom');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sectiongroups'), array('action' => 'index')); ?></li>
	</ul>
</div>
