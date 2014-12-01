<div class="sections view">
<h2><?php echo __('Section'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($section['Section']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($section['Section']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ordre'); ?></dt>
		<dd>
			<?php echo h($section['Section']['ordre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Section'), array('action' => 'edit', $section['Section']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Section'), array('action' => 'delete', $section['Section']['id']), null, __('Are you sure you want to delete # %s?', $section['Section']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributs'), array('controller' => 'attributs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Attributs'); ?></h3>
	<?php if (!empty($section['Attribut'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nom'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Pardefault'); ?></th>
		<th><?php echo __('Section Id'); ?></th>
		<th><?php echo __('Obligatoire'); ?></th>
		<th><?php echo __('Ordre'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($section['Attribut'] as $attribut): ?>
		<tr>
			<td><?php echo $attribut['id']; ?></td>
			<td><?php echo $attribut['nom']; ?></td>
			<td><?php echo $attribut['type']; ?></td>
			<td><?php echo $attribut['pardefault']; ?></td>
			<td><?php echo $attribut['section_id']; ?></td>
			<td><?php echo $attribut['obligatoire']; ?></td>
			<td><?php echo $attribut['ordre']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attributs', 'action' => 'view', $attribut['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attributs', 'action' => 'edit', $attribut['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attributs', 'action' => 'delete', $attribut['id']), null, __('Are you sure you want to delete # %s?', $attribut['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attribut'), array('controller' => 'attributs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
