
<div class="videoLessons index">
    <h2><?php echo __('Video Lessons'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('Package.name'); ?></th>
                <th><?php echo $this->Paginator->sort('id_video'); ?></th>
                <th><?php echo $this->Paginator->sort('created', null, array('direction' => 'asc')); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videoLessons as $videoLesson): ?>
                <tr>
                    <td><?php echo h($videoLesson['VideoLesson']['id']); ?>&nbsp;</td>
                    <td><?php echo h($videoLesson['VideoLesson']['name']); ?>&nbsp;</td> 
                    <td><?php echo h($videoLesson['Package']['name']); ?>&nbsp;</td> 
                    <td><?php echo h($videoLesson['VideoLesson']['id_video']); ?>&nbsp;</td>
                    <td><?php echo h($videoLesson['VideoLesson']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $videoLesson['VideoLesson']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $videoLesson['VideoLesson']['id'])); ?>
                        <?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index', $videoLesson['VideoLesson']['id'])); ?> 
                        <?php echo $this->Html->link(__('Get Text Practices from video'), array('controller' => 'video_lesson_scripts', 'action' => 'index_for_text', $videoLesson['VideoLesson']['id'])); ?> 
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $videoLesson['VideoLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLesson['VideoLesson']['id']))); ?>
                    </td>
                </tr>
                <tr id="form_vl_<?php echo $videoLesson['VideoLesson']['id']; ?>" >
                    <td colspan="6" class="actions"> 
                        <?php
                        echo $this->Form->create(
                                'VideoLessonScript', array(
                            'url' => array(
                                'controller' => 'videoLessonScripts',
                                'action' => 'add',
                                $videoLesson['VideoLesson']['id']
                            )
                                )
                        );
                        ?>
                        <fieldset>
                            <table>
                                <tbody>
                                    <tr>
                                        <td> <?php echo $this->Form->input('text_to_show'); ?></td>
                                        <td><?php
                                            echo $this->Form->input('text_to_check');
                                            ?></td>
                                        <td><?php echo $this->Form->input('start_minutes', array('label' => 'Start Minute', 'type' => 'number', 'min' => '0'));
                                            ?></td>
                                        <td><?php echo $this->Form->input('start_seconds', array('label' => 'Start Second', 'type' => 'number', 'min' => '0', 'max' => '60'));
                                            ?></td>
                                        <td><?php echo $this->Form->input('stop_minutes', array('label' => 'Stop Minute', 'type' => 'number', 'min' => '0'));
                                            ?></td>
                                        <td><?php echo $this->Form->input('stop_seconds', array('label' => 'Stop Second', 'type' => 'number', 'min' => '0', 'max' => '60'));
                                            ?></td>
                                        <td>     <?php echo $this->Form->end(__('Submit')); ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </fieldset>
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
        <li><?php echo $this->Html->link(__('New Video Lesson'), array('action' => 'add')); ?></li>
    </ul>
</div>
