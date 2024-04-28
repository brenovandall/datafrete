<?php

// Este é um handle das requisições por 'REQUEST METHOD', se for GET, será introduzido para o get.php, se for post, será introduzido para post.php
if($api == 'percursos') {
    if($method == "GET") {
        include_once "get.php";
    }

    if($method == "POST") {
        include_once "post.php";
    }
}