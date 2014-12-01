<div class="userformations index">
	<h2><?php echo __('Userformations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('formation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('priorite'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userformations as $userformation): ?>
	<tr>
		<td><?php echo h($userformation['Userformation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userformation['User']['id'], array('controller' => 'users', 'action' => 'view', $userformation['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userformation['Formation']['id'], array('controller' => 'formations', 'action' => 'view', $userformation['Formation']['id'])); ?>
		</td>
		<td><?php echo h($userformation['Userformation']['priorite']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userformation['Userformation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userformation['Userformation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userformation['Userformation']['id']), null, __('Are you sure you want to delete # %s?', $userformation['Userformation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Userformation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formations'), array('controller' => 'formations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formation'), array('controller' => 'formations', 'action' => 'add')); ?> </li>
	</ul>
</div>
