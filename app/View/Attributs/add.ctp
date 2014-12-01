<div class="attributs form">
<?php echo $this->Form->create('Attribut'); ?>
	<fieldset>
		<legend><?php echo __('Add Attribut'); ?></legend>
	<?php
		echo $this->Form->input('nom');
		echo $this->Form->input('type');
		echo $this->Form->input('pardefault');
		echo $this->Form->input('section_id');
		echo $this->Form->input('obligatoire');
		echo $this->Form->input('rtl');
		echo $this->Form->input('ordre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attributs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listattributs'), array('controller' => 'listattributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listattribut'), array('controller' => 'listattributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
