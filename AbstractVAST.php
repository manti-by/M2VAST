<?php
    /**
     * @desc Abstract VAST class with default set get methods
     * @author Alexander Chaika
     * @author alexander.chaika@itechart-group.com
     * @link http://www.itechart.com
     * @date 28.05.12 16:50
     * @version 1.0
     */

    abstract class AbstractVAST {
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
         * @desc Get Ad width
         * @return int
         */
        protected function getWidth() {
            return $this->_width;
        }

        /**
         * @desc Set Ad width
         * @param int $width
         */
        protected function setWidth($width) {
            $this->_width = $width;
        }

        /**
         * @desc Get Ad height
         * @return int
         */
        protected function getHeight() {
            return $this->_height;
        }

        /**
         * @desc Set Ad height
         * @param int $height
         */
        protected function setHeight($height) {
            $this->_height = $height;
        }

        /**
         * @desc Get Ad duration
         * @return int
         */
        protected function getDuration() {
            return $this->_duration;
        }

        /**
         * @desc Set Ad duration
         * @param int $duration
         */
        protected function setDuration($duration) {
            $this->_duration = $duration;
        }

        /**
         * @desc Set Ad bitrate
         * @return int
         */
        protected function getBitrate() {
            return $this->_bitrate;
        }

        /**
         * @desc Set Ad bitrate
         * @param int $bitrate
         */
        protected function setBitrate($bitrate) {
            $this->_bitrate = $bitrate;
        }
    }
