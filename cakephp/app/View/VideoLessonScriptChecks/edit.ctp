<div class="videoLessonScriptChecks form">
<?php echo $this->Form->create('VideoLessonScriptCheck'); ?>
	<fieldset>
		<legend><?php echo __('Edit Video Lesson Script Check'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('text_to_check');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VideoLessonScriptCheck.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('VideoLessonScriptCheck.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lesson Script Checks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
