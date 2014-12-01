<div class="dossiers view">
<h2><?php echo __('Dossier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dossier['Dossier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dossier['User']['id'], array('controller' => 'users', 'action' => 'view', $dossier['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dossier['Photo']['id'], array('controller' => 'photos', 'action' => 'view', $dossier['Photo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activated'); ?></dt>
		<dd>
			<?php echo h($dossier['Dossier']['activated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dossier'), array('action' => 'edit', $dossier['Dossier']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dossier'), array('action' => 'delete', $dossier['Dossier']['id']), null, __('Are you sure you want to delete # %s?', $dossier['Dossier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dossiers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dossier'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
	</ul>
</div>
