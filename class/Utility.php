<?php

    class Utility {
        public static function showNav(){
            echo '<nav>';
            echo '<ul style="list-style:none;display:flex;gap:10px;padding:8px;background:#333;">';

            if (defined('NAV_PAGES')) {
                 foreach (NAV_PAGES as $p) {
                echo '<li><a style="color:#fff;text-decoration:none" href="' . BASE_URL . $p['url'] . '">' . $p['title'] . '</a></li>';
                }
            }
            echo '</ul>';
            echo '</nav>';
         }

        public static function redirect($url, $message = '', $prefill = []) {
            if (!empty($prefill)) {
            $_SESSION['prefill'] = $prefill;
            }

            if (!empty($message)) {
            $_SESSION['flash']['message'] = $message;
            }

            header('Location: ' . BASE_URL . $url);
            exit;
        }
    }