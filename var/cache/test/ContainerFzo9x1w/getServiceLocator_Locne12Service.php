<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'service_locator.locne12' shared service.

return $this->services['service_locator.locne12'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['service' => function () {
    $f = function (\AppBundle\Services\FightService $v = null) { return $v; }; return $f(${($_ = isset($this->services['AppBundle\\Services\\FightService']) ? $this->services['AppBundle\\Services\\FightService'] : $this->load('getFightServiceService.php')) && false ?: '_'});
}]);