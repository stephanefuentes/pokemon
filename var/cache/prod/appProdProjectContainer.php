<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container9sgpvux\appProdProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container9sgpvux/appProdProjectContainer.php') {
    touch(__DIR__.'/Container9sgpvux.legacy');

    return;
}

if (!\class_exists(appProdProjectContainer::class, false)) {
    \class_alias(\Container9sgpvux\appProdProjectContainer::class, appProdProjectContainer::class, false);
}

return new \Container9sgpvux\appProdProjectContainer([
    'container.build_hash' => '9sgpvux',
    'container.build_id' => 'db23fb9b',
    'container.build_time' => 1566485179,
], __DIR__.\DIRECTORY_SEPARATOR.'Container9sgpvux');
