<?php

function text( $text ) {
    $text = strip_tags( $text );
    return apply_filters('short_description_filter', $text);
}

function short_description_function ( $text ) {
    return mb_substr( $text, 0, 30);
}

add_filter('short_description_filter', 'short_description_function');

function new_excerpt_length ( $length ) {
    return 20;
}

add_filter('excerpt_length', 'new_excerpt_length');

?>