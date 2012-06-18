<?php
    /**
     * @desc Sandbox (test) file for VAST library
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 18.06.12 12:24
     * @version 1.0a
     */

    try {
        // Get VAST instance
        // Default version 3.0
        require_once 'VAST/VAST.php';
        $vast = VAST::getInstance();

        // Set params
        $vast->setSystem('NewVASTDataProvider');
        $vast->setTitle('title');

        $vast->setSource('http://www.data-provider.com/source');
        $vast->setWidth(600);
        $vast->setHeight(400);
        $vast->setBitrate(512);
        $vast->setDuration(300);

        // Set additional params
        $vast->setDelivery('progressive');
        $vast->setMIMEType('video/x-flv');

        // Get XML result
        $xml = $vast->inline()->toString();
        $result .= '<h3>VAST3.0 Inline</h3>';
        $result .= '<pre>' . htmlentities($xml) . '</pre>';

        $xml = $vast->wrap()->toString();
        $result .= '<h3>VAST3.0 Wrapper</h3>';
        $result .= '<pre>' . htmlentities($xml) . '</pre>';
    } catch (Exception $e) {
        $result .= '<h3>Catchable Error</h3>';
        $result = '<pre>' . $e->getMessage() . '</pre>';
        $result .= '<h3>Backtrace</h3>';
        $result = '<pre>' . $e->getTraceAsString() . '</pre>';
    }
?>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="http://dx.niiar.com/lts/m2/default.css" />
    </head>
    <body>
        <div id="wrapper">
            <?php echo $result; ?>
        </div>
    </body>
</html>