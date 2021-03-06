<div class="speechScripts form">
    <?php echo $this->Form->create('SpeechScript'); ?>
    <fieldset>
        <legend><?php echo __('Add Speech Script'); ?></legend>
        <?php
        echo $this->Form->input('exercise_name', array('label' => 'Excercise name'));

        echo $this->Form->input('speech_function_id', array(
            'default' => 2,
            'options' => array(1 => 'só fala', 2 => 'fala e escuta', 3 => 'só escuta'),
        ));


        echo $this->Form->input('checkbox_tts', array('name' => 'data[SpeechScript][fulfill_text_to_read]',
            'type' => 'checkbox',
            'default' => TRUE,
            'label' => 'Fulfill Text to Read (TTS)',
        ));

        echo $this->Form->input('complete_text', array(
            'type' => 'textarea',
            'label' => __('Type the complete text for a single exercise separating the practices by line break:')));
        ?>

    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index', $this->request->params['pass'][0])); ?> </li>

    </ul>
</div>
