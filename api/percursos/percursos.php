<?php

if($api == 'percursos') {
    if($method == "GET") {
        include_once "get.php";
    }

    if($method == "POST") {
        include_once "post.php";
    }
}