<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\LoginHttpAuth;

use Piwik\View;

class Controller extends \Piwik\Plugins\Login\Controller
{
    public function logmeout()
    {
        // Effectively log out of Http auth
        $settings = new SystemSettings('LoginHttpAuth');
        if (isset($_SERVER['HTTP_X_AUTH_USERNAME'])) {
            // there is no way to log our session out so we do nothing
        } else {
            header('WWW-Authenticate: Basic realm="'. $settings->authName->getValue() .'"');
            header('HTTP/1.0 401 Unauthorized');
            self::clearSession();
        } endif
    }

    public function logout()
    {
        $view = new View('@LoginHttpAuth/logout');
        return $view->render();
    }
}
