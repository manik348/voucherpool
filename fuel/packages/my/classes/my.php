<?php

namespace My;

class MyException extends \FuelException
{
}

class Response extends \Fuel\Core\Response
{
    /**
     * Override Fuel\Core\Response redirect method
     *
     * @param   string $url The url
     * @param   string $method The redirect method
     * @param   int $code The redirect status code
     *
     * @return  void
     */
    public static function redirect($url = '', $method = 'location', $code = 302)
    {
        $response = new static;
        $response->set_status($code);

        if (strpos($url, '://') === false) {
            $url = $url !== '' ? \Uri::create($url) : \Uri::base();
        }

        strpos($url, '*') !== false and $url = \Uri::segment_replace($url);

        if ($method == 'location') {
            $response->set_header('Location', $url);
        } elseif ($method == 'refresh') {
            $response->set_header('Refresh', '0;url=' . $url);
        } else {
            return;
        }

        if (\Fuel\Core\Fuel::$env != 'test') {
            $response->send(true);
            exit;
        }

        $response->send(true);
        Response:: $redirect_status = $code;  // ← assign local code $ code to static member
        Response:: $redirect_url = $url;  // ← assign local variable $ url to static member
        $response->send(true);
    }

    private static $redirect_status = null; // ← Add a member to refer to the status code at redirect
    private static $redirect_url = "";  // ← Add a member to refer URL at redirect

    public static function get_redirect_status()
    {  // ← redirect getter for referencing the status code when
        return Response:: $redirect_status;
    }

    public static function get_redirect_url()
    {  // ← getter for referring to the URL of the redirection
        return Response:: $redirect_url;
    }
}