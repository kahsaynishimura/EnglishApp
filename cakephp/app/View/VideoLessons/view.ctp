<div class="videoLessons view">
<h2><?php echo __('Video Lesson'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($videoLesson['VideoLesson']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($videoLesson['VideoLesson']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($videoLesson['VideoLesson']['id_video']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Video Lesson'), array('action' => 'edit', $videoLesson['VideoLesson']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Video Lesson'), array('action' => 'delete', $videoLesson['VideoLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLesson['VideoLesson']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Video Lesson Scripts'); ?></h3>
	<?php if (!empty($videoLesson['VideoLessonScript'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Video Lesson Id'); ?></th>
		<th><?php echo __('Text To Show'); ?></th>
		<th><?php echo __('Text To Check'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($videoLesson['VideoLessonScript'] as $videoLessonScript): ?>
		<tr>
			<td><?php echo $videoLessonScript['id']; ?></td>
			<td><?php echo $videoLessonScript['video_lesson_id']; ?></td>
			<td><?php echo $videoLessonScript['text_to_show']; ?></td>
			<td><?php echo $videoLessonScript['text_to_check']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'video_lesson_scripts', 'action' => 'view', $videoLessonScript['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'video_lesson_scripts', 'action' => 'edit', $videoLessonScript['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'video_lesson_scripts', 'action' => 'delete', $videoLessonScript['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLessonScript['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
