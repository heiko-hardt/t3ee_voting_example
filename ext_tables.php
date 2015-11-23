<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'HeikoHardt.' . $_EXTKEY,
	'Pi1',
	'Maintainance'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'HeikoHardt.' . $_EXTKEY,
	'Pi2',
	'Voting'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'T3EE voting example');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3eevotingexample_domain_model_topic', 'EXT:t3ee_voting_example/Resources/Private/Language/locallang_csh_tx_t3eevotingexample_domain_model_topic.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3eevotingexample_domain_model_topic');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3eevotingexample_domain_model_attendee', 'EXT:t3ee_voting_example/Resources/Private/Language/locallang_csh_tx_t3eevotingexample_domain_model_attendee.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3eevotingexample_domain_model_attendee');
