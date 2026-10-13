<?php
/**
 * @package    Templates.ceaec
 * @subpackage ScrollTopButton
 * @version    1.1
 * 
 * @files      scrolltopbutton.php, scrollTopButton.js, _scroll-top-button.scss
 *
 * @copyright   Copyright (C) 2019 - 2020 Damien BECHERINI All rights reserved.
 * @license     CC0 1.0 Universal - Public Domain Dedication; see https://creativecommons.org/publicdomain/zero/1.0/deed.en
 * 
 * @description scrolltopbutton partial
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div id="scroll-top-button" class="print-hide hidden-sm" >

    <a href="#top">
        <?php /* ?>
        
        <svg focusable="false" aria-hidden="true" width="1em" height="1em" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
            <path fill="currentColor" d="M7.626,0C7.992,-0.006 8.361,0.131 8.641,0.411L14.841,6.611C15.388,7.158 15.388,8.047 14.841,8.595L14.06,9.376C13.512,9.923 12.623,9.923 12.076,9.376L9.868,7.168L9.868,14.077C9.867,14.216 9.845,14.354 9.798,14.485C9.678,14.827 9.403,15.105 9.062,15.23C8.932,15.278 8.795,15.302 8.656,15.304L6.632,15.304C6.493,15.304 6.356,15.281 6.225,15.235C5.877,15.113 5.597,14.832 5.474,14.485C5.428,14.354 5.406,14.216 5.405,14.077L5.405,7.146L3.176,9.376C2.628,9.923 1.739,9.923 1.191,9.376L0.411,8.595C-0.137,8.047 -0.137,7.158 0.411,6.611L6.611,0.411C6.89,0.131 7.259,-0.006 7.626,0Z"/>
        </svg>
        */ ?>
        <svg focusable="false" aria-hidden="true" width="1em" height="0.6em" viewBox="0 0 20 12" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor" d="M9.87335 3.4023L17.3371 10.872C17.8896 11.4244 18.7829 11.4244 19.3294 10.872C19.8819 10.3195 19.876 9.42624 19.3294 8.8738L10.8724 0.410908C10.3376 -0.1239 9.47959 -0.135653 8.92715 0.369769L0.411362 8.86792C0.135143 9.14414 -2.86102e-05 9.50852 -2.86102e-05 9.86701C-2.86102e-05 10.2255 0.135143 10.5899 0.411362 10.8661C0.963802 11.4185 1.85711 11.4185 2.40367 10.8661L9.87335 3.4023Z" />
        </svg>
        <span class="sr-only"><?php echo "back to top"; ?></span>
    </a>

    <div class="trigger-top"></div>

    <div class="trigger-bottom"></div>

</div>