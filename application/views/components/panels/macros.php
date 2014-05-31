<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Macros'); ?></h3>
    </div>
    <div class="panel-body">
        <?php foreach ($macros as $macro) : ?>
            <div class="btn-group">
                <?php $macroUrl = base_url('api/execute_macro/' . $macro->id); ?>
                <button data-success-message="<?php echo lang('Successfully executed macro'); ?>" data-error-message="<?php echo lang('Macro execution failed'); ?>" data-url="<?php echo $macroUrl; ?>" type="button" class="btn btn-default action-button"><?php echo $macro->name; ?></button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="caret"></i></button>
                <ul id="macro-dropdown" class="dropdown-menu" role="menu">
                    <label class="control-label"><?php echo lang('Execute this macro directly'); ?></label>
                    <input type="text" class="form-control" value="<?php echo $macroUrl; ?>">
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>

    $('#macro-dropdown').bind('click', function(e) {
        e.stopPropagation()
    })

    $('#macro-dropdown input').click(function() {
        $(this).select();
    });

</script>