<?php
// str polyfill for pre PHP 8
function str_starts_with( $haystack, $needle ) {
    $length = strlen( $needle );
    return substr( $haystack, 0, $length ) === $needle;
}
function str_ends_with( $haystack, $needle ) {
   $length = strlen( $needle );
   if( !$length ) {
       return true;
   }
   return substr( $haystack, -$length ) === $needle;
}
?>