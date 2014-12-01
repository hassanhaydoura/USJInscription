<div class="attributs index">
	<h2><?php echo __('Attributs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('pardefault'); ?></th>
			<th><?php echo $this->Paginator->sort('section_id'); ?></th>
			<th><?php echo $this->Paginator->sort('obligatoire'); ?></th>
			<th><?php echo $this->Paginator->sort('rtl'); ?></th>
			<th><?php echo $this->Paginator->sort('ordre'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attributs as $attribut): ?>
	<tr>
		<td><?php echo h($attribut['Attribut']['id']); ?>&nbsp;</td>
		<td><?php echo h($attribut['Attribut']['nom']); ?>&nbsp;</td>
		<td><?php echo h($attribut['Attribut']['type']); ?>&nbsp;</td>
		<td><?php echo h($attribut['Attribut']['pardefault']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attribut['Section']['id'], array('controller' => 'sections', 'action' => 'view', $attribut['Section']['id'])); ?>
		</td>
		<td><?php echo h($attribut['Attribut']['obligatoire']); ?>&nbsp;</td>
		<td><?php echo h($attribut['Attribut']['rtl']); ?>&nbsp;</td>
		<td><?php echo h($attribut['Attribut']['ordre']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $attribut['Attribut']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attribut['Attribut']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attribut['Attribut']['id']), null, __('Are you sure you want to delete # %s?', $attribut['Attribut']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Attribut'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listattributs'), array('controller' => 'listattributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listattribut'), array('controller' => 'listattributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
