<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HeikoHardt.' . $_EXTKEY,
    'Maintenance',
    array(
        'Topic' => 'list, show, new, create, edit, update, delete',

    ),
    // non-cacheable actions
    array(
        'Topic' => 'create, update, delete',

    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HeikoHardt.' . $_EXTKEY,
    'Voting',
    array(
        'Topic' => 'list, show, new, create, edit, update, delete',

    ),
    // non-cacheable actions
    array(
        'Topic' => 'create, update, delete',

    )
);
