<?php

class ComputerController extends HardwareController {

    public function __construct(Computers_model $computer) {
        parent::__construct();
        
        $this->computer = $computer;
    }

    private $computer;

    public function wake() {
        wake_on_lan($this->computer->mac, get_setting(KnownSettings::LOCAL_BROADCAST_ADDRESS));
    }

}
