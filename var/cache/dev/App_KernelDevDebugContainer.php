<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container5DLgh8T\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container5DLgh8T/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container5DLgh8T.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container5DLgh8T\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container5DLgh8T\App_KernelDevDebugContainer([
    'container.build_hash' => '5DLgh8T',
    'container.build_id' => 'ccb6f35a',
    'container.build_time' => 1727720821,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'Container5DLgh8T');
