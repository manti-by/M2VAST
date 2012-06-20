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
        public function getInline() {
            // Create XML root
            $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><VAST version="3.0"></VAST>');

            // Check required fields
            $this->checkInlineRequired();

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
            foreach ($this->getMediaFiles() as $id => $object) {
                $this->_xml->Ad->InLine->Creatives->Creative
                    ->Linear->MediaFiles->MediaFile[$id] = $object->getValue();

                $attributes = $object->getAttributes();
                foreach ($attributes as $name => $value) {
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
