<div class="userattributs view">
<h2><?php echo __('Userattribut'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userattribut['Userattribut']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userattribut['User']['id'], array('controller' => 'users', 'action' => 'view', $userattribut['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribut'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userattribut['Attribut']['id'], array('controller' => 'attributs', 'action' => 'view', $userattribut['Attribut']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valeur'); ?></dt>
		<dd>
			<?php echo h($userattribut['Userattribut']['valeur']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userattribut'), array('action' => 'edit', $userattribut['Userattribut']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userattribut'), array('action' => 'delete', $userattribut['Userattribut']['id']), null, __('Are you sure you want to delete # %s?', $userattribut['Userattribut']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userattributs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userattribut'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('controller' => 'attributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
