<div class="videoCategories view">
<h2><?php echo __('Video Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($videoCategory['VideoCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($videoCategory['VideoCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($videoCategory['VideoCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($videoCategory['VideoCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Video Category'), array('action' => 'edit', $videoCategory['VideoCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Video Category'), array('action' => 'delete', $videoCategory['VideoCategory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoCategory['VideoCategory']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Video Lessons'); ?></h3>
	<?php if (!empty($videoCategory['VideoLesson'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Id Video'); ?></th>
		<th><?php echo __('Is Free'); ?></th>
		<th><?php echo __('Video Category Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($videoCategory['VideoLesson'] as $videoLesson): ?>
		<tr>
			<td><?php echo $videoLesson['id']; ?></td>
			<td><?php echo $videoLesson['name']; ?></td>
			<td><?php echo $videoLesson['id_video']; ?></td>
			<td><?php echo $videoLesson['is_free']; ?></td>
			<td><?php echo $videoLesson['video_category_id']; ?></td>
			<td><?php echo $videoLesson['created']; ?></td>
			<td><?php echo $videoLesson['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'video_lessons', 'action' => 'view', $videoLesson['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'video_lessons', 'action' => 'edit', $videoLesson['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'video_lessons', 'action' => 'delete', $videoLesson['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLesson['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
