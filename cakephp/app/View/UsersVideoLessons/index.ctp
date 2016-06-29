<div class="usersVideoLessons index">
	<h2><?php echo __('Users Video Lessons'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('video_lesson_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usersVideoLessons as $usersVideoLesson): ?>
	<tr>
		<td><?php echo h($usersVideoLesson['UsersVideoLesson']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usersVideoLesson['User']['name'], array('controller' => 'users', 'action' => 'view', $usersVideoLesson['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usersVideoLesson['VideoLesson']['name'], array('controller' => 'video_lessons', 'action' => 'view', $usersVideoLesson['VideoLesson']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $usersVideoLesson['UsersVideoLesson']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $usersVideoLesson['UsersVideoLesson']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $usersVideoLesson['UsersVideoLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersVideoLesson['UsersVideoLesson']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Users Video Lesson'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
