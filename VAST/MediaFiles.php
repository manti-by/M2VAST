<?php
    /**
     * @desc MediaFiles object
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 18.06.12 9:48
     * @version 1.0RC1
     */

    class MediaFile {

        /**
         * @desc XML object
         * @var SimpleXMLElement
         */
        private $_xml;

        /**
         * @desc XML string
         * @var string
         */
        private $_xml_string;

        /**
         * @desc Video Ad Source
         * @var string
         */
        private $_source;

        /**
         * @desc Video Ad optional params OPTIONAL
         * @var array
         */
        private $_attributes = array();

        /**
         * @desc Available Video Ad optional params
         * @var array
         */
        private $_attributes_available = array(
            'delivery', 'type', 'width', 'height', 'codec', 'id', 'bitrate',
            'minBitrate', 'maxBitrate', 'scalable', 'maintainAspectRatio', 'apiFramework'
        );

        /**
         * @desc Get Ad optional param
         * @return SimpleXMLElement
         */
        private function _compile() {
            $this->_xml = new SimpleXMLElement('<MediaFile><![CDATA[' . (string)$this->_source . ']]></MediaFile>');

            if (!empty($this->_attributes)) {
                foreach ($this->_attributes as $key => $value) {
                    $this->_xml->addAttribute($key, (string)$value);
                }
            }
            return $this->_xml;
        }

        /**
         * @desc Get XML Object
         * @return SimpleXMLElement
         */
        public function getXML() {
            if ($this->_xml instanceof SimpleXMLElement) {
                return $this->_xml;
            } else {
                return $this->_compile();
            }
        }

        /**
         * @desc Get XML string
         * @param bool $as_formatted_xml OPTIONAL
         * @return string
         */
        public function toString($as_formatted_xml = true) {
            $this->_xml_string = $this->getXML()->asXML();
            if ($as_formatted_xml) {
                return $this->_xml_string;
            } else {
                return str_replace('<?xml version="1.0"?>', '', $this->_xml_string);
            }
        }

        /**
         * @desc Get Media File Source
         * @return string
         */
        public function getValue() {
            return $this->_value;
        }

        /**
         * @desc Set Media File Source
         * @param string $value
         */
        public function setValue($value) {
            $this->_value = $value;
        }

        /**
         * @desc Get Media File Attributes
         * @return string
         */
        public function getAttributes() {
            return $this->_attributes;
        }

        /**
         * @desc Set Media File Attributes
         * @param mixed $name
         * @param string $value OPTIONAL
         */
        public function setAttributes($name, $value = null) {
            if (is_array($name)) {
                $this->setAttributesFromArray($name);
            } else {
                $this->setAttribute($name, $value);
            }
        }

        /**
         * @desc Set Media File from accociated array
         * @param array $data
         */
        private function setAttributesFromArray($data) {
            foreach ($data as $name => $value) {
                $this->setAttribute($name, $value);
            }
        }

        /**
         * @desc Set Media File Attribute
         * @param string $name
         * @param mixed $value
         * @throws VASTException
         */
        private function setAttribute($name, $value) {
            if (!empty($name)) {
                if (!in_array($name, $this->_attributes_available)) {
                    throw new VASTException('Attribute for MediaFile - "' . $name . '" not supported by this protocol version');
                } else {
                    $this->_attributes[$name] = $value;
                }
            } else {
                throw new VASTException('Name of attribute could not be empty');
            }
        }

        /**
         * @desc Check required fields
         * @throws VASTException
         */
        public function checkRequired() {
            if (empty($this->_value)) {
                throw new VASTException('Missing required field MediaFiles:Source');
            }

            if (empty($this->_attributes['width'])) {
                throw new VASTException('Missing required attribute MediaFiles:Width');
            }

            if (empty($this->_attributes['height'])) {
                throw new VASTException('Missing required attribute MediaFiles:Height');
            }

            if (empty($this->_attributes['delivery'])) {
                throw new VASTException('Missing required attribute MediaFiles:Delivery');
            }

            if (empty($this->_attributes['type'])) {
                throw new VASTException('Missing required attribute MediaFiles:MIME Type');
            }
        }
    }
