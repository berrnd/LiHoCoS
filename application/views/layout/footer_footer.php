<script>

    $(document).ready(function() {

        //Menu page link highlighting

        var page_id = $('body').data('page-id');
        var menuElement = $('#side-menu .page-id-' + page_id);
        menuElement.addClass('active');
        menuElement.parent().parent().addClass('open');


        //Moment.js

        moment.lang('<?php echo lang('momentjs_lang'); ?>');

        $('.moment').each(function() {
            var element = $(this);
            var timestamp = element.data('timestamp');
            element.text(moment(timestamp).fromNow());
        })


        //Dropdowns: Select item according to data-selected Attribute

        $('select').each(function() {
            var element = $(this);
            var value = element.data('selected');
            element.val(value);
        })

    });

</script>

</body>

</html>

<!--

Page generation time: {elapsed_time} seconds
Memory usage: {memory_usage}

-->