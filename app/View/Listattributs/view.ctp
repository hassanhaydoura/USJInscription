<div class="listattributs view">
<h2><?php echo __('Listattribut'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($listattribut['Listattribut']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribut'); ?></dt>
		<dd>
			<?php echo $this->Html->link($listattribut['Attribut']['id'], array('controller' => 'attributs', 'action' => 'view', $listattribut['Attribut']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valeur'); ?></dt>
		<dd>
			<?php echo h($listattribut['Listattribut']['valeur']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attributadditionnelid'); ?></dt>
		<dd>
			<?php echo h($listattribut['Listattribut']['attributadditionnelid']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Listattribut'), array('action' => 'edit', $listattribut['Listattribut']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Listattribut'), array('action' => 'delete', $listattribut['Listattribut']['id']), null, __('Are you sure you want to delete # %s?', $listattribut['Listattribut']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Listattributs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listattribut'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('controller' => 'attributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
