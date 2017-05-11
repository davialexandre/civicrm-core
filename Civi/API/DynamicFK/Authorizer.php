<?php

namespace Civi\API\DynamicFK;

interface Authorizer {

  public function isAuthorized($action, $entityTable, $entityId, $apiRequest);

}
