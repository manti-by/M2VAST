<?php
    /**
     * @desc: VAST fabric class for protocols versions 2.0 and 3.0
     * @todo Add support for version 2.0
     * @author Alexander Chaika
     * @author alexander.chaika@itechart-group.com
     * @link http://www.itechart.com
     * @date 28.05.12 12:02
     * @version 1.0
     */

    require_once 'AbstractVAST.php';

    class VAST extends AbstractVAST {

        /**
         * @desc Default VAST version
         * @var int
         */
        private static $_default_version = 3;

        /**
         * @desc Supported versions
         * @var array
         */
        private static $_available_versions = array(3);

        /**
         * @desc Get default VAST object (currently version 3)
         * @return object
         */
        public static function getInstance() {
            return self::getByVersion(self::$_default_version);
        }

        /**
         * @desc Get VAST object by version
         * @param int $version
         * @return object
         */
        public static function getByVersion($version) {
            if (in_array($version, self::_available_vesions)) {
                $class_name = 'VAST' . $version;
                if (file_exists('Versions' . DIRECTORY_SEPARATOR . $class_name . '.php')) {
                    include_once 'Versions' . DIRECTORY_SEPARATOR . $class_name . '.php';
                    return new $class_name;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }