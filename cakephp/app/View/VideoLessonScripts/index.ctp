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
                'data[VideoLessonScript][translation]': 'tradução',
                'data[VideoLessonScript][lesson_id]': <?php echo $lesson['Lesson']['id']; ?>
            },
            success: function (data) {
                // successful request; do something with the data

                $('#script_list').html(data);
            },
            error: function () {
                alert('Oops!');
            }
        });
    }
    function editScript(id, className, newValue) {
        $.ajax({
            type: 'POST',
            url: 'https://echopractice.com/ep/videoLessonScripts/edit_api',
            data: {
                'Access-Control-Allow-Credentials': true,
                'data[VideoLessonScript][id]': id,
                'data[VideoLessonScript][field]': className,
                'data[VideoLessonScript][value]': newValue,
                'data[VideoLessonScript][lesson_id]': <?php echo $lesson['Lesson']['id']; ?>

            },
            success: function (data) {
                // successful request; do something with the data

                $('#script_list').html(data);
            },
            error: function () {
                alert('Oops!');
            }
        });

    }
    function deleteScript(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                type: 'DELETE',
                url: 'https://echopractice.com/ep/videoLessonScripts/delete_api',
                data: {
                    'data[VideoLessonScript][id]': id,
                    'data[VideoLessonScript][lesson_id]': <?php echo $lesson['Lesson']['id']; ?>
                },
                success: function (data) {
                    // successful request; do something with the data

                    $('#script_list').html(data);
                },
                error: function () {
                    alert('Oops!');
                }
            });
        }
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
    <center> <div id="player"style="display: block;"></div>
        <div style="padding:15px;">
            <?php
            $options = array(
                'div' => false,
                'type' => 'button',
                'label' => 'Add New Script',
                'id' => 'add_new_script',
                'onclick' => 'saveNewScript()',
                'class' => 'myButton'
            );
            echo $this->Form->button('Add New Script', $options);
            ?>
        </div>
    </center>

    <div id="script_list" style="padding:15px;" class="related">
        <?php echo $this->element('list_scripts', ['videoLesson' => $videoLesson]); ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index', $lesson['Lesson']['book_id'])); ?> </li>
    </ul>
</div>

