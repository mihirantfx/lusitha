<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function check_number($number) {
    if (is_numeric($number)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
