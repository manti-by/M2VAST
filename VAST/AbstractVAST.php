<?php
    /**
     * @desc Abstract VAST class with default set get methods
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
        protected $_impressions = array();

        /**
         * @desc Video Ad duration in seconds
         * @var int
         */
        protected $_duration;

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
         * @desc Ad Media Files
         * @var array
         */
        protected $_media_files = array();

        /**
         * @desc Return XML object
         * @return SimpleXMLElement
         */
        public function getXML() {
            return $this->_xml;
        }

        /**
         * @desc Render XML object to string
         * @param bool $as_formatted_xml
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

        /**
         * @desc Get Ad Media Files
         * @return string
         */
        public function getMediaFiles() {
            return $this->_media_files;
        }

        /**
         * @desc Set Ad Media Files
         * @param array $media_files
         */
        public function setMediaFiles($media_files) {
            $this->_media_files = $media_files;
        }
    }
