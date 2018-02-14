<table cellpadding="0" cellspacing="0" id="my_table">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('lesson_id'); ?></th>
            <th><?php echo $this->Paginator->sort('text_to_show'); ?></th>
            <th><?php echo $this->Paginator->sort('text_to_check'); ?></th>
            <th><?php echo $this->Paginator->sort('translation'); ?></th>
            <th><?php echo $this->Paginator->sort('start_at_seconds'); ?></th>
            <th><?php echo $this->Paginator->sort('stop_at_seconds'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($videoLessonScripts as $videoLessonScript): ?>
            <tr id="<?php echo $videoLessonScript['VideoLessonScript']['id']; ?>">
                <td class="id"><?php echo h($videoLessonScript['VideoLessonScript']['id']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($videoLessonScript['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $videoLessonScript['Lesson']['id'])); ?>
                </td>
                <td class="text_to_show"><?php echo h($videoLessonScript['VideoLessonScript']['text_to_show']); ?>&nbsp;</td>
                <td class="text_to_check"><?php echo h($videoLessonScript['VideoLessonScript']['text_to_check']); ?>&nbsp;</td>
                <td class="translation"><?php echo h($videoLessonScript['VideoLessonScript']['translation']); ?>&nbsp;</td>
                <td class="start_at_seconds"><?php echo h($videoLessonScript['VideoLessonScript']['start_at_seconds']); ?>&nbsp;</td>
                <td class="stop_at_seconds"><?php echo h($videoLessonScript['VideoLessonScript']['stop_at_seconds']); ?>&nbsp;</td>
                <td class="actions">
                    <?php
                    echo $this->Html->link(
                            __('Add Alternate Check'), array('controller' => 'videoLessonScriptChecks',
                        'action' => 'add', $videoLessonScript['VideoLessonScript']['id']), array(
                        'class' => 'myButton', 'div' => false));
                    ?>
                    <?php
                    echo $this->Html->link(
                            __('List Alternate Checks'), array('controller' => 'videoLessonScriptChecks',
                        'action' => 'index', $videoLessonScript['VideoLessonScript']['id']), array(
                        'class' => 'myButton', 'div' => false));
                    ?>

                    <?php
                    $options = array(
                        'type' => 'button',
                        'label' => 'Delete',
                        'class' => 'myButton',
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


<script type="text/javascript">


    $('#my_table').on('click', '.text_to_show', function (event) {

        var target = $(event.target);
        if (target.is("td")) {
            var t = $(this).text();
            $(this).text('').append($('<input />', {'value': t}));
            $('input').focus();
        }

    });
    $('#my_table').on('click', '.text_to_check', function (event) {

        var target = $(event.target);
        if (target.is("td")) {
            var t = $(this).text();
            $(this).text('').append($('<input />', {'value': t}));
            $('input').focus();
        }

    });
    $('#my_table').on('click', '.translation', function (event) {

        var target = $(event.target);
        if (target.is("td")) {
            var t = $(this).text();
            $(this).text('').append($('<input />', {'value': t}));
            $('input').focus();
        }

    });
    $('#my_table').on('click', '.stop_at_seconds', function (event) {

        var target = $(event.target);
        if (target.is("td")) {
            var t = $.trim($(this).text());
            $(this).text('').append($('<input />', {'value': t, 'type': 'number'}));
            $('input').focus();
        }

    });
    $('#my_table').on('click', '.start_at_seconds', function (event) {

        var target = $(event.target);
        if (target.is("td")) {
            var t = $.trim($(this).text());
            $(this).text('').append($('<input />', {'value': t, 'type': 'number'}));
            $('input').focus();
        }

    });
    $('#my_table').on('blur', 'input', function () {
        var myTd = $(this).parent();
        var newValue = $(this).val();
        myTd.text(newValue);

        editScript(myTd.closest('tr').attr('id'), myTd.attr('class'), newValue);
    });

</script>