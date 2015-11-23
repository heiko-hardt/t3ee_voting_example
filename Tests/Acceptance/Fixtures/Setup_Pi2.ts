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
    htmlTag_setParams = lang="en" dir="ltr" class="no-js"
}

page = PAGE
page {
    typeNum = 0
    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = T3eeVotingExample
        pluginName = Pi2
        vendorName = HeikoHardt
        controller = Topic
        action = list
    }
    includeJSFooterlibs.file1 = EXT:t3ee_voting_example/Resources/Public/Scripts/Vendor/jquery-1.11.3.min.js
    includeJSFooter.file2 = EXT:t3ee_voting_example/Resources/Public/Scripts/t3ee_voting_example.js
    includeCSS.file1      = EXT:t3ee_voting_example/Resources/Public/Styles/t3ee_voting_example.css
}

page.headerData.10 = TEXT
page.headerData.10.value = <script>document.documentElement.className = 'js';</script>

plugin.tx_t3eevotingexample_pi2 {
    settings.topic = 1
}