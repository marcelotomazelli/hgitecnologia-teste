<?php

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param $include 
 * @param string $string 
 * @return bool
 */
function str_include($include, string $string): bool
{
    if (is_int(mb_strpos($string, $include))) {
        return true;
    }

    return false;
}

/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    $len = mb_strlen($password);
    $min = CONF_PASSWORD_MIN_LEN;
    $max = CONF_PASSWORD_MAX_LEN;

    if (password_get_info($password)['algo']) {
        return true;
    }

    return ($len >= $min && $len <= $max);
}

/**
 * ################
 * ###   DATA   ###
 * ################
 */

/**
 * @param array $array 
 * @param array $indexes 
 * @return bool 
 */
function expected_ind(array $array, array $indexes): bool
{
    foreach ($indexes as $index) {
        if (empty($array[$index])) {
            return false;
        }
    }

    return true;
}

/**
 * @param array $array 
 * @param array $indexes 
 * @return bool 
 */
function exact_ind(array $array, array $indexes): bool
{
    if (count($indexes) != count($array)) {
        return false;
    }

    return expected_ind($array, $indexes);
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    $url = CONF_URL_BASE;

    if ($path) {
        $url .= ($path[0] != '/' ? "/{$path}" : $path);
    }

    return $url;
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header('HTTP/1.1 302 Redirect');
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    $path = ($url[0] != '/' ? "/{$url}" : $url);

    if (filter_input(INPUT_GET, 'route', FILTER_DEFAULT) != $path) {
        $location = url($path);
        header("Location: {$location}");
        exit;
    }
}

/**
 * ##################
 * ###   ASSETS   ###
 * ##################
 */

/**
 * @param string $file 
 * @param string $theme 
 * @return string
 */
function theme(string $path, string $theme = CONF_VIEW_WEB): string
{
    if ($path[0] == '/') {
        $path = substr($path, 1);
    }

    return url("themes/{$theme}/{$path}");
}

/**
 * @param string $path 
 * @param string $theme 
 * @return string
 */
function shared(string $path): string
{
    if ($path[0] == '/') {
        $path = substr($path, 1);
    }

    return url("shared/{$path}");
}


/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrfToken ?? '') . "'/>";
}

/**
 * @param string $token
 * @return bool
 */
function csrf_verify(string $token): bool
{
    $session = new \Source\Core\Session();

    if (!$session->has('csrfToken')) {
        return false;
    }

    if ($token != $session->csrfToken) {
        return false;
    }

    return true;
}

/**
 * @return string|null
 */
function flash_message(): ?string
{
    $session = new \Source\Core\Session();

    if (!$session->has('flash')) {
        return null;
    }

    return $session->flash()->render();
}
