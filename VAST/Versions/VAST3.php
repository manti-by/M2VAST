<?php
    /**
     * @desc: VAST v3.0 schema implementation
     * @todo Add support for multiple MediaFiles
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
            $this->checkRequired();

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

            // Set attributes
            $linear->addChild('Duration', gmdate('H:i:s', $this->_duration));
            $media_file = $linear->addChild('MediaFiles')->addChild('MediaFile');
            $media_file->addChild('width', $this->_width);
            $media_file->addChild('height', $this->_height);

            $media_file->addChild('delivery', $this->_delivery);
            $media_file->addChild('type', $this->_mime_type);

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
            // Create XML root paths
            $this->_xml = new SimpleXMLElement('<VAST></VAST>');
            $this->_xml->addAttribute('version', '3.0');

            $this->_xml->addChild('Ad')
                ->addChild('Wrapper')
                ->addChild('VASTAdTagURI', '<![CDATA[' . $this->_wrapper_link . ']]>');

            return $this;
        }

        /**
         * @desc Check required fields
         * @throws VASTException
         */
        private function checkRequired() {
            if (empty($this->_system)) {
                throw new VASTException('Missing required field AdSystem');
            }

            if (empty($this->_title)) {
                throw new VASTException('Missing required field AdTitle');
            }

            if (empty($this->_impressions)) {
                throw new VASTException('Missing required field Impressions');
            }

            if (empty($this->_width)) {
                throw new VASTException('Missing required field Width');
            }

            if (empty($this->_height)) {
                throw new VASTException('Missing required field Height');
            }

            if (empty($this->_delivery)) {
                throw new VASTException('Missing required field Delivery');
            }

            if (empty($this->_mime_type)) {
                throw new VASTException('Missing required field MIME Type');
            }
        }
    }
