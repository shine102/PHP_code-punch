<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'kali/php_web',
        'dev' => true,
    ),
    'versions' => array(
        'heroku/heroku-buildpack-php' => array(
            'pretty_version' => 'v199',
            'version' => '199.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../heroku/heroku-buildpack-php',
            'aliases' => array(),
            'reference' => '1a4e5d3ffe128f8eb8a17e50616462d3c804e11f',
            'dev_requirement' => true,
        ),
        'kali/php_web' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
    ),
);
