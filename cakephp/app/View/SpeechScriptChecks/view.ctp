<div class="speechScriptChecks view">
<h2><?php echo __('Speech Script Check'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($speechScriptCheck['SpeechScriptCheck']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Speech Script'); ?></dt>
		<dd>
			<?php echo $this->Html->link($speechScriptCheck['SpeechScript']['id'], array('controller' => 'speech_scripts', 'action' => 'view', $speechScriptCheck['SpeechScript']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text To Check'); ?></dt>
		<dd>
			<?php echo h($speechScriptCheck['SpeechScriptCheck']['text_to_check']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Speech Script Check'), array('action' => 'edit', $speechScriptCheck['SpeechScriptCheck']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Speech Script Check'), array('action' => 'delete', $speechScriptCheck['SpeechScriptCheck']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $speechScriptCheck['SpeechScriptCheck']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Script Checks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script Check'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('controller' => 'speech_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
