<div class="institutions view">
<h2><?php echo __('Institution'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Institution'), array('action' => 'edit', $institution['Institution']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Institution'), array('action' => 'delete', $institution['Institution']['id']), null, __('Are you sure you want to delete # %s?', $institution['Institution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formations'), array('controller' => 'formations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formation'), array('controller' => 'formations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Formations'); ?></h3>
	<?php if (!empty($institution['Formation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Nom'); ?></th>
		<th><?php echo __('Institution Id'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($institution['Formation'] as $formation): ?>
		<tr>
			<td><?php echo $formation['id']; ?></td>
			<td><?php echo $formation['code']; ?></td>
			<td><?php echo $formation['nom']; ?></td>
			<td><?php echo $formation['institution_id']; ?></td>
			<td><?php echo $formation['url']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'formations', 'action' => 'view', $formation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'formations', 'action' => 'edit', $formation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'formations', 'action' => 'delete', $formation['id']), null, __('Are you sure you want to delete # %s?', $formation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Formation'), array('controller' => 'formations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
