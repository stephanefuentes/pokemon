<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'argument_resolver.service' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Controller/ArgumentValueResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Controller/ArgumentResolver/ServiceValueResolver.php';

return $this->services['argument_resolver.service'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\ServiceValueResolver(new \Symfony\Component\DependencyInjection\ServiceLocator(['AppBundle\\Controller\\FightController:playTurn' => function () {
    return ${($_ = isset($this->services['service_locator.locne12']) ? $this->services['service_locator.locne12'] : $this->load('getServiceLocator_Locne12Service.php')) && false ?: '_'};
}, 'AppBundle\\Controller\\FightController::playTurn' => function () {
    return ${($_ = isset($this->services['service_locator.locne12']) ? $this->services['service_locator.locne12'] : $this->load('getServiceLocator_Locne12Service.php')) && false ?: '_'};
}]));
