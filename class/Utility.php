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

         public static function showFlash() {
            if (isset($_SESSION['flash']['message'])) {
            echo '<div style="padding:8px;border:1px solid #ccc;margin-bottom:10px;background:#eef;">'
                . htmlspecialchars($_SESSION['flash']['message']) .
                '</div>';

            unset($_SESSION['flash']);
            }
        }

        public static function getPrefill($keys) {
            $data = [];

            foreach ($keys as $k) {
                $data[$k] = $_SESSION['prefill'][$k] ?? '';
            }

            return $data;
        }

        public static function clearPrefill() {
            if (isset($_SESSION['prefill'])) {
                unset($_SESSION['prefill']);
            }
        }
    }