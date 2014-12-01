<div class="userattributs form">
<?php echo $this->Form->create('Userattribut'); ?>
	<fieldset>
		<legend><?php echo __('Edit Userattribut'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('attribut_id');
		echo $this->Form->input('valeur');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Userattribut.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Userattribut.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Userattributs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('controller' => 'attributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
