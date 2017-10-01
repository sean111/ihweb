<?php
function set_alert(string $type, string $message)
{
    \Session::flash('flash_message', ['type' => $type, 'message' => $message]);
}

function get_alert()
{
    if (!\Session::has('flash_message')) {
        return null;
    }
    $data = \Session::get('flash_message');
    $class = $data['type'];
    if ($class === 'error') {
        $class = 'danger';
    }
    return '<div class="alert alert-' . $class . '">' . $data['message'] . '</div>';
}