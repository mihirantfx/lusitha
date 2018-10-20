<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>

        <!-- include bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- include jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 15px 0 15px;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
            /*
            custom styles
            */
            #user_id{
                width: 150px;
                margin-right: 10px
            }
            #btn_check, #user_id{
                float: left;
            }
        </style>

        <script>

            $(document).ready(function () {

                //reading data
                $(document).on('click', '#btn_check', function () {
                    var result_html = '';
                    $.ajax({
                        url: '<?= base_url() ?>get-user-details',
                        dataType: 'json',
                        type: 'GET',
                        data: {user_id: $('#user_id').val()},
                        success: function (data, textStatus, jqXHR) {
                            if (data.status === 0) {
                                result_html = '<div class="alert alert-danger"><strong>Error!</strong> ' + data.data + '.</div>';
                                $('#results').html(result_html);
                            } else {
                                result_html = '<div class="alert alert-success"><strong>User found!</strong> ';
                                result_html += '<br/><br/><b>User Name:</b> ' + data.data[0]["user_name"];
                                result_html += '<br/><b>User Address:</b> ' + data.data[0]["user_address"];
                                result_html += '<br/><b>User TP:</b> ' + data.data[0]["user_tp"];
                                result_html += '</div>';
                                $('#results').html(result_html);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            result_html = '<div class="alert alert-danger"><strong>Error!</strong> ' + textStatus + '.</div>';
                            $('#results').html(result_html);
                        }
                    });
                });

                //insert data
                $(document).on('submit', '#userForm', function () {
                    var result_html = '';
                    $.ajax({
                        url: '<?= base_url() ?>input-user-details',
                        dataType: 'json',
                        type: 'POST',
                        data: $('#userForm').serialize(),
                        success: function (data, textStatus, jqXHR) {
                            if (data.status === 0) {
                                result_html = '<div class="alert alert-danger"><strong>Error!</strong> ' + data.data + '.</div>';
                                $('#results-post').html(result_html);
                            } else {
                                result_html = '<div class="alert alert-success"><strong>User Inserted! (ID: ' + data.data[0]["user_id"] + ')</strong> ';
                                result_html += '<br/><br/><b>User Name:</b> ' + data.data[0]["user_name"];
                                result_html += '<br/><b>User Address:</b> ' + data.data[0]["user_address"];
                                result_html += '<br/><b>User TP:</b> ' + data.data[0]["user_tp"];
                                result_html += '</div>';
                                $('#results-post').html(result_html);

                                //clear fields
                                $('#user_name_post').val('');
                                $('#user_add_post').val('');
                                $('#user_tp_post').val('');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            result_html = '<div class="alert alert-danger"><strong>Error!</strong> ' + textStatus + '.</div>';
                            $('#results-post').html(result_html);
                        }
                    });
                    return false;
                });


            });
        </script>
    </head>
    <body>

        <div id="container">
            <h1>Welcome to CodeIgniter! - GET</h1>

            <div id="body">
                <p>Testing CodeIgniter.</p>

                <p>Type user id:</p>
                <code>
                    <input class="form-control" type="text" id="user_id" /> <input type="button" class="btn btn-info" value="check" id="btn_check" />
                    <div class="clearfix"></div>
                </code>

                <p>Results will be displayed in below box:</p>
                <code id="results">

                </code>

                <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
            </div>

            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

        <div id="container">
            <h1>Welcome to CodeIgniter! - POST</h1>

            <div id="body">
                <p>Testing CodeIgniter.</p>

                <?= form_open("", array("id" => "userForm")) ?>
                <div class="col-md-3">
                    <p>Name:</p>
                    <code>
                        <input required class="form-control" type="text" id="user_name_post" name="user_name_post" />
                        <div class="clearfix"></div>
                    </code>
                </div>
                <div class="col-md-3">
                    <p>Address:</p>
                    <code>
                        <input required class="form-control" type="text" id="user_add_post" name="user_add_post" />
                        <div class="clearfix"></div>
                    </code>
                </div>
                <div class="col-md-3">
                    <p>TP:</p>
                    <code>
                        <input required class="form-control" type="text" id="user_tp_post" name="user_tp_post" />
                        <div class="clearfix"></div>
                    </code>
                </div>
                <div class="col-md-3">
                    <p>Add:</p>
                    <code>
                        <input type="submit" class="btn btn-info" value="Add User" id="btn_add" />
                        <div class="clearfix"></div>
                    </code>
                </div>
                <div class="clearfix"></div>
                <p>Results will be displayed in below box:</p>
                <code id="results-post">

                </code>
                <?= form_close() ?>
            </div>

        </div>

    </body>
</html>