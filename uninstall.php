<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

$lending_hall_options = array(
    'lh_options',
    'lh_calendar_options',
);

foreach ($lending_hall_options as $op) {
    delete_option($op);
}