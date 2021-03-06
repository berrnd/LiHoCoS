<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('Macros'); ?></h3>
    </div>
    <div class="panel-body">
        <?php foreach ($macros as $macro) : ?>
            <p>
            <div class="btn-group">
                <?php $macroUrl = api_url('api/macros/execute/' . $macro->id); ?>
                <button data-success-message="<?php echo lang('Successfully executed macro'); ?>" data-error-message="<?php echo lang('Macro execution failed'); ?>" data-url="<?php echo $macroUrl; ?>" type="button" class="btn btn-default action-button"><?php echo $macro->name; ?></button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="caret"></i></button>
                <ul id="macro-dropdown" class="dropdown-menu" role="menu" style="width: 500%;">
                    <label class="control-label"><?php echo lang('Execute this macro directly'); ?></label>
                    <input type="text" class="form-control" readonly="true" value="<?php echo $macroUrl; ?>">
                </ul>
            </div>
            </p>
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