<?php

namespace session;


class session
{
    static function create_session($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    static function have_session($name)
    {
        return isset($_SESSION[$name]) ? true : false;
    }

    static function get_session($name)
    {
        if (self::have_session($name)) {
            return $_SESSION[$name];
        }
        return false;
    }

    static function delete_session($name)
    {
        if (self::have_session($name)) {
            unset($_SESSION[$name]);
        }
    }

    static function delete_all_session()
    {
        session_destroy();
    }
}
