<div class="formationsecondaires view">
<h2><?php echo __('Formationsecondaire'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($formationsecondaire['Formationsecondaire']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($formationsecondaire['Formationsecondaire']['nom']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Formationsecondaire'), array('action' => 'edit', $formationsecondaire['Formationsecondaire']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Formationsecondaire'), array('action' => 'delete', $formationsecondaire['Formationsecondaire']['id']), null, __('Are you sure you want to delete # %s?', $formationsecondaire['Formationsecondaire']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Formationsecondaires'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formationsecondaire'), array('action' => 'add')); ?> </li>
	</ul>
</div>
