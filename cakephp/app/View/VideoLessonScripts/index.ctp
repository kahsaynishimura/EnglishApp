<div class="videoLessonScripts index">
	<h2><?php echo __('Video Lesson Scripts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('video_lesson_id'); ?></th>
			<th><?php echo $this->Paginator->sort('text_to_show'); ?></th>
			<th><?php echo $this->Paginator->sort('text_to_check'); ?></th>
			<th><?php echo $this->Paginator->sort('stop_at_seconds'); ?></th>
			<th><?php echo $this->Paginator->sort('start_at_seconds'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($videoLessonScripts as $videoLessonScript): ?>
	<tr>
		<td><?php echo h($videoLessonScript['VideoLessonScript']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($videoLessonScript['VideoLesson']['name'], array('controller' => 'video_lessons', 'action' => 'view', $videoLessonScript['VideoLesson']['id'])); ?>
		</td>
		<td><?php echo h($videoLessonScript['VideoLessonScript']['text_to_show']); ?>&nbsp;</td>
		<td><?php echo h($videoLessonScript['VideoLessonScript']['text_to_check']); ?>&nbsp;</td>
		<td><?php echo h($videoLessonScript['VideoLessonScript']['stop_at_seconds']); ?>&nbsp;</td>
		<td><?php echo h($videoLessonScript['VideoLessonScript']['start_at_seconds']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $videoLessonScript['VideoLessonScript']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $videoLessonScript['VideoLessonScript']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $videoLessonScript['VideoLessonScript']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLessonScript['VideoLessonScript']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('action' => 'add',$videoLessonScript['VideoLessonScript']['video_lesson_id'])); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
