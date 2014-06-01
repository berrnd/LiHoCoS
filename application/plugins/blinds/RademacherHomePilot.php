<?php

require_once 'BlindsPlugin.php';

class RademacherHomePilot extends BlindsPlugin {

    public function __construct() {
        parent::__construct();

        //Provide plugin details
        $this->pluginReadableName = 'Rademacher HomePilot';
        $this->pluginDescription = 'Control HomePilot blinds';
        $this->authorName = 'Bernd Bestel';
        $this->authorWebsite = 'http://berrnd.de';
        $this->pluginWebsite = '';

        //Register your settings
        $this->register_setting('homepilot_base_url', 'HomePilot URL', 'The URL of your HomePilot (something like http://homepilot/)');
    }

    /**
     * {@inheritdoc}
     */
    public function set_position(Blinds_model $blind, $newPosition) {
        $requestUrl = $this->get_setting('homepilot_base_url') . '/deviceajax.do?cid=9&command=1&did=' . $blind->plugin_reference . '&goto=' . $newPosition;
        $rawResponse = file_get_contents($requestUrl);

        if ($rawResponse != FALSE) {
            $jsonResponse = json_decode($rawResponse, TRUE);
            if ($jsonResponse != NULL && $jsonResponse['status'] == "uisuccess")
                return TRUE;
            else
                return FALSE;
        } else
            return FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public function get_position(Blinds_model $blind) {
        $requestUrl = $this->get_setting('homepilot_base_url') . '/deviceajax.do?device=' . $blind->plugin_reference;
        $rawResponse = file_get_contents($requestUrl);

        if ($rawResponse != FALSE) {
            $jsonResponse = json_decode($rawResponse, TRUE);
            if ($jsonResponse != NULL && $jsonResponse['status'] == "ok")
                return $jsonResponse['device']['statusesMap']['Position'];
            else
                return FALSE;
        } else
            return FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public function get_devices() {
        $devices = array();

        $baseUrl = get_setting('homepilot_base_url');
        $requestUrl = $baseUrl . '/deviceajax.do?devices=1';
        if (empty($baseUrl) || !url_exists($requestUrl))
            return FALSE;

        $rawResponse = file_get_contents($requestUrl);

        if ($rawResponse != FALSE) {
            $jsonResponse = json_decode($rawResponse, TRUE);
            if ($jsonResponse != NULL && $jsonResponse['status'] == 'ok') {
                foreach ($jsonResponse['devices'] as $node) {
                    $devices[] = array($node['did'], $node['name'] . ' (' . $node['description'] . ')');
                }
            } else
                return FALSE;
        } else
            return FALSE;

        return $devices;
    }

}
