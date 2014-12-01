<div class="userformations view">
<h2><?php echo __('Userformation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userformation['Userformation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userformation['User']['id'], array('controller' => 'users', 'action' => 'view', $userformation['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Formation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userformation['Formation']['id'], array('controller' => 'formations', 'action' => 'view', $userformation['Formation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priorite'); ?></dt>
		<dd>
			<?php echo h($userformation['Userformation']['priorite']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userformation'), array('action' => 'edit', $userformation['Userformation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userformation'), array('action' => 'delete', $userformation['Userformation']['id']), null, __('Are you sure you want to delete # %s?', $userformation['Userformation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formations'), array('controller' => 'formations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formation'), array('controller' => 'formations', 'action' => 'add')); ?> </li>
	</ul>
</div>
