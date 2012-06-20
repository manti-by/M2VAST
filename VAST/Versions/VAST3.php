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

        private $_available_media_file_attributes = array(
            'delivery', 'type', 'width', 'height',
            'codec', 'id', 'bitrate', 'minBitrate', 'maxBitrate',
            'scalable', 'maintainAspectRatio', 'apiFramework'
        );

        /**
         * @desc Create InLine XML
         * @return object $this
         */
        public function getInline() {
            // Create XML root
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');

            // Check required fields
            $this->checkInlineRequired();
            $this->checkInlineAvailable();

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

            return $this;
        }

        /**
         * @desc Create Wrapper XML
         * @return object $this
         */
        public function getWrapper() {
            // Check required fields
            $this->checkWrapRequired();

            // Create XML root paths
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');
            $this->_xml->Ad->Wrapper->VASTAdTagURI = '<![CDATA[' . (string)$this->_wrapper_link . ']]>';

            return $this;
        }

        /**
         * @desc Check required inline fields
         * @throws VASTException
         */
        private function checkInlineRequired() {
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

        /**
         * @desc Check available inline fields attributes
         * @throws VASTException
         */
        private function checkInlineAvailable() {
            // Check MediaFiles array
            foreach ($this->_media_files as $media_file) {
                if (empty($media_file['attributes'])) {
                    $attributes = array_keys($media_file['attributes']);
                    if ($not_supported = array_diff($attributes, $media_file['attributes'])) {
                        throw new VASTException('MediaFiles attributes "'.implode(', ', $not_supported).'" by this protocol version');
                    }
                }
            }
        }

        /**
         * @desc Check required wrap fields
         * @throws VASTException
         */
        private function checkWrapRequired() {
            if (empty($this->_wrapper_link)) {
                throw new VASTException('Missing required field Wrapper Link');
            }
        }
    }
