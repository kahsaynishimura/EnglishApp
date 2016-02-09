<div class="users view">
    <h2><?php echo __('User'); ?></h2>
    <dl>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($user['User']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('User since'); ?></dt>
        <dd>
            <?php echo h($user['User']['created']); ?>
            &nbsp;
        </dd>
       
    </dl>
</div>

