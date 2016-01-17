<div class="exercises view">
<h2><?php echo __('Exercise'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($exercise['Exercise']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($exercise['Exercise']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lesson'); ?></dt>
		<dd>
			<?php echo $this->Html->link($exercise['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $exercise['Lesson']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transition Image'); ?></dt>
		<dd>
			<?php echo h($exercise['Exercise']['transition_image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Exercise'), array('action' => 'edit', $exercise['Exercise']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Exercise'), array('action' => 'delete', $exercise['Exercise']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $exercise['Exercise']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Exercises'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exercise'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('controller' => 'speech_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Speech Scripts'); ?></h3>
	<?php if (!empty($exercise['SpeechScript'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Text To Read'); ?></th>
		<th><?php echo __('Text To Check'); ?></th>
		<th><?php echo __('Text To Show'); ?></th>
		<th><?php echo __('Speech Function Id'); ?></th>
		<th><?php echo __('Exercise Id'); ?></th>
		<th><?php echo __('Script Index'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($exercise['SpeechScript'] as $speechScript): ?>
		<tr>
			<td><?php echo $speechScript['id']; ?></td>
			<td><?php echo $speechScript['text_to_read']; ?></td>
			<td><?php echo $speechScript['text_to_check']; ?></td>
			<td><?php echo $speechScript['text_to_show']; ?></td>
			<td><?php echo $speechScript['speech_function_id']; ?></td>
			<td><?php echo $speechScript['exercise_id']; ?></td>
			<td><?php echo $speechScript['script_index']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'speech_scripts', 'action' => 'view', $speechScript['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'speech_scripts', 'action' => 'edit', $speechScript['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'speech_scripts', 'action' => 'delete', $speechScript['id']), array('confirm' => __('Are you sure you want to delete # %s?', $speechScript['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
