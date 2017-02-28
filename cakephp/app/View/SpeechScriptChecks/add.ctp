<div class="speechScriptChecks form">
<?php echo $this->Form->create('SpeechScriptCheck'); ?>
	<fieldset>
		<legend><?php echo __('Add Speech Script Check'); ?></legend>
	<?php
		echo $this->Form->input('text_to_check');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Speech Script Checks'), array('action' => 'index', $this->request->params['pass'][0])); ?></li>
		
        </ul>
</div>
