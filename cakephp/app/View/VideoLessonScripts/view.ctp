<div class="videoLessonScripts view">
<h2><?php echo __('Video Lesson Script'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Video Lesson'); ?></dt>
		<dd>
			<?php echo $this->Html->link($videoLessonScript['VideoLesson']['name'], array('controller' => 'video_lessons', 'action' => 'view', $videoLessonScript['VideoLesson']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Show'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['text_to_show']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Check'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['text_to_check']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Minute To Stop'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['minute_to_stop']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second To Stop'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['second_to_stop']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Video Lesson Script'), array('action' => 'edit', $videoLessonScript['VideoLessonScript']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Video Lesson Script'), array('action' => 'delete', $videoLessonScript['VideoLessonScript']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLessonScript['VideoLessonScript']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
