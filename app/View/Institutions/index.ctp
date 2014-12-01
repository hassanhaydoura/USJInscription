<div class="institutions index">
	<h2><?php echo __('Institutions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($institutions as $institution): ?>
	<tr>
		<td><?php echo h($institution['Institution']['id']); ?>&nbsp;</td>
		<td><?php echo h($institution['Institution']['nom']); ?>&nbsp;</td>
		<td><?php echo h($institution['Institution']['code']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $institution['Institution']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $institution['Institution']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $institution['Institution']['id']), null, __('Are you sure you want to delete # %s?', $institution['Institution']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Institution'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Formations'), array('controller' => 'formations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formation'), array('controller' => 'formations', 'action' => 'add')); ?> </li>
	</ul>
</div>
