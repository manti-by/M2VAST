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
         * @desc Video Ad ID
         * @var mixed
         */
        protected $_id;

        /**
         * @desc Video Ad Source
         * @var string
         */
        protected $_source;

        /**
         * @desc Video Ad Delivery method
         * @var string
         */
        protected $_delivery;

        /**
         * @desc Video Ad MIME Type
         * @var string
         */
        protected $_mime_type;

        /**
         * @desc Video Ad width
         * @var int
         */
        protected $_width;

        /**
         * @desc Video Ad height
         * @var int
         */
        protected $_height;

        /**
         * @desc Video Ad bitrate
         * @var int
         */
        protected $_bitrate;

        /**
         * @desc Get Ad ID
         * @return string
         */
        public function getId() {
            return $this->_id;
        }

        /**
         * @desc Set Ad ID
         * @param string $id
         */
        public function setId($id) {
            $this->_id = $id;
        }

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
    }
