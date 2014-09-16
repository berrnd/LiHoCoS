<?php

class MissingLocationHistoryMailNotification extends CronJob {

    public function __construct() {
        parent::__construct();

        $this->interval_cron = '35 0 * * *';
    }

    public function execute() {
        $query = $this->ci->db->query('SELECT date FROM location_history_missing_days ORDER by DATE');

        if ($query->num_rows > 0) {
            $missingDates = array();
            foreach ($query->result() as $row) {
                $missingDates[] = format_date_user_defined($row->date);
            }

            $this->ci->load->helper('email');
            $this->ci->load->helper('html');

            $to = current_user_mail_address();
            $missingDatesHtml = array_to_html_list($missingDates);
            $data = array(
                'subject' => lang('LiHoCoS Location History: Missing days found') . ' (' . $query->num_rows . ')',
                'headline' => lang('LiHoCoS Location History: Missing days found'),
                'text' => lang('For the following days, no location history was recorded') . ':<br/><br/>' . $missingDatesHtml,
                'butttonLink' => base_url('tools'),
                'buttonText' => lang('Import these days now manually'),
                'textBelowButton' => '',
            );

            send_mail_with_template($to, 'mails/warning', $data);
        }
    }

}
