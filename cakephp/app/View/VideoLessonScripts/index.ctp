<div id="id_video" style="display: none;"><?php echo $lesson['Lesson']['id_video']; ?></div>

<script type="text/javascript">

    function saveNewScript() {
        player.pauseVideo();
        var stop_at_seconds = player.getCurrentTime();
        $.ajax({
            type: 'POST',
            url: 'https://echopractice.com/ep/videoLessonScripts/add_api',
            data: {
                'data[VideoLessonScript][stop_at_seconds]': stop_at_seconds + '',
                'data[VideoLessonScript][start_at_seconds]': stop_at_seconds + '',
                'data[VideoLessonScript][text_to_show]': 'new script',
                'data[VideoLessonScript][text_to_check]': 'new script',
                'data[VideoLessonScript][lesson_id]': <?php echo $lesson['Lesson']['id']; ?>
            },
            //                beforeSend: function () {
            //                    // this is where we append a loading image
            //                    $('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
            //                },
            success: function (data) {
                // successful request; do something with the data

                $('#script_list').html(data);
                // $('#ajax-panel').empty();
                //                    $(data).find('item').each(function (i) {
                //                        $('#ajax-panel').append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
                //                    });
            },
            error: function () {
                alert('Oops!');
                // failed request; give feedback to user
                // $('#ajax-panel').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
            }
        });
    }
    function deleteScript(id) {

        $.ajax({
            type: 'DELETE',
            url: 'https://echopractice.com/ep/videoLessonScripts/delete_api',
            data: {
                'data[VideoLessonScript][id]': id,
                'data[VideoLessonScript][lesson_id]': <?php echo $lesson['Lesson']['id']; ?>
            },
            //                beforeSend: function () {
            //                    // this is where we append a loading image
            //                    $('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
            //                },
            success: function (data) {
                // successful request; do something with the data

                $('#script_list').html(data);
                // $('#ajax-panel').empty();
                //                    $(data).find('item').each(function (i) {
                //                        $('#ajax-panel').append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
                //                    });
            },
            error: function () {
                alert('Oops!');
                // failed request; give feedback to user
                // $('#ajax-panel').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
            }
        });
    }

    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var videoId = document.getElementById('id_video').innerHTML;
    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '390',
            width: '640',
            videoId: videoId,
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }



    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    // 5. The API calls this function when the player's state changes.

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PAUSED) {
            player.getCurrentTime();
        }
    }

    function stopVideo() {
        player.stopVideo();
    }

</script>
<div class="videoLessonScripts index">
    <h2><?php echo __('Video Lesson Scripts'); ?> </h2>

<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <center> <div id="player"></div>
    </center>
    <?php
    $options = array(
        'type' => 'button',
        'label' => 'Add New Script',
        'id' => 'add_new_script',
        'onclick' => 'saveNewScript()'
    );
    echo $this->Form->button('Add New Script', $options);
    ?>
    <div id="script_list">
        <?php echo $this->element('list_scripts'); ?>
    </div>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Video Lesson Script'), array('action' => 'add', $lesson['Lesson']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
    </ul>
</div>

