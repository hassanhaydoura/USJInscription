<div class="ecolessecondaires index">
	<h2><?php echo __('Ecolessecondaires'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('adresse'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ecolessecondaires as $ecolessecondaire): ?>
	<tr>
		<td><?php echo h($ecolessecondaire['Ecolessecondaire']['id']); ?>&nbsp;</td>
		<td><?php echo h($ecolessecondaire['Ecolessecondaire']['nom']); ?>&nbsp;</td>
		<td><?php echo h($ecolessecondaire['Ecolessecondaire']['adresse']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ecolessecondaire['Ecolessecondaire']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ecolessecondaire['Ecolessecondaire']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ecolessecondaire['Ecolessecondaire']['id']), null, __('Are you sure you want to delete # %s?', $ecolessecondaire['Ecolessecondaire']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Ecolessecondaire'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Userformationsecs'), array('controller' => 'userformationsecs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformationsec'), array('controller' => 'userformationsecs', 'action' => 'add')); ?> </li>
	</ul>
</div>
