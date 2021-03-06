<div class="speechScripts index">
    <h2><?php echo __('Speech Scripts'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('text_to_read'); ?></th>
                <th><?php echo $this->Paginator->sort('text_to_check'); ?></th>
                <th><?php echo $this->Paginator->sort('text_to_show'); ?></th>
                <th><?php echo $this->Paginator->sort('translation'); ?></th>
                <th><?php echo $this->Paginator->sort('speech_function_id'); ?></th>
                <th><?php echo $this->Paginator->sort('exercise_id'); ?></th>
                <th><?php echo $this->Paginator->sort('script_index'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($speechScripts as $speechScript): ?>
                <tr>
                    <td><?php echo h($speechScript['SpeechScript']['id']); ?>&nbsp;</td>
                    <td><?php echo h($speechScript['SpeechScript']['text_to_read']); ?>&nbsp;</td>
                    <td><?php echo h($speechScript['SpeechScript']['text_to_check']); ?>&nbsp;</td>
                    <td><?php echo h($speechScript['SpeechScript']['text_to_show']); ?>&nbsp;</td>
                    <td><?php echo h($speechScript['SpeechScript']['translation']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($speechScript['SpeechScript']['speech_function_id'], array('controller' => 'speech_functions', 'action' => 'view', $speechScript['SpeechFunction']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($speechScript['Exercise']['name'], array('controller' => 'exercises', 'action' => 'view', $speechScript['Exercise']['id'])); ?>
                    </td>
                    <td><?php echo h($speechScript['SpeechScript']['script_index']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Add alternate check'), array('controller' => 'speechScriptChecks', 'action' => 'add', $speechScript['SpeechScript']['id'], $speechScript['Exercise']['id'])); ?>
                        <?php echo $this->Html->link(__('List alternate checks'), array('controller' => 'speechScriptChecks', 'action' => 'index', $speechScript['SpeechScript']['id'], $speechScript['Exercise']['id'])); ?>

                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $speechScript['SpeechScript']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $speechScript['SpeechScript']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $speechScript['SpeechScript']['id'], $speechScript['SpeechScript']['exercise_id']), array('confirm' => __('Are you sure you want to delete # %s?', $speechScript['SpeechScript']['id']))); ?>
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
        <li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add_one', $speechScript['Exercise']['id'])); ?> </li>

        <li><?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index', $speechScript['Exercise']['lesson_id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Add Another Exercise'), array('controller' => 'speechScripts', 'action' => 'add', $speechScript['Exercise']['lesson_id'])); ?> </li>
    </ul>
</div>