<?php
/**
 * ZF3 book Pin Your Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/pin-your-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

$cachedConfigFile = APPLICATION_ROOT . '/data/cache/app_config.php';

if (is_file($cachedConfigFile)) {
    $config = include $cachedConfigFile;
} else {
    $config = [];

    $pattern = '{{,*.}global,{,*.}' . APPLICATION_ENV . ',{,*.}local}.php';
    $files = Glob::glob(
        APPLICATION_ROOT . '/config/autoload/' . $pattern, Glob::GLOB_BRACE
    );

    foreach ($files as $file) {
        $config = ArrayUtils::merge($config, include $file);
    }

    if (isset($config['config_cache_enabled'])
        && $config['config_cache_enabled'] === true
    ) {
        file_put_contents(
            $cachedConfigFile,
            '<?php return ' . var_export($config, true) . ';'
        );
    }
}

return new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
