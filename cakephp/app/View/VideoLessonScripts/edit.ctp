<div class="videoLessonScripts form">
<?php echo $this->Form->create('VideoLessonScript'); ?>
	<fieldset>
		<legend><?php echo __('Edit Video Lesson Script'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('video_lesson_id');
		echo $this->Form->input('text_to_show');
		echo $this->Form->input('text_to_check');
		echo $this->Form->input('minute_to_stop');
		echo $this->Form->input('second_to_stop');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VideoLessonScript.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('VideoLessonScript.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
