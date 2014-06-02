<?php

/**
 * @property Macros_model $macros_model
 */
class Macros extends ApiController {

    public function __construct() {
        parent::__construct();

        $this->load->model('macros_model');
    }

    public function execute($macroId) {
        $macro = $this->macros_model->get($macroId);
        $macroExecutor = new MacroExecutor($macro);
        $macroExecutor->execute();

        $this->api_output(TRUE, 'Macro successfully executed', NULL);
    }

}
