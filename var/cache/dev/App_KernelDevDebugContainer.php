<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerIcYxVZs\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerIcYxVZs/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerIcYxVZs.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerIcYxVZs\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerIcYxVZs\App_KernelDevDebugContainer([
    'container.build_hash' => 'IcYxVZs',
    'container.build_id' => 'd72b7fb3',
    'container.build_time' => 1727792690,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerIcYxVZs');
