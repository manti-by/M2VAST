<?php
    /**
     * @desc: VAST v3.0 schema implementation
     * @todo Add multiple Ad support
     * @author Alexander Chaika
     * @author alexander.chaika@itechart-group.com
     * @link http://www.itechart.com
     * @date 28.05.12 12:32
     * @version 1.0
     */

    class VAST3 extends VAST {

        /**
         * @desc Create InLine XML
         * @return object $this
         */
        public function inline() {
            // Create XML root paths
            $this->_xml = new SimpleXMLElement(null);
            $inline = $this->_xml->addChild('VAST')
                ->addAttribute('version', '3.0')
                ->addChild('Ad')
                ->addChild('InLine');

            // Add default params
            $inline->addChild('AdSystem', $this->_system);
            $inline->addChild('AdTitle', $this->_title);

            // Set impression
            $inline->addChild('Impression', '<![CDATA[' . $this->_source . ']]>');

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

            return $this;
        }

        /**
         * @desc Create Wrapper XML
         * @return object $this
         */
        public function wrap() {
            // Create XML root paths
            $this->_xml = new SimpleXMLElement(null);
            $this->_xml->addChild('VAST')
                ->addAttribute('version', '3.0')
                ->addChild('Ad')
                ->addChild('Wrapper')
                ->addChild('VASTAdTagURI', '<![CDATA[' . $this->_source . ']]>');

            return $this;
        }
    }
