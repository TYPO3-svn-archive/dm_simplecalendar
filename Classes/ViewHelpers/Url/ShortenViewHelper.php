<?php
namespace DieMedialen\DmSimplecalendar\ViewHelpers\Url;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Kai Ratzeburg <hello@kai-ratzeburg.de>, Die Medialen
 *  (c) 2014 Salvatore Eckel <salvatore.eckel@diemedialen.de>, Die Medialen
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ShortenViewHelper.
 * 
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ShortenViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    const BITLY_API_URL = 'https://api-ssl.bitly.com/v3/shorten';
    const GOOGLE_API_URL = 'https://www.googleapis.com/urlshortener/v1/url';
    const VGD_API_URL = 'https://v.gd/create.php';

    /**
     * Shorten an url with bit.ly
     *
     * @param \string $url
     * @param \string $login
     * @param \string $apiKey
     * @return \string
     */
    protected function callBitly($url, $login, $apiKey) {
        $data = array(
            'login' => $login,
            'apiKey' => $apiKey,
            'longUrl' => $url,
            'domain' => 'bit.ly',
            'format' => 'json'
        );
        $response = $this->getData(self::BITLY_API_URL, $data);
        $responseObject = $this->parseResponseDataJSON($response);

        if($responseObject != NULL) {
            return $responseObject->data->url;
        }
        else {
            return $url;
        }
    }

    /**
     * Shorten an url with goo.gl
     *
     * @param \string $url
     * @return \string
     */
    protected function callGoogle($url) {
        $data = array(
            'longUrl' => $url
        );
        $response = $this->postData(self::GOOGLE_API_URL, $data, 'application/json');
        $responseObject = $this->parseResponseDataJSON($response);

        if($responseObject != NULL) {
            return $responseObject->id;
        }
        else {
            return $url;
        }
    }

    /**
     * Shorten an url with v.gd
     *
     * @param \string $url
     * @return \string
     */
    protected function callVGD($url) {
        $data = array(
            'url' => urlencode($url),
            'format' => 'json'
        );
        $response = $this->getData(self::VGD_API_URL, $data);
        $responseObject = $this->parseResponseDataJSON($response);

        if($responseObject != NULL) {
            return $responseObject->shorturl;
        }
        else {
            return $url;
        }
    }

    /**
     * Decode response to json object.
     *
     * @param \mixed $response
     * @return \mixed|NULL
     */
    protected function parseResponseDataJSON($response) {
        $responseObject = json_decode($response);

        if(json_last_error() == JSON_ERROR_NONE) {
            return $responseObject;
        }

        return NULL;
    }

    /**
     * Sends data via post request.
     *
     * @param \string $serviceUrl
     * @param \array $data
     * @param \string $contentType
     * @return \mixed
     */
    protected function postData($serviceUrl, array $data = array(), $contentType = 'text/plain') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $serviceUrl);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: ' . $contentType));
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * Sends data via get request.
     * 
     * @param \string $serviceUrl
     * @param \array $data
     * @return \mixed
     */
    protected function getData($serviceUrl, array $data = array()) {
        $requestData = http_build_query($data);
        return file_get_contents($serviceUrl . '?' . $requestData);
    }

    /**
     * Returns the current url.
     * 
     * @return \string
     */
    protected function getCurrentUrl() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $host = trim($_SERVER['HTTP_HOST']);
        $uri = trim($_SERVER['REQUEST_URI']);

        return $protocol . $host . $uri;
    }

    /**
     * Renders a url as short url.
     *
     * @return \string
     * @api
     */
    public function render() {
        $url = $this->getCurrentUrl();

        $settings = $this->templateVariableContainer->get('settings');
 
        if($settings['qrShortUrlProvider'] != 'none') {
            switch(strtoupper($settings['qrShortUrlProvider'])) {
                case 'GOOGLE':
                    $url = $this->callGoogle($url);
                    break;
                case 'BITLY':
                    $url = $this->callBitly($url, $settings['qrBitlyUsername'], $settings['qrBitlyApiKey']);
                    break;
                case 'VGD':
                    $url = $this->callVGD($url);
                    break;
                default:
                    break;
            }

            return $url;
        }
        else {
            return $url;
        }
    }
}
?>
