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
         * @desc Create InLine XML
         * @return object $this
         */
        public function inline() {
            // Create XML root
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');

            // Create inline tag
            $inline = $this->_xml->addChild('Ad')
                ->addChild('InLine');

            // Check required fields
            $this->checkInlineRequired();

            // Add default params
            $inline->addChild('AdSystem', $this->_system);
            $inline->addChild('AdTitle', $this->_title);

            // Set impression
            if (is_array($this->_impressions)) {
                foreach ($this->_impressions as $id => $impression) {
                    $item = $inline->addChild('Impression', '<![CDATA[' . $impression . ']]>');
                    $item->addAttribute('id', $id);
                }
            } else {
                $inline->addChild('Impression', '<![CDATA[' . $this->_impressions . ']]>');
            }

            // Add creatives
            $creatives = $inline->addChild('Creatives');
            $linear = $creatives->addChild('Creative')
                ->addChild('Linear');

            // Set media files
            $linear->addChild('Duration', gmdate('H:i:s', $this->_duration));
            $media_files = $linear->addChild('MediaFiles');
            foreach ($this->_media_files as $media_object) {
                $media_object->checkRequired();
                $media_file = $media_files->addChild('MediaFile', '<![CDATA[' . $media_object->getSource() . ']]>');

                $media_file->addAttribute('width', $media_object->getWidth());
                $media_file->addAttribute('height', $media_object->getHeight());
                $media_file->addAttribute('delivery', $media_object->getDelivery());
                $media_file->addAttribute('type', $media_object->getMIMEType());
                $media_file->addAttribute('bitrate', $media_object->getBitrate());

                // Add optional params
                $optional = $media_file->getOptional();
                if (!empty($optional)) {
                    foreach ($optional as $key => $value) {
                        $media_file->addAttribute($key, $value);
                    }
                }
            }

            // Add Error Handler
            if (!empty($this->_error_handler)) {
                $inline->addChild('Error', $this->_error_link);
            }

            return $this;
        }

        /**
         * @desc Create Wrapper XML
         * @return object $this
         */
        public function wrap() {
            // Check required fields
            $this->checkWrapRequired();

            // Create XML root paths
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');
            $this->_xml->addChild('Ad')
                ->addChild('Wrapper')
                ->addChild('VASTAdTagURI', '<![CDATA[' . $this->_wrapper_link . ']]>');

            return $this;
        }

        /**
         * @desc Check required inline fields
         * @throws VASTException
         */
        private function checkInlineRequired() {
            if (empty($this->_system)) {
                throw new VASTException('Missing required field AdSystem');
            }

            if (empty($this->_title)) {
                throw new VASTException('Missing required field AdTitle');
            }

            if (empty($this->_impressions)) {
                throw new VASTException('Missing required field Impressions');
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
