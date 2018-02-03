<div class="packages view">
<h2><?php echo __('Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd> 
			<?php echo h($package['Package']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($package['Package']['name']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Link to blog description'); ?></dt>
		<dd>
			<?php echo h($package['Package']['link_blog_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($package['Package']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($package['Package']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Package'), array('action' => 'edit', $package['Package']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Package'), array('action' => 'delete', $package['Package']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $package['Package']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Books'); ?></h3>
	<?php if (!empty($package['Book'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Is Free'); ?></th>
		<th><?php echo __('Difficulty Level'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Package Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($package['Book'] as $book): ?>
		<tr>
			<td><?php echo $book['id']; ?></td>
			<td><?php echo $book['name']; ?></td>
			<td><?php echo $book['is_free']; ?></td>
			<td><?php echo $book['difficulty_level']; ?></td>
			<td><?php echo $book['user_id']; ?></td>
			<td><?php echo $book['package_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'books', 'action' => 'view', $book['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'books', 'action' => 'edit', $book['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'books', 'action' => 'delete', $book['id']), array('confirm' => __('Are you sure you want to delete # %s?', $book['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>