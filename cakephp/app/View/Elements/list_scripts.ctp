<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('lesson_id'); ?></th>
            <th><?php echo $this->Paginator->sort('text_to_show'); ?></th>
            <th><?php echo $this->Paginator->sort('text_to_check'); ?></th>
            <th><?php echo $this->Paginator->sort('stop_at_seconds'); ?></th>
            <th><?php echo $this->Paginator->sort('start_at_seconds'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($videoLessonScripts as $videoLessonScript): ?>
            <tr id="<?php echo $videoLessonScript['VideoLessonScript']['id']; ?>">
                <td><?php echo h($videoLessonScript['VideoLessonScript']['id']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($videoLessonScript['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $videoLessonScript['Lesson']['id'])); ?>
                </td>
                <td><?php echo h($videoLessonScript['VideoLessonScript']['text_to_show']); ?>&nbsp;</td>
                <td><?php echo h($videoLessonScript['VideoLessonScript']['text_to_check']); ?>&nbsp;</td>
                <td><?php echo h($videoLessonScript['VideoLessonScript']['stop_at_seconds']); ?>&nbsp;</td>
                <td><?php echo h($videoLessonScript['VideoLessonScript']['start_at_seconds']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Add Alternate Check'), array('controller' => 'videoLessonScriptChecks', 'action' => 'add', $videoLessonScript['VideoLessonScript']['id'])); ?>
                    <?php echo $this->Html->link(__('List Alternate Checks'), array('controller' => 'videoLessonScriptChecks', 'action' => 'index', $videoLessonScript['VideoLessonScript']['id'])); ?>
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $videoLessonScript['VideoLessonScript']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $videoLessonScript['VideoLessonScript']['id'])); ?>

                    <?php
                    $options = array(
                        'type' => 'button',
                        'label' => 'Delete',
                        'onclick' => 'deleteScript(' . $videoLessonScript['VideoLessonScript']['id'] . ')'
                    );
                    echo $this->Form->button('Delete', $options);
                    ?>


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
    ?>	
</p>
<div class="paging">
    <?php
    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>

