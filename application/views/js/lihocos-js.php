<script>

    function GetUrlParameter(param) {
        var pageUrl = window.location.search.substring(1);
        var urlVars = pageUrl.split('&');
        for (var i = 0; i < urlVars.length; i++)
        {
            var paramName = urlVars[i].split('=');
            if (paramName[0] === param)
                return paramName[1];
        }
    }

    function NowIsoString() {
        var date = new Date().toISOString();
        date = date.substring(0, 19);
        return date.split('T').join(' ');
    }

    $(document).ready(function() {

        //Initalize toastr
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'positionClass': 'toast-bottom-full-width',
            'onclick': null,
            'showDuration': '300',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };

        //Menu page link highlighting
        var pageId = $('body').data('page-id');
        var menuElement = $('#side-menu .page-id-' + pageId);
        menuElement.addClass('active');
        menuElement.parent().parent().addClass('open');

        //Moment.js
        moment.lang('<?php echo lang('momentjs_lang'); ?>');
        $('.moment').each(function() {
            var element = $(this);
            var timestamp = element.data('timestamp');
            element.text(moment(timestamp).fromNow());
        })

        //Dropdowns: Select item according to data-selected attribute
        $('select').each(function() {
            var element = $(this);
            var value = element.data('selected');
            element.val(value);
        })

        //Init url action butons
        $('.action-button').click(function() {
            var url = $(this).data('url');
            var successMessage = $(this).data('success-message');
            var errorMessage = $(this).data('error-message');

            $.ajax({
                url: url,
                type: 'POST',
                success: function() {
                    toastr['success'](successMessage, '<?php echo lang('Success'); ?>');
                },
                error: function(xhr, status, error) {
                    toastr['error'](errorMessage + '\n' + xhr.responseText, '<?php echo lang('Error'); ?>');
                }
            });
        });

    });

</script>