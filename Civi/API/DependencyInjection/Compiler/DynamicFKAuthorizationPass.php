<?php

namespace Civi\API\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DynamicFKAuthorizationPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        // always first check if the primary service is defined
        if (!$container->has('civi_dynamic_fk_authorization')) {
            return;
        }

        $definition = $container->findDefinition('civi_dynamic_fk_authorization');

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('civi.dynamic_fk_authorizer');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addAuthorizer', array(
                new Reference($id)
            ));
        }
    }
}
