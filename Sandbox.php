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
        $vast->setImpressions(array(
            'http://www.data-provider.com/impression-1',
            'http://www.data-provider.com/impression-2'
        ));
        $vast->setDuration(300); // sec

        // Set Media Files
        $vast->setMediaFiles(array(
            array(
                'value'=> 'http://www.data-provider.com/source-1',
                'attributes' => array(
                    'width' => 600,
                    'height' => 400,
                    'delivery' => 'progressive',
                    'type' => 'video/x-flv',
                    'codec' => 'DIVX'
                )
            ),
            array(
                'value'=> 'http://www.data-provider.com/source-2',
                'attributes' => array(
                    'width' => 300,
                    'height' => 200,
                    'delivery' => 'progressive',
                    'type' => 'application/x-shockwaveflash',
                    'apiFramework' => 'VPAID',
                )
            )
        ));

        // Set Video Clicks
        $vast->setVideoClicks(array(
            'ClickThrough'=> 'http://www.data-provider.com/click-through',
            'CustomClick'=> 'http://www.data-provider.com/custom-click',
        ));

        // Set Tracking Events
        $vast->setTrackingEvents(array(
            'creativeView'=> 'http://www.data-provider.com/creative-view',
            'collapse'=> 'http://www.data-provider.com/collapse',
        ));

        // Set Ad Parameters
        $vast->setAdParameters('param-1=17&param-2:22', true);

        // Set error tracking link
        $vast->setErrorLink('http://www.data-provider.com/error');
        $vast->setWrapperLink('http://www.data-provider.com/wrapper');

        // Send output
        switch ($_REQUEST['task']) {
            case 'wrap':
                header ("Content-type: text/xml");
                echo $vast->getWrapper()->toString();
                break;
            case 'inline':
            default:
                header ("Content-type: text/xml");
                echo $vast->getInline()->toString();
                break;
        }
    } catch (VASTException $e) {
        // Show error
        echo '<pre>' . $e->getMessage() . '</pre>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }