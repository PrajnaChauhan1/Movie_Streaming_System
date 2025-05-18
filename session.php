<?php
session_start();
function addActiveUser($useremail)
{
    $_SESSION['active_user'] = $useremail;
}
function addActiveAdmin($adminemail)
{
    $_SESSION['active_admin'] = $adminemail;
}
function isActiveUser()
{
    return isset($_SESSION['active_user']);
}
function isActiveAdmin()
{
    return isset($_SESSION['active_admin']);
}
function removeActiveAdmin()
{
    unset($_SESSION['active_admin']);
}
function removeActiveUser()
{
    unset($_SESSION['active_user']);
}
function getActiveUser()
{
    return isset($_SESSION['active_user']) ? $_SESSION['active_user'] : null;
}
function getActiveAdmin()
{
    return isset($_SESSION['active_admin']) ? $_SESSION['active_admin'] : null;
}
function invalidateSession() {
    session_unset();
}
