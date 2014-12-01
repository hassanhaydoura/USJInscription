<div class="userformationsecs index">
	<h2><?php echo __('Userformationsecs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ecolessecondaire_id'); ?></th>
			<th><?php echo $this->Paginator->sort('formationsecondaire_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userformationsecs as $userformationsec): ?>
	<tr>
		<td><?php echo h($userformationsec['Userformationsec']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userformationsec['User']['id'], array('controller' => 'users', 'action' => 'view', $userformationsec['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userformationsec['Ecolessecondaire']['id'], array('controller' => 'ecolessecondaires', 'action' => 'view', $userformationsec['Ecolessecondaire']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userformationsec['Formationsecondaire']['id'], array('controller' => 'formationsecondaires', 'action' => 'view', $userformationsec['Formationsecondaire']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userformationsec['Userformationsec']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userformationsec['Userformationsec']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userformationsec['Userformationsec']['id']), null, __('Are you sure you want to delete # %s?', $userformationsec['Userformationsec']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Userformationsec'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ecolessecondaires'), array('controller' => 'ecolessecondaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ecolessecondaire'), array('controller' => 'ecolessecondaires', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formationsecondaires'), array('controller' => 'formationsecondaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formationsecondaire'), array('controller' => 'formationsecondaires', 'action' => 'add')); ?> </li>
	</ul>
</div>
