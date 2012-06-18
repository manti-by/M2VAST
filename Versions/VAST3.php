<?php
    /**
     * @desc: VAST v3.0 schema implementation
     * @todo Add multiple Ad support
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 28.05.12 12:32
     * @version 1.0a
     */

    class VAST3 extends AbstractVAST {

        /**
         * @desc Create InLine XML
         * @return object $this
         */
        public function inline() {
            // Create XML root paths
            $this->_xml = new SimpleXMLElement('<VAST></VAST>');
            $this->_xml->addAttribute('version', '3.0');

            // Create inline tag
            $inline = $this->_xml->addChild('Ad')
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
            $this->_xml = new SimpleXMLElement('<VAST></VAST>');
            $this->_xml->addAttribute('version', '3.0');

            $this->_xml->addChild('Ad')
                ->addChild('Wrapper')
                ->addChild('VASTAdTagURI', '<![CDATA[' . $this->_source . ']]>');

            return $this;
        }
    }
