<div class="usersVideoLessons view">
<h2><?php echo __('Users Video Lesson'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usersVideoLesson['UsersVideoLesson']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersVideoLesson['User']['name'], array('controller' => 'users', 'action' => 'view', $usersVideoLesson['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Video Lesson'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersVideoLesson['VideoLesson']['name'], array('controller' => 'video_lessons', 'action' => 'view', $usersVideoLesson['VideoLesson']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Video Lesson'), array('action' => 'edit', $usersVideoLesson['UsersVideoLesson']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Users Video Lesson'), array('action' => 'delete', $usersVideoLesson['UsersVideoLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersVideoLesson['UsersVideoLesson']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Video Lessons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Video Lesson'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
