<?php

namespace Civi\API\DynamicFK;

class LegacyAuthorizer extends BaseApiAuthorizer {

    public function isAuthorized($action, $entity, $entityId, $apiRequest) {

        /**
         * @var \Exception $exception
         */
        $exception = NULL;
        $self = $this;
        \CRM_Core_Transaction::create(TRUE)->run(function($tx) use ($entity, $action, $entityId, &$exception, $self) {
            $tx->rollback(); // Just to be safe.

            $params = array(
                'version' => 3,
                'check_permissions' => 1,
                'id' => $entityId,
            );

            $result = $self->kernel->run($entity, $self->getDelegatedAction($action), $params);
            if ($result['is_error'] || empty($result['values'])) {
                $exception = new \Civi\API\Exception\UnauthorizedException("Authorization failed on ($entity,$entityId)", array(
                    'cause' => $result,
                ));
            }
        });

        if ($exception) {
            return false;
        }

        return true;
    }
}
