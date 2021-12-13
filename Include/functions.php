<?php
    function base_url($url = BASE_DIR){
        if($url = BASE_DIR){
            return $url;
        }
            return BASE_DIR.DS.$url;
    }
?>