<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 5                                                  |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2018                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2018
 */

use AppBundle\Service\ResourcesBag;

/**
 * Drupal specific stuff goes here
 */
class CRM_Utils_System_Symfony extends CRM_Utils_System_Base {

  private $resourcesBag;
  
  public function setResourcesBag(ResourcesBag $resourcesBag)
  {
    $this->resourcesBag = $resourcesBag;
  }
  
  public function getLoginURL($destination = '') {
    return '/';
  }
  
  public function getDefaultFileStorage() {
    global $civicrm_root;
    $config = CRM_Core_Config::singleton();
    $baseURL = CRM_Utils_System::languageNegotiationURL($config->userFrameworkBaseURL, FALSE, TRUE);

    return array(
      'url' => $baseURL . '/files',
      'path' => CRM_Utils_File::baseFilePath(),
    );
  }
  
  /**
   * Add a css file.
   *
   * Note: This function is not to be called directly
   * @see CRM_Core_Region::render()
   *
   * @param string $url absolute path to file
   * @param string $region
   *   location within the document: 'html-header', 'page-header', 'page-footer'.
   *
   * @return bool
   *   TRUE if we support this operation in this CMS, FALSE otherwise
   */
  public function addStyleUrl($url, $region) {
    dump([$url, $region]);
    
    $this->resourcesBag->addStylesheet($url, $region);
    
    return TRUE;
  }
  
  /**
   * Add a script file.
   *
   * Note: This function is not to be called directly
   * @see CRM_Core_Region::render()
   *
   * @param string $url absolute path to file
   * @param string $region
   *   location within the document: 'html-header', 'page-header', 'page-footer'.
   *
   * @return bool
   *   TRUE if we support this operation in this CMS, FALSE otherwise
   */
  public function addScriptUrl($url, $region) {
    dump([$url, $region]);
    
    $this->resourcesBag->addJavascript($url, $region);
    return TRUE;
  }
}
