<div class="sectiongroups view">
<h2><?php echo __('Sectiongroup'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sectiongroup['Sectiongroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($sectiongroup['Sectiongroup']['nom']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sectiongroup'), array('action' => 'edit', $sectiongroup['Sectiongroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sectiongroup'), array('action' => 'delete', $sectiongroup['Sectiongroup']['id']), null, __('Are you sure you want to delete # %s?', $sectiongroup['Sectiongroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectiongroups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sectiongroup'), array('action' => 'add')); ?> </li>
	</ul>
</div>
