<?php
$url = "https://alura.com.br";

//str_starts_with($url, "http");

if (str_starts_with($url, "httzz")) {
    echo "é uma URL segura\n";
} else {
    echo "Não é uma URL segura!\n";
}

// str_ends_with($url, ".br");

if (str_ends_with($url, ".br")) {
    echo "É uma URL Brasileira!\n";
} else {
    echo "Não é uma URL Brasileira!\n";
}
