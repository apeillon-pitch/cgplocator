<?php
function my_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyCcO_gEq7lWm1Sdu12YB2u2v3Mr-qKiz44');
}
add_action('acf/init', 'my_acf_init');