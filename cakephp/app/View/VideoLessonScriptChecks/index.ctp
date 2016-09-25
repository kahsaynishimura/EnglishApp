<div class="videoLessonScriptChecks index">
	<h2><?php echo __('Video Lesson Script Checks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('video_lesson_script_id'); ?></th>
			<th><?php echo $this->Paginator->sort('text_to_check'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($videoLessonScriptChecks as $videoLessonScriptCheck): ?>
	<tr>
		<td><?php echo h($videoLessonScriptCheck['VideoLessonScriptCheck']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($videoLessonScriptCheck['VideoLessonScript']['id'], array('controller' => 'video_lesson_scripts', 'action' => 'view', $videoLessonScriptCheck['VideoLessonScript']['id'])); ?>
		</td>
		<td><?php echo h($videoLessonScriptCheck['VideoLessonScriptCheck']['text_to_check']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $videoLessonScriptCheck['VideoLessonScriptCheck']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $videoLessonScriptCheck['VideoLessonScriptCheck']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $videoLessonScriptCheck['VideoLessonScriptCheck']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLessonScriptCheck['VideoLessonScriptCheck']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Video Lesson Script Check'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
