<div class="scriptsUsers view">
<h2><?php echo __('Scripts User'); ?></h2>
	<dl>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($scriptsUser['ScriptsUser']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finish Time'); ?></dt>
		<dd>
			<?php echo h($scriptsUser['ScriptsUser']['finish_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($scriptsUser['User']['name'], array('controller' => 'users', 'action' => 'view', $scriptsUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Speech Script'); ?></dt>
		<dd>
			<?php echo $this->Html->link($scriptsUser['SpeechScript']['id'], array('controller' => 'speech_scripts', 'action' => 'view', $scriptsUser['SpeechScript']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number Attempts'); ?></dt>
		<dd>
			<?php echo h($scriptsUser['ScriptsUser']['number_attempts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($scriptsUser['ScriptsUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($scriptsUser['ScriptsUser']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Scripts User'), array('action' => 'edit', $scriptsUser['ScriptsUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Scripts User'), array('action' => 'delete', $scriptsUser['ScriptsUser']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $scriptsUser['ScriptsUser']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Scripts Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scripts User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('controller' => 'speech_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
