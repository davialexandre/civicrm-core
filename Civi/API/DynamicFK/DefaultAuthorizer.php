<?php

namespace Civi\API\DynamicFK;

class DefaultAuthorizer extends BaseApiAuthorizer {

    public function isAuthorized($action, $entity, $entityId, $apiRequest) {
        $params = array(
            'version' => 3,
            'check_permissions' => 1,
            'id' => $entityId,
        );

        return $this->kernel->runAuthorize($entity, $this->getDelegatedAction($action), $params);
    }
}
