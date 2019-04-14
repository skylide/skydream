<?php
## Code php du thème...
function linkTags()
{
    $core           = core::getInstance();
    $pluginsManager = pluginsManager::getInstance();
    foreach ($core->getCss() as $k => $v) {
        if (ROOT == './' && strstr($v, 'normalize')) {
        } else {
            echo '<link href="' . $v . '" rel="stylesheet" type="text/css" />';
        }
    }
    foreach ($pluginsManager->getPlugins() as $k => $plugin)
        if ($plugin->getConfigval('activate') == 1) {
            if (ROOT == './' && $plugin->getConfigVal('activate') && $plugin->getPublicCssFile())
                echo '<link href="' . $plugin->getPublicCssFile() . '" rel="stylesheet" type="text/css" />';
            elseif (ROOT == '../' && $plugin->getConfigVal('activate') && $plugin->getAdminCssFile())
                echo '<link href="' . $plugin->getAdminCssFile() . '" rel="stylesheet" type="text/css" />';
        }
    if (ROOT == './')
        echo '<link href="' . $core->getConfigVal('siteUrl') . '/' . 'theme/' . $core->getConfigVal('theme') . '/styles.css" rel="stylesheet" type="text/css" />';
}
?>