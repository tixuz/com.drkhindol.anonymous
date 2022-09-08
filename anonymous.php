<?php

require_once 'anonymous.civix.php';

// phpcs:disable
use CRM_Anonymous_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function anonymous_civicrm_config(&$config)
{
    _anonymous_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function anonymous_civicrm_install()
{
    _anonymous_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function anonymous_civicrm_postInstall()
{
    _anonymous_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function anonymous_civicrm_uninstall()
{
    _anonymous_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function anonymous_civicrm_enable()
{
    _anonymous_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function anonymous_civicrm_disable()
{
    _anonymous_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function anonymous_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL)
{
    return _anonymous_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function anonymous_civicrm_entityTypes(&$entityTypes)
{
    _anonymous_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function anonymous_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * @param $op
 * @param $objectName
 * @param $objectId
 * @param $params
 */
function anonymous_civicrm_pre($op, $objectName, $objectId, &$params)
{
    {
        if ($op === 'create' && ($objectName === 'Profile')) {
            if (isFieldNotEmtpy('email-Primary', $params)) {
                return;
            }
            if (isFieldNotEmtpy('first_name', $params)) {
                return;
            }
            if (isFieldNotEmtpy('last_name', $params)) {
                return;
            }
//            if (isFieldNotEmtpy('phone-Primary-1', $params)) {
//                return;
//            }
        }
        setEmptyPrimaryEmailToAnonymous($params);
    }
}

/**
 * @param $params
 */
function setEmptyPrimaryEmailToAnonymous(&$params)
{
    $params['email-Primary'] = 'anonymous@drkhindol.com';
}

/**
 * @param $field_name
 * @param $params
 * @return bool
 */
function isFieldNotEmtpy($field_name, $params)
{
    $fieldNotEmpty = TRUE;
    if (!in_array($field_name, $params)) {
        $params[$field_name] = null;
    }
    $field = strval($params[$field_name]);
    if ($field === null || $field === "" || $field === FALSE) {
        $fieldNotEmpty = FALSE;
    }
    return $fieldNotEmpty;
}
