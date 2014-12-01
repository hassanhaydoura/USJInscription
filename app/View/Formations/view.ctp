<div class="formations view">
<h2><?php echo __('Formation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institution'); ?></dt>
		<dd>
			<?php echo $this->Html->link($formation['Institution']['id'], array('controller' => 'institutions', 'action' => 'view', $formation['Institution']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($formation['Formation']['url']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Formation'), array('action' => 'edit', $formation['Formation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Formation'), array('action' => 'delete', $formation['Formation']['id']), null, __('Are you sure you want to delete # %s?', $formation['Formation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Formations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('controller' => 'institutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('controller' => 'institutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformations'), array('controller' => 'userformations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformation'), array('controller' => 'userformations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Userformations'); ?></h3>
	<?php if (!empty($formation['Userformation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Formation Id'); ?></th>
		<th><?php echo __('Priorite'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($formation['Userformation'] as $userformation): ?>
		<tr>
			<td><?php echo $userformation['id']; ?></td>
			<td><?php echo $userformation['user_id']; ?></td>
			<td><?php echo $userformation['formation_id']; ?></td>
			<td><?php echo $userformation['priorite']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'userformations', 'action' => 'view', $userformation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'userformations', 'action' => 'edit', $userformation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'userformations', 'action' => 'delete', $userformation['id']), null, __('Are you sure you want to delete # %s?', $userformation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Userformation'), array('controller' => 'userformations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
