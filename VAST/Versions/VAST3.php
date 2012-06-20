<?php
    /**
     * @desc: VAST v3.0 schema implementation
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 28.05.12 12:32
     * @version 1.0RC1
     */

    class VAST3 extends AbstractVAST {

        /**
         * @desc Available Media File attributes
         * @var array
         */
        private $_available_media_file_attributes = array(
            'delivery', 'type', 'width', 'height',
            'codec', 'id', 'bitrate', 'minBitrate', 'maxBitrate',
            'scalable', 'maintainAspectRatio', 'apiFramework'
        );

        /**
         * @desc Available Video Clicks
         * @var array
         */
        private $_available_video_clicks = array(
            'ClickThrough', 'ClickTracking', 'CustomClick'
        );

        /**
         * @desc Available Tracking Events
         * @var array
         */
        private $_available_tracking_events = array(
            'creativeView', 'start', 'firstQuartile', 'midpoint',
            'thirdQuartile', 'complete', 'mute', 'unmute', 'pause',
            'rewind', 'resume', 'fullscreen',  'exitFullscreen',
            'expand', 'collapse', 'acceptInvitation', 'close',
            'skip', 'progress'
        );

        /**
         * @desc Create InLine XML
         * @return object $this
         */
        public function getInline() {
            // Create XML root
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');

            // Check required fields
            $this->validateInline();

            // Add default params
            $this->_xml->Ad->InLine->AdSystem = (string)$this->_system;
            $this->_xml->Ad->InLine->AdTitle = (string)$this->_title;

            // Set impression
            if (is_array($this->_impressions)) {
                foreach ($this->_impressions as $id => $impression) {
                    $this->_xml->Ad->InLine
                        ->Impression[$id] = '<![CDATA[' . (string)$impression . ']]>';
                    $this->_xml->Ad->InLine
                        ->Impression[$id]->addAttribute('id', (string)$id);
                }
            } else {
                $this->_xml->Ad->InLine->Impression = '<![CDATA[' . (string)$this->_impressions . ']]>';
            }

            // Set media files
            $this->_xml->Ad->InLine->Creatives->Creative
                ->Linear->Duration = (string)gmdate('H:i:s', $this->_duration);
            foreach ($this->getMediaFiles() as $id => $media_file) {
                $this->_xml->Ad->InLine->Creatives->Creative
                    ->Linear->MediaFiles->MediaFile[$id] = $media_file['value'];

                foreach ($media_file['attributes'] as $name => $value) {
                    $this->_xml->Ad->InLine->Creatives
                        ->Creative->Linear->MediaFiles->MediaFile[$id]->addAttribute($name, $value);
                }
            }

            // Add Error Handler
            if (!empty($this->_error_handler)) {
                $this->_xml->Ad->InLine->Error = (string)$this->_error_link;
            }

            // Add Video Clicks
            if (!empty($this->_video_clicks)) {
                if (!empty($this->_video_clicks['ClickThrough'])) {
                    $this->_xml->Ad->InLine->Creatives->Creative
                        ->Linear->VideoClicks->ClickThrough = $this->_video_clicks['ClickThrough'];
                }

                if (!empty($this->_video_clicks['ClickTracking'])) {
                    $this->_xml->Ad->InLine->Creatives->Creative
                        ->Linear->VideoClicks->ClickTracking = $this->_video_clicks['ClickTracking'];
                }

                if (!empty($this->_video_clicks['CustomClick'])) {
                    $this->_xml->Ad->InLine->Creatives->Creative
                        ->Linear->VideoClicks->CustomClick = $this->_video_clicks['CustomClick'];
                }
            }

            // Add Tracking Events
            if (!empty($this->_tracking_events)) {
                foreach ($this->_tracking_events as $name => $value) {
                     $this->_xml->Ad->InLine->Creatives->Creative
                         ->Linear->TrackingEvents->$name = $value;
                }
            }

            // Add Ad Parameters
            if (!empty($this->_ad_parameters)) {
                $xml_encoded = 'false';
                if (isset($this->_ad_parameters['xmlEncoded'])) {
                    $ad_parameters = htmlentities($this->_ad_parameters['value']);
                    $xml_encoded = 'true';
                }

                $this->_xml->Ad->InLine->Creatives->Creative
                    ->Linear->AdParameters = '<![CDATA[' . $ad_parameters . ']]>';

                $this->_xml->Ad->InLine->Creatives->Creative
                    ->Linear->AdParameters->addAttribute('xmlEncoded', $xml_encoded);
            }

            return $this;
        }

        /**
         * @desc Create Wrapper XML
         * @return object $this
         */
        public function getWrapper() {
            // Check required fields
            $this->validateWrapper();

            // Create XML root paths
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');
            $this->_xml->Ad->Wrapper->VASTAdTagURI = '<![CDATA[' . (string)$this->_wrapper_link . ']]>';

            return $this;
        }

        /**
         * @desc Check required inline fields
         * @throws VASTException
         */
        private function validateInline() {
            //// REQUIRED ELEMENTS ////
            // Check basic fields
            if (empty($this->_system)) {
                throw new VASTException('Missing required field AdSystem');
            }

            if (empty($this->_title)) {
                throw new VASTException('Missing required field AdTitle');
            }

            if (empty($this->_impressions)) {
                throw new VASTException('Missing required field Impressions');
            }

            // Check MediaFiles array
            if (empty($this->_media_files) || count($this->_media_files) == 0) {
                throw new VASTException('At least one MediaFile need to be set');
            } else {
                foreach ($this->_media_files as $media_file) {
                    if (empty($media_file['value'])) {
                        throw new VASTException('Missing required field MediaFiles:Value');
                    }

                    if (empty($media_file['attributes']['width'])) {
                        throw new VASTException('Missing required attribute MediaFiles:Width');
                    }

                    if (empty($media_file['attributes']['height'])) {
                        throw new VASTException('Missing required attribute MediaFiles:Height');
                    }

                    if (empty($media_file['attributes']['delivery'])) {
                        throw new VASTException('Missing required attribute MediaFiles:Delivery');
                    }

                    if (empty($media_file['attributes']['type'])) {
                        throw new VASTException('Missing required attribute MediaFiles:MIME Type');
                    }
                }
            }

            // Check Video Clicks format
            if (!empty($this->_video_clicks) && !is_array($this->_video_clicks)) {
                throw new VASTException('Video Clicks must be an array');
            }

            // Check Tracking Events format
            if (!empty($this->_tracking_events) && !is_array($this->_tracking_events)) {
                throw new VASTException('Tracking Events must be an array');
            }

            //// AVAILABLE ELEMENTS ////

            // Check MediaFiles array
            foreach ($this->_media_files as $media_file) {
                if (empty($media_file['attributes'])) {
                    $attributes = array_keys($media_file['attributes']);
                    if ($not_supported = array_diff($attributes, $media_file['attributes'])) {
                        throw new VASTException('MediaFiles attributes "'.implode(', ', $not_supported).'" not supported by this protocol version');
                    }
                }
            }

            // Check Video clicks
            if (!empty($this->_video_clicks)) {
                $video_clicks = array_keys($this->_video_clicks);
                if ($not_supported = array_diff($video_clicks, $this->_available_video_clicks)) {
                    throw new VASTException('Video Clicks "'.implode(', ', $not_supported).'" not supported by this protocol version');
                }
            }

            // Check Tracking Events
            if (!empty($this->_tracking_events)) {
                $tracking_events = array_keys($this->_tracking_events);
                if ($not_supported = array_diff($tracking_events, $this->_available_tracking_events)) {
                    throw new VASTException('Tracking Events "'.implode(', ', $not_supported).'" not supported by this protocol version');
                }
            }

            //// DEPENDENCIES ELEMENTS ////
            $check_ad_params = true;
            foreach ($this->_media_files as $media_file) {
                if ($media_file['attributes']['type'] == 'application/x-shockwaveflash' &&
                    $media_file['attributes']['apiFramework'] != 'VPAID') {
                        throw new VASTException('You must set "apiFramework" attribute for all flash ads');
                }

                if ($media_file['attributes']['type'] == 'application/x-shockwaveflash' &&
                    $media_file['attributes']['apiFramework'] == 'VPAID') {
                        $check_ad_params = false;
                }
            }

            if ($check_ad_params && !empty($this->_ad_parameters)) {
                throw new VASTException('AdParameters not supported for all types of ads you set');
            }
        }

        /**
         * @desc Check required wrap fields
         * @throws VASTException
         */
        private function validateWrapper() {
            if (empty($this->_wrapper_link)) {
                throw new VASTException('Missing required field Wrapper Link');
            }
        }
    }
