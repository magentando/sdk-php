<?php
/**
 * @author Intelipost (it@intelipost.com.br)
 *
 */

class Intelipost_Settings {
    
    const PHP_VERSION = phpversion();
    const SDK_VERSION = "0.3.4";
    
    const API_URL = "https://api.intelipost.com.br/api/v1";
    const API_KEY = "d0a3b5f355e17333de5c9a15d665f3d7724b4246540012d5eb851a82db1b95a5";

    const INTELIPOST_ORIGIN_ZIP_CODE = "04037-002";
    const INTELIPOST_DESTINATION_ZIP_CODE = "04037-002";

    const INTELIPOST_DEFAULT_WIDTH = 10;
    const INTELIPOST_DEFAULT_HEIGHT = 10;
    const INTELIPOST_DEFAULT_LENGTH = 10;
    const INTELIPOST_DEFAULT_INSURANCE = 0;
    const INTELIPOST_DEFAULT_ESTIMATED_DELIVERY = 10;

    const INTELIPOST_VOLUME_BOX = "BOX";
    const INTELIPOST_VOLUME_ENVELOPE = "ENVELOPE";
}
