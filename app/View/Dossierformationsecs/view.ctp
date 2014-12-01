<div class="userformationsecs view">
<h2><?php echo __('Userformationsec'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userformationsec['Userformationsec']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userformationsec['User']['id'], array('controller' => 'users', 'action' => 'view', $userformationsec['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ecolessecondaire'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userformationsec['Ecolessecondaire']['id'], array('controller' => 'ecolessecondaires', 'action' => 'view', $userformationsec['Ecolessecondaire']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Formationsecondaire'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userformationsec['Formationsecondaire']['id'], array('controller' => 'formationsecondaires', 'action' => 'view', $userformationsec['Formationsecondaire']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userformationsec'), array('action' => 'edit', $userformationsec['Userformationsec']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userformationsec'), array('action' => 'delete', $userformationsec['Userformationsec']['id']), null, __('Are you sure you want to delete # %s?', $userformationsec['Userformationsec']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userformationsecs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userformationsec'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ecolessecondaires'), array('controller' => 'ecolessecondaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ecolessecondaire'), array('controller' => 'ecolessecondaires', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formationsecondaires'), array('controller' => 'formationsecondaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formationsecondaire'), array('controller' => 'formationsecondaires', 'action' => 'add')); ?> </li>
	</ul>
</div>
