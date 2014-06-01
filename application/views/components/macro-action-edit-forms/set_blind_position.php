<h4><?php echo lang('Parameters for action') . ' ' . $macroAction->name . ' ' . lang('in macro') . ' ' . $macro->name; ?></h4>
<form id="macro-action-edit-form" role="form">
    <div class="form-group">
        <label for="blind-id" class="control-label"><?php echo lang('Blind'); ?></label>
        <select id="blind-id" name="blind-id" class="form-control">
            <?php foreach ($blinds as $blind) : ?>
                <option value="<?php echo $blind->id; ?>"><?php echo $blind->get_display_name(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="position"><?php echo lang('Position'); ?></label>
        <input type="number" class="form-control" id="position" name="position" placeholder="0 - 100" min="1" max="100">
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