<?php
    /**
     * @desc Abstract VAST class with default set get methods
     * @todo Add support for multiple MediaFiles
     * @author Alexander Chaika a.k.a. Manti
     * @author marco.manti@gmail.com
     * @link http://www.niiar.com
     * @date 28.05.12 16:50
     * @version 1.0RC1
     * @abstract
     */

    abstract class AbstractVAST {

        /**
         * @desc Created XML objects
         * @var SimpleXMLElement
         */
        protected $_xml;

        /**
         * @desc Ad Impressions
         * @var mixed
         */
        protected $_impressions;

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
        protected $_error_link;

        /**
         * @desc Video Ad Wrapper source link
         * @var string
         */
        protected $_wrapper_link;

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
         * @desc Get Ad Impressions
         * @return int
         */
        public function getImpressions() {
            return $this->_impressions;
        }

        /**
         * @desc Set Ad Impressions
         * @param mixed $impressions
         */
        public function setImpressions($impressions) {
            $this->_impressions = $impressions;
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
         * @desc Get Ad Wrapper source link
         * @return string
         */
        public function getWrapperLink() {
            return $this->_wrapper_link;
        }

        /**
         * @desc Set Ad Wrapper link
         * @param string $wrapper_link
         */
        public function setWrapperLink($wrapper_link) {
            $this->_wrapper_link = $wrapper_link;
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
         * @desc Get Ad Error Link
         * @return string
         */
        public function getErrorLink() {
            return $this->_error_link;
        }

        /**
         * @desc Set Ad Error Link
         * @param string $error_link
         */
        public function setErrorLink($error_link) {
            $this->_error_link = $error_link;
        }
    }
