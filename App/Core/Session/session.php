<?php




function setSession(string $name, string|array $value)
{
    $_SESSION[$name] = $value;
}
function getSession(string $name)
{

    return $_SESSION[$name] ?? null;
}
function deleteSession(string $name)
{
    unset($_SESSION[$name]);
}
function hasSession(string $name): bool
{
    return isset($_SESSION[$name]);
}
