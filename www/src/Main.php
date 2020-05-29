<?php


class Main
{
    public function isLoginPage(): bool
    {
        return empty($_GET['name']);
    }

    public function displayLogin(): void
    {
        display("login");
    }
}