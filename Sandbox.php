<?php
    /**
     * @desc Bootstrap file for VAST library
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 18.06.12 12:24
     * @version 1.0RC1
     */

    try {
        // Get VAST instance
        // Default version 3.0
        require_once 'VAST.php';
        $vast = VAST::getInstance();

        // Set params
        $vast->setSystem('VAST Data Provider');
        $vast->setTitle('Ad Title');
        $vast->setImpressions('http://www.data-provider.com/impression');
        $vast->setDuration(300); // sec

        // Set Media Files
        $vast->setMediaFilesFromArray(array(
            array(
                'source'=> 'http://www.data-provider.com/source-1',
                'width' => 600,
                'height' => 400,
                'bitrate' => 500,
                'delivery' => 'progressive',
                'mimetype' => 'video/x-flv',
            ),
            array(
                'source'=> 'http://www.data-provider.com/source-2',
                'width' => 300,
                'height' => 200,
                'bitrate' => 250,
                'delivery' => 'progressive',
                'mimetype' => 'video/mp4',
            )
        ));

        // Set error tracking link
        $vast->setErrorLink('http://www.data-provider.com/error');
        $vast->setWrapperLink('http://www.data-provider.com/wrapper');

        // Send output
        switch ($_REQUEST['task']) {
            case 'wrap':
                header ("Content-type: text/xml");
                echo $vast->wrap()->toString();
                break;
            case 'inline':
            default:
                header ("Content-type: text/xml");
                echo $vast->inline()->toString();
                break;
        }
    } catch (VASTException $e) {
        // Show error
        echo '<pre>' . $e->getMessage() . '</pre>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }