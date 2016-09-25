<div class="videoLessonScriptChecks view">
<h2><?php echo __('Video Lesson Script Check'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($videoLessonScriptCheck['VideoLessonScriptCheck']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Video Lesson Script'); ?></dt>
		<dd>
			<?php echo $this->Html->link($videoLessonScriptCheck['VideoLessonScript']['id'], array('controller' => 'video_lesson_scripts', 'action' => 'view', $videoLessonScriptCheck['VideoLessonScript']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Check'); ?></dt>
		<dd>
			<?php echo h($videoLessonScriptCheck['VideoLessonScriptCheck']['text_to_check']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Video Lesson Script Check'), array('action' => 'edit', $videoLessonScriptCheck['VideoLessonScriptCheck']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Video Lesson Script Check'), array('action' => 'delete', $videoLessonScriptCheck['VideoLessonScriptCheck']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLessonScriptCheck['VideoLessonScriptCheck']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lesson Script Checks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script Check'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
