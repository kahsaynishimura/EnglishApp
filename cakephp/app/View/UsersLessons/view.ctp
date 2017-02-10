<div class="usersLessons view">
<h2><?php echo __('Users Lesson'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usersLesson['UsersLesson']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersLesson['User']['name'], array('controller' => 'users', 'action' => 'view', $usersLesson['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lesson'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersLesson['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $usersLesson['Lesson']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($usersLesson['UsersLesson']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($usersLesson['UsersLesson']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Lesson'), array('action' => 'edit', $usersLesson['UsersLesson']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Users Lesson'), array('action' => 'delete', $usersLesson['UsersLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersLesson['UsersLesson']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Lessons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Lesson'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
