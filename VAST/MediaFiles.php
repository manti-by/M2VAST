<?php
    /**
     * @desc MediaFiles object
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 18.06.12 9:48
     * @version 1.0RC1
     */

    class MediaFiles {

        /**
         * @desc Video Ad Source
         * @var string
         */
        private $_source;

        /**
         * @desc Video Ad Delivery method
         * @var string
         */
        private $_delivery;

        /**
         * @desc Video Ad MIME Type
         * @var string
         */
        private $_mime_type;

        /**
         * @desc Video Ad width
         * @var int
         */
        private $_width;

        /**
         * @desc Video Ad height
         * @var int
         */
        private $_height;

        /**
         * @desc Video Ad bitrate
         * @var int
         */
        private $_bitrate;

        /**
         * @desc Video Ad optional params OPTIONAL
         * @var array
         */
        private $_optional = array();

        /**
         * @desc Available Video Ad optional params
         * @var array
         */
        private $_optional_params_available =
            array('codec', 'id', 'bitrate', 'minBitrate', 'maxBitrate', 'scalable', 'maintainAspectRatio', 'apiFramework');

        /**
         * @desc Get Ad Source
         * @return string
         */
        public function getSource() {
            return $this->_source;
        }

        /**
         * @desc Set Ad Source
         * @param string $source
         */
        public function setSource($source) {
            $this->_source = $source;
        }

        /**
         * @desc Get Ad Delivery type
         * @return string
         */
        public function getDelivery() {
            return $this->_delivery;
        }

        /**
         * @desc Set Ad Delivery type
         * @param string $delivery
         */
        public function setDelivery($delivery) {
            $this->_delivery = $delivery;
        }

        /**
         * @desc Get Ad MIME type
         * @return string
         */
        public function getMIMEType() {
            return $this->_mime_type;
        }

        /**
         * @desc Set Ad MIME type
         * @param string $mime_type
         */
        public function setMIMEType($mime_type) {
            $this->_mime_type = $mime_type;
        }

        /**
         * @desc Get Ad width
         * @return int
         */
        public function getWidth() {
            return $this->_width;
        }

        /**
         * @desc Set Ad width
         * @param int $width
         */
        public function setWidth($width) {
            $this->_width = $width;
        }

        /**
         * @desc Get Ad height
         * @return int
         */
        public function getHeight() {
            return $this->_height;
        }

        /**
         * @desc Set Ad height
         * @param int $height
         */
        public function setHeight($height) {
            $this->_height = $height;
        }

        /**
         * @desc Get Ad bitrate
         * @return int
         */
        public function getBitrate() {
            return $this->_bitrate;
        }

        /**
         * @desc Set Ad bitrate
         * @param int $bitrate
         */
        public function setBitrate($bitrate) {
            $this->_bitrate = $bitrate;
        }

        /**
         * @desc Check required fields
         * @throws VASTException
         */
        public function checkRequired() {
            if (empty($this->_source)) {
                throw new VASTException('Missing required field MediaFiles:Source');
            }

            if (empty($this->_width)) {
                throw new VASTException('Missing required field MediaFiles:Width');
            }

            if (empty($this->_height)) {
                throw new VASTException('Missing required field MediaFiles:Height');
            }

            if (empty($this->_delivery)) {
                throw new VASTException('Missing required field MediaFiles:Delivery');
            }

            if (empty($this->_mime_type)) {
                throw new VASTException('Missing required field MediaFiles:MIME Type');
            }
        }

        /**
         * @desc Get Ad optional param
         * @param string $name OPTIONAL
         * @return mixed
         * @throws VASTException
         */
        public function getOptional($name = null) {
            if (!empty($name)) {
                if (!in_array($name, self::$_optional_params_available)) {
                    throw new VASTException('Optional param "' . $name . '" not supported by this protocol version');
                } else {
                    return $this->_optional[$name];
                }
            } else {
                return $this->_optional;
            }
        }

        /**
         * @desc Set Ad optional param
         * @param mixed $name
         * @param string $value
         * @throws VASTException
         */
        public function setOptional($name, $value = null) {
            if (is_array($name)) {
                $this->setOptionalParamsFromArray($name);
            } else {
                $this->setOptionalParam($name, $value);
            }
        }

        /**
         * @desc Set Ad optionals params from accociated array
         * @param array $data
         * @throws VASTException
         */
        private function setOptionalParamsFromArray($data) {
            foreach ($data as $name => $value) {
                $this->setOptionalParam($name, $value);
            }
        }

        /**
         * @desc Set Ad optional param
         * @param string $name
         * @param mixed $value
         * @throws VASTException
         */
        private function setOptionalParam($name, $value) {
            if (!empty($name)) {
                if (!in_array($name, $this->_optional_params_available)) {
                    throw new VASTException('Optional param "' . $name . '" not supported by this protocol version');
                } else {
                    $this->_optional[$name] = $value;
                }
            } else {
                throw new VASTException('Name of optional param could not be empty');
            }
        }
    }
