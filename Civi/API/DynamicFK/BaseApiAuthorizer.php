<?php

namespace Civi\API\DynamicFK;

use Civi\API\Kernel;

abstract class BaseApiAuthorizer implements Authorizer {

    protected $kernel;

    public function __construct(Kernel $kernel) {
        $this->kernel = $kernel;
    }

    protected function getDelegatedAction($action) {
        switch ($action) {
            case 'get':
                // reading attachments requires reading the other entity
                return 'get';

            case 'create':
            case 'delete':
                // creating/updating/deleting an attachment requires editing
                // the other entity
                return 'create';

            default:
                return $action;
        }
    }
}
