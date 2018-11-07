<!doctype html>
<?php
include_once 'config/config.php';
require 'vendor/autoload.php';
session_start();
?>

<html lang="de">
    <head>
        <title>TicSys</title>
        <meta name="description" content="TicSys ist eine Applikation zum Vertrieb von Event-Eintrittskarten.">
        <meta name="author" content="Marc Jenzer">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="/css/application.css">
        <script src="/js/vendor/jquery-3.2.1.min.js"></script>
        <script src="/js/application.js"></script>
        <script src="/js/timer.js"></script>
    </head>
    <body onload="setDateTime()">

        <div id="wrap">
            <div id="header">
                <div id="logo">
                    <a href="/home"><img src="/images/logo-white.png" alt="TicSys Logo" width="295" height="70" /></a>
                </div>
                <div id="meta-navigation">
                    <ul>
                        <?php
                        $metaMenu = getMetaMenu();
                        $metaMenuCount = count($metaMenu);
                        $counter = 0;
                        foreach ($metaMenu as $href => $title) {
                            $counter += 1;
                            if (($href == URI_LOGIN) && (!empty($_SESSION['user_name']))) { // logged in
                                echo "<li><strong>{$_SESSION['customer_name']}</strong> <a href=\"" . URI_LOGOUT . "\">Logout</a>";
                            } else {
                                echo "<li><a href=\"$href\">$title</a>";
                            }

                            if ($counter < $metaMenuCount) {
                                echo "|";
                            }
                            echo "</li>\n";
                        }
                        ?>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>

            <div id="menu">
                <ul>
                    <?php
                    $currentUri = getCurrentURI();
                    foreach (getMenu() as $href => $title) {
                        echo "<li><a href=\"$href\" " . (($href == $currentUri) ? "class=\"selected\" " : "") . ">$title</a></li>\n";
                    }
                    ?>
                </ul>
            </div>

            <div id="content">
                <?php
                $controller = null;
                switch (getCurrentURI()) {
                    case URI_EVENTS:
                        include_once 'controller/EventController.php';
                        $controller = new EventController();
                        break;
                    case URI_FAQ:
                        include_once 'controller/FAQController.php';
                        $controller = new FAQController();
                        break;
                    case URI_KONTAKT:
                        include_once 'controller/ContactController.php';
                        $controller = new ContactController();
                        break;
                    case URI_REGISTRATION:
                        include_once 'controller/RegistrationController.php';
                        $controller = new RegistrationController();
                        break;
                    case URI_LOGIN:
                        include_once 'controller/LoginController.php';
                        $controller = new LoginController();
                        break;
                    case URI_LOGOUT:
                        include_once 'controller/LogoutController.php';
                        $controller = new LogoutController();
                        break;
                    default :
                        include_once 'controller/HomeController.php';
                        $controller = new HomeController();
                        break;
                }
                if ($controller != null) {
                    $controller->route();
                }
                ?>
            </div>

            <div id="footer">
                <p>Copyright &copy; 2017 TicSys, <span id="datetime"><?php echo date("d.m.Y H:i:s"); ?></span></p>
            </div>
        </div>
        <a id="feedback" href="<?php echo URI_KONTAKT ?>"><img src="/images/feedback.png" border="0"></a>
    </body>
</html>
<?php

/**
 * @return array containing all menu items in format [base href] => [title]
 */
function getMenu() {
    return array(
        URI_HOME => 'Home',
        URI_EVENTS => 'Events',
        URI_FAQ => 'FAQ',
        URI_KONTAKT => 'Kontakt'
    );
}

/**
 * @return array containing all meta menu items in format [base href] => [title]
 */
function getMetaMenu() {
    return array(
        URI_LOGIN => 'Login',
        URI_REGISTRATION => 'Registration'
    );
}

function getSpecialRoutes() {
    return array(URI_LOGOUT);
}

/**
 * @return string the requested menu item URI
 */
function getCurrentURI() {
    $menu = getMenu();
    $metaMenu = getMetaMenu();
    if ((array_key_exists($_SERVER['REQUEST_URI'], $menu)) ||
            (array_key_exists($_SERVER['REQUEST_URI'], $metaMenu)) || 
            (in_array($_SERVER['REQUEST_URI'], getSpecialRoutes()))) {
        return $_SERVER['REQUEST_URI'];
    } else {
        foreach (array_merge(array_keys($menu), array_keys($metaMenu)) as $href) {
            if (preg_match("@^$href@", $_SERVER['REQUEST_URI'])) {
                return $href;
            }
        }
    }
    return key($menu);
}
?>