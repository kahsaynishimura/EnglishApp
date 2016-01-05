<div class="speechScripts view">
<h2><?php echo __('Speech Script'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($speechScript['SpeechScript']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Read'); ?></dt>
		<dd>
			<?php echo h($speechScript['SpeechScript']['text_to_read']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Check'); ?></dt>
		<dd>
			<?php echo h($speechScript['SpeechScript']['text_to_check']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Show'); ?></dt>
		<dd>
			<?php echo h($speechScript['SpeechScript']['text_to_show']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Speech Function'); ?></dt>
		<dd>
			<?php echo $this->Html->link($speechScript['SpeechFunction']['name'], array('controller' => 'speech_functions', 'action' => 'view', $speechScript['SpeechFunction']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exercise'); ?></dt>
		<dd>
			<?php echo $this->Html->link($speechScript['Exercise']['name'], array('controller' => 'exercises', 'action' => 'view', $speechScript['Exercise']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Script Index'); ?></dt>
		<dd>
			<?php echo h($speechScript['SpeechScript']['script_index']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Speech Script'), array('action' => 'edit', $speechScript['SpeechScript']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Speech Script'), array('action' => 'delete', $speechScript['SpeechScript']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $speechScript['SpeechScript']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Functions'), array('controller' => 'speech_functions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Function'), array('controller' => 'speech_functions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exercise'), array('controller' => 'exercises', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Scripts Users'), array('controller' => 'scripts_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scripts User'), array('controller' => 'scripts_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Scripts Users'); ?></h3>
	<?php if (!empty($speechScript['ScriptsUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('Finish Time'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Speech Script Id'); ?></th>
		<th><?php echo __('Number Attempts'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($speechScript['ScriptsUser'] as $scriptsUser): ?>
		<tr>
			<td><?php echo $scriptsUser['start_time']; ?></td>
			<td><?php echo $scriptsUser['finish_time']; ?></td>
			<td><?php echo $scriptsUser['user_id']; ?></td>
			<td><?php echo $scriptsUser['speech_script_id']; ?></td>
			<td><?php echo $scriptsUser['number_attempts']; ?></td>
			<td><?php echo $scriptsUser['created']; ?></td>
			<td><?php echo $scriptsUser['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'scripts_users', 'action' => 'view', $scriptsUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'scripts_users', 'action' => 'edit', $scriptsUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'scripts_users', 'action' => 'delete', $scriptsUser['id']), array('confirm' => __('Are you sure you want to delete # %s?', $scriptsUser['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Scripts User'), array('controller' => 'scripts_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
