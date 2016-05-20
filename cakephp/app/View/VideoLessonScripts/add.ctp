<div class="videoLessonScripts form">
<?php echo $this->Form->create('VideoLessonScript'); ?>
	<fieldset>
		<legend><?php echo __('Add Video Lesson Script'); ?></legend>
	<?php
		echo $this->Form->input('video_lesson_id');
		echo $this->Form->input('text_to_show');
		echo $this->Form->input('text_to_check');
		echo $this->Form->input('stop_at_seconds');
		echo $this->Form->input('start_at_seconds');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
