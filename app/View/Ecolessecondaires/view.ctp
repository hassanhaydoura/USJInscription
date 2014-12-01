<div class="ecolessecondaires view">
<h2><?php echo __('Ecolessecondaire'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ecolessecondaire['Ecolessecondaire']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($ecolessecondaire['Ecolessecondaire']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adresse'); ?></dt>
		<dd>
			<?php echo h($ecolessecondaire['Ecolessecondaire']['adresse']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ecolessecondaire'), array('action' => 'edit', $ecolessecondaire['Ecolessecondaire']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ecolessecondaire'), array('action' => 'delete', $ecolessecondaire['Ecolessecondaire']['id']), null, __('Are you sure you want to delete # %s?', $ecolessecondaire['Ecolessecondaire']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ecolessecondaires'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ecolessecondaire'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformationsecs'), array('controller' => 'userformationsecs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformationsec'), array('controller' => 'userformationsecs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Userformationsecs'); ?></h3>
	<?php if (!empty($ecolessecondaire['Userformationsec'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Ecolessecondaire Id'); ?></th>
		<th><?php echo __('Formationsecondaire Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ecolessecondaire['Userformationsec'] as $userformationsec): ?>
		<tr>
			<td><?php echo $userformationsec['id']; ?></td>
			<td><?php echo $userformationsec['user_id']; ?></td>
			<td><?php echo $userformationsec['ecolessecondaire_id']; ?></td>
			<td><?php echo $userformationsec['formationsecondaire_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'userformationsecs', 'action' => 'view', $userformationsec['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'userformationsecs', 'action' => 'edit', $userformationsec['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'userformationsecs', 'action' => 'delete', $userformationsec['id']), null, __('Are you sure you want to delete # %s?', $userformationsec['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Userformationsec'), array('controller' => 'userformationsecs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
