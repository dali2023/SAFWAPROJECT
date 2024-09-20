<?php
/**
 * Preloader
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( agrios_get_mod( 'preloader', 'animsition' ) == '' ) return false;

$text = agrios_get_mod( 'preloader_text', 'PLEASE WAIT' );
?>

<div id="preloader">
    <svg class="preloader-leaves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
    <g transform="translate(50,50) scale(1) translate(-50,-50)">
      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(0 50 50)"></path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(30 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(60 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(90 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(120 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(150 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(180 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(210 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(240 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(270 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(300 50 50)">
      </path>

      <path d="M44.6,20.6c2.6,4.4,7,7.1,11.7,7.7c1.9-4.4,1.7-9.5-0.8-14c-2.6-4.4-7-7.1-11.7-7.7C41.9,11,42,16.2,44.6,20.6z" transform="rotate(330 50 50)">
      </path>
    </g>
  </svg>
</div>