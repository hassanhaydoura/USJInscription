<div class="formations index">
	<h2><?php echo __('Formations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('institution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($formations as $formation): ?>
	<tr>
		<td><?php echo h($formation['Formation']['id']); ?>&nbsp;</td>
		<td><?php echo h($formation['Formation']['code']); ?>&nbsp;</td>
		<td><?php echo h($formation['Formation']['nom']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($formation['Institution']['id'], array('controller' => 'institutions', 'action' => 'view', $formation['Institution']['id'])); ?>
		</td>
		<td><?php echo h($formation['Formation']['url']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $formation['Formation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $formation['Formation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $formation['Formation']['id']), null, __('Are you sure you want to delete # %s?', $formation['Formation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Formation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformations'), array('controller' => 'userformations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformation'), array('controller' => 'userformations', 'action' => 'add')); ?> </li>
	</ul>
</div>
