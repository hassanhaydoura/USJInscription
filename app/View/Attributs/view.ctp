<div class="attributs view">
<h2><?php echo __('Attribut'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pardefault'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['pardefault']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attribut['Section']['id'], array('controller' => 'sections', 'action' => 'view', $attribut['Section']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Obligatoire'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['obligatoire']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rtl'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['rtl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ordre'); ?></dt>
		<dd>
			<?php echo h($attribut['Attribut']['ordre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attribut'), array('action' => 'edit', $attribut['Attribut']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attribut'), array('action' => 'delete', $attribut['Attribut']['id']), null, __('Are you sure you want to delete # %s?', $attribut['Attribut']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listattributs'), array('controller' => 'listattributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listattribut'), array('controller' => 'listattributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Listattributs'); ?></h3>
	<?php if (!empty($attribut['Listattribut'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Attribut Id'); ?></th>
		<th><?php echo __('Valeur'); ?></th>
		<th><?php echo __('Attributadditionnelid'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attribut['Listattribut'] as $listattribut): ?>
		<tr>
			<td><?php echo $listattribut['id']; ?></td>
			<td><?php echo $listattribut['attribut_id']; ?></td>
			<td><?php echo $listattribut['valeur']; ?></td>
			<td><?php echo $listattribut['attributadditionnelid']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'listattributs', 'action' => 'view', $listattribut['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'listattributs', 'action' => 'edit', $listattribut['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'listattributs', 'action' => 'delete', $listattribut['id']), null, __('Are you sure you want to delete # %s?', $listattribut['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Listattribut'), array('controller' => 'listattributs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
