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
	</ul>
</div>