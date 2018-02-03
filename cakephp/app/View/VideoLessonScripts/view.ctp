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
			<?php echo $this->Html->link($videoLessonScript['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $videoLessonScript['Lesson']['id'])); ?>
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
		<dt><?php echo __('Second to Stop'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['stop_at_seconds']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second To Start'); ?></dt>
		<dd>
			<?php echo h($videoLessonScript['VideoLessonScript']['start_at_seconds']); ?>
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
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
