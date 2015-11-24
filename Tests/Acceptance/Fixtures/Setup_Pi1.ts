config {
    no_cache = 1
    uniqueLinkVars = 1
    renderCharset = utf-8
    metaCharset = utf-8
    doctype = html5
    removeDefaultJS = external
    admPanel = 0
    debug = 0
    sendCacheHeaders = 0
    sys_language_uid = 0
}

page = PAGE
page {
    typeNum = 0
    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = T3eeVotingExample
        pluginName = Pi1
        vendorName = HeikoHardt
        controller = Topic
        action = list
    }

    includeJSlibs.file1 = EXT:t3ee_voting_example/Resources/Public/Scripts/Vendor/jquery-1.11.3.min.js
    includeJS.file2 = EXT:t3ee_voting_example/Resources/Public/Scripts/t3ee_voting_example.min.js
}
