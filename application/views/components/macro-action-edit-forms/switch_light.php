<h4><?php echo lang('Parameters for action') . ' ' . $macroAction->name . ' ' . lang('in macro') . ' ' . $macro->name; ?></h4>
<form id="macro-action-edit-form" role="form">
    <div class="form-group">
        <label for="light-id" class="control-label"><?php echo lang('Light'); ?></label>
        <select id="light-id" name="light-id" class="form-control">
            <?php foreach ($lights as $light) : ?>
                <option value="<?php echo $light->id; ?>"><?php echo $light->get_display_name(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <div class="radio">
            <label>
                <input type="radio" name="switch-type" id="switch-type-on" value="1" checked="true">
                <?php echo lang('On'); ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="switch-type" id="switch-type-off" value="0">
                <?php echo lang('Off'); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default"><?php echo lang('Save'); ?></button>
    </div>
</form>

<script>

<?php if (!empty($macroAction->parameters)) : ?>
        $('#macro-action-edit-form').deserialize(JSON.parse('<?php echo $macroAction->parameters; ?>'));
<?php endif; ?>

    $("#macro-action-edit-form").submit(function(event) {
        event.preventDefault();

        var parameters = JSON.stringify($(this).serializeObject());
        $.ajax({
            url: '<?php echo base_url('settings/set_macro_action_parameters/' . $macroAction->id); ?>',
            type: 'POST',
            data: {
                'parameters': parameters
            },
            success: function(response) {
                //TODO
            }
        });
    });

</script>