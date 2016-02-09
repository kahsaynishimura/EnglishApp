<div class="practices index" style="width: 100%">

    <h2><?php echo __('Ranking'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('total_points'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($practices as $practice): ?>
                <tr>
                    <td>
                        <?php echo __($practice['User']['name']); ?>
                    </td>
                    <td><?php echo h($practice[0]['total_points']); ?>&nbsp;</td>

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