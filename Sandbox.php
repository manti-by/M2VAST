<?php
    /**
     * @desc Sandbox (test) file for VAST library
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 18.06.12 12:24
     * @version 1.0
     */

    // Get VAST instance
    // Default version 3.0
    require_once 'VAST.php';
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
    $xml = $vast->inline()->toString();

    echo '<code>' . $xml . '</code>';