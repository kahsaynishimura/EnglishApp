<div class="usersLessons index">
	<h2><?php echo __('Users Lessons'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lesson_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usersLessons as $usersLesson): ?>
	<tr>
		<td><?php echo h($usersLesson['UsersLesson']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usersLesson['User']['name'], array('controller' => 'users', 'action' => 'view', $usersLesson['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usersLesson['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $usersLesson['Lesson']['id'])); ?>
		</td>
		<td><?php echo h($usersLesson['UsersLesson']['created']); ?>&nbsp;</td>
		<td><?php echo h($usersLesson['UsersLesson']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $usersLesson['UsersLesson']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $usersLesson['UsersLesson']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $usersLesson['UsersLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersLesson['UsersLesson']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Users Lesson'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
