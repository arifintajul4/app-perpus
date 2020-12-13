<?php
defined('BASEPATH') or exit('No direct script access allowed');

function isLogin()
{
    $ci = get_instance();
    if ($ci->session->userdata('isLogin')) {
        redirect('home');
    }
}
