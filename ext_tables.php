<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);


$pluginSignature_simplecalendar = strtolower($extensionName) . '_simplecalendar';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature_simplecalendar] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature_simplecalendar, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForm/simplecalendar.xml');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Simplecalendar',
    'DmSimpleCalendar'
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'SimpleCalendar');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dmsimplecalendar_domain_model_appointment', 'EXT:dm_simplecalendar/Resources/Private/Language/locallang_csh_tx_dmsimplecalendar_domain_model_appointment.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dmsimplecalendar_domain_model_media', 'EXT:dm_simplecalendar/Resources/Private/Language/locallang_csh_tx_dmsimplecalendar_domain_model_media.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dmsimplecalendar_domain_model_calendar', 'EXT:dm_simplecalendar/Resources/Private/Language/locallang_csh_tx_dmsimplecalendar_domain_model_calendar.xlf');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dmsimplecalendar_domain_model_appointment');
// the next two can be remvoved?
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dmsimplecalendar_domain_model_media');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dmsimplecalendar_domain_model_calendar');


$GLOBALS['TCA']['tx_dmsimplecalendar_domain_model_appointment'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_appointment',
        'label' => 'startdate',
        'label_alt' => 'title',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'default_sortby' => 'ORDER BY startdate ASC',

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title,location,description,shortdescription,startdate,enddate,calendar,media,categories,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Appointment.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dmsimplecalendar_domain_model_appointment.gif'
    ),
);
$GLOBALS['TCA']['tx_dmsimplecalendar_domain_model_media'] = array(
    'ctrl' => array(
        'hideTable' => TRUE,
        'title' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_media',
        // How to use custom string here?
        'label' => '',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'files,images,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Media.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dmsimplecalendar_domain_model_media.gif'
    ),
);
$GLOBALS['TCA']['tx_dmsimplecalendar_domain_model_calendar'] = array(
    'ctrl' => array(
        'hideTable' => TRUE,
        'title'    => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_calendar',
        'label' => 'appointments',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'appointments,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Calendar.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dmsimplecalendar_domain_model_calendar.gif'
    ),
);


//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
if (!isset($GLOBALS['TCA']['sys_category']['ctrl']['type'])) {
    if (file_exists($GLOBALS['TCA']['sys_category']['ctrl']['dynamicConfigFile'])) {
        require_once($GLOBALS['TCA']['sys_category']['ctrl']['dynamicConfigFile']);
    }
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['sys_category']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumns = array();
    $tempColumns[$GLOBALS['TCA']['sys_category']['ctrl']['type']] = array(
        'exclude' => 1,
        'label'   => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar.tx_extbase_type',
        'config' => array(
            'type' => 'select',
            'items' => array(),
            'size' => 1,
            'maxitems' => 1,
        )
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $tempColumns, 1);
}

$tmp_dm_simplecalendar_columns = array(
    'color' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_category.color',
        'config' => array(
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ),
    ),
    'appointment' => array(
        'config' => array(
            'type' => 'passthrough',
        )
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category',$tmp_dm_simplecalendar_columns);

$GLOBALS['TCA']['sys_category']['types']['Tx_DmSimplecalendar_Category']['showitem'] = $TCA['sys_category']['types']['1']['showitem'];
$GLOBALS['TCA']['sys_category']['types']['Tx_DmSimplecalendar_Category']['showitem'] .=
    ',--div--;LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:tx_dmsimplecalendar_domain_model_category.color,color';

$GLOBALS['TCA']['sys_category']['columns'][$TCA['sys_category']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang_db.xlf:sys_category.tx_extbase_type.Tx_DmSimplecalendar_Category','Tx_DmSimplecalendar_Category');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', $GLOBALS['TCA']['sys_category']['ctrl']['type'],'','after:' . $TCA['sys_category']['ctrl']['label']);
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    $_EXTKEY,
    'tx_dmsimplecalendar_domain_model_appointment',

    $fieldName = 'categories',

    $options = array(
        'label' => 'LLL:EXT:dm_simplecalendar/Resources/Private/Language/locallang.xlf:tx_dmsimplecalendar_domain_model_appointment.categories',
        'exclude' => FALSE,
        // ordering etc
        'fieldConfiguration' => array(
            'foreign_table_where' => ' AND sys_category.tx_extbase_type = "Tx_DmSimplecalendar_Category" ORDER BY sys_category.title ASC',
            //'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
        )
    )
);

?>