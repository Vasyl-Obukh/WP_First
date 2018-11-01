<?php

function some_action () {
    echo 'Some random text';
}

add_action('some_action_action', 'some_action');

do_action('some_action_action');

?>