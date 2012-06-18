<?php
    /**
     * @desc Abstract VAST class with default set get methods
     * @todo Add multiple Ad support
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 28.05.12 16:50
     * @version 1.0
     * @abstract
     */

    abstract class AbstractVAST {

        /**
         * @desc Created XML objects
         * @var SimpleXMLElement
         */
        protected $_xml;

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
         * @desc Video Ad duration in seconds
         * @var int
         */
        protected $_duration;

        /**
         * @desc Video Ad bitrate
         * @var int
         */
        protected $_bitrate;

        /**
         * @desc Video Ad source link
         * @var string
         */
        protected $_source;

        /**
         * @desc Video Ad System
         * @var string
         */
        protected $_system;

        /**
         * @desc Video Ad Title
         * @var string
         */
        protected $_title;

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
         * @desc Ad Error Tracking pixel
         * @var string
         */
        protected $_error_handler;

        /**
         * @desc Return XML object
         * @return SimpleXMLElement
         */
        public function getXML() {
            return $this->_xml;
        }

        /**
         * @desc Render XML object to string
         * @return string
         */
        public function toString() {
            return $this->_xml->asXML();
        }

        /**
         * @desc Render XML object to string
         * @param string
         * @return string
         */
        public function toFile($fname) {
            return file_put_contents($fname, $this->toString());
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
         * @desc Get Ad duration
         * @return int
         */
        public function getDuration() {
            return $this->_duration;
        }

        /**
         * @desc Set Ad duration
         * @param int $duration
         */
        public function setDuration($duration) {
            $this->_duration = $duration;
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
         * @desc Get Ad source link
         * @return string
         */
        public function getSource() {
            return $this->_source;
        }

        /**
         * @desc Set Ad source
         * @param string $source
         */
        public function setSource($source) {
            $this->_source = $source;
        }

        /**
         * @desc Get Ad System
         * @return string
         */
        public function getSystem() {
            return $this->_system;
        }

        /**
         * @desc Set Ad System
         * @param string $system
         */
        public function setSystem($system) {
            $this->_system = $system;
        }

        /**
         * @desc Get Ad Title
         * @return string
         */
        public function getTitle() {
            return $this->_title;
        }

        /**
         * @desc Set Ad Title
         * @param string $title
         */
        public function setTitle($title) {
            $this->_title = $title;
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
         * @desc Get Ad Error Tracking pixel
         * @return string
         */
        public function getErrorHandler() {
            return $this->_error_handler;
        }

        /**
         * @desc Set Ad MIME type
         * @param string $mime_type
         */
        public function setErrorHandler($error_handler) {
            $this->_error_handler = $error_handler;
        }
    }
