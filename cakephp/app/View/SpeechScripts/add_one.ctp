<div class="speechScripts form">
    <?php echo $this->Form->create('SpeechScript'); ?>
    <fieldset>
        <legend><?php echo __('Add Speech Script'); ?></legend>
        <?php
        echo $this->Form->input('text_to_read');
        ?>
        <p>if your content contains the words "live" as a verb, use "liv" instead</p>
        <?php
        echo $this->Form->input('text_to_check');
        echo $this->Form->input('text_to_show');
        echo $this->Form->input('speech_function_id', array(
            'options' => array(1 => 'só fala', 2 => 'fala e escuta', 3 => 'só escuta'),
        ));
        echo $this->Form->input('script_index');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SpeechScript.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('SpeechScript.id')))); ?></li>
        <li><?php echo $this->Html->link(__('List Speech Scripts'), array('action' => 'index', $this->Form->value('SpeechScript.exercise_id'))); ?></li>
    </ul>
</div>
