<?php

namespace NFSe;

/**
 * 
 * @package NFSe
 */
return array(
    "service_manager" => array(
        "factories" => array(
            "NFSe\Formatter\Date" => function ($serviceManager) {
                $datetimeFormatter = new Formatter\DateTimeFormatter();
                $datetimeFormatter->setPattern("Y-m-d");
                return $datetimeFormatter;
            },
            "NFSe\Formatter\DateTime" => function ($serviceManager) {
                $datetimeFormatter = new Formatter\DateTimeFormatter();
                $datetimeFormatter->setPattern("Y-m-d\TH:i:s");
                return $datetimeFormatter;
            },
            "NFSe\Formatter\Decimal" => function ($serviceManager) {
                $decimalFormatter = new Formatter\DecimalFormatter();
                $decimalFormatter->setPattern('+9.99');
                return $decimalFormatter;
            },
            "NFSe\Formatter\Percentual" => function ($serviceManager) {
                $decimalFormatter = new Formatter\DecimalFormatter();
                $decimalFormatter->setPattern('9.9999');
                return $decimalFormatter;
            },
            "NFSe\Formatter\Number" => function($serviceManager) {
                return new Formatter\NumberFormatter();
            },
            "NFSe\Formatter\NFSeNumber" => function($serviceManager) {
                return new Formatter\SimpleType\NfseNumberFormatter();
            },
            "NFSe\Formatter\VerificationCode" => function($serviceManager) {
                return new Formatter\SimpleType\VerificationCodeFormatter();
            },
        ),
    ),
    "nfse" => array(
        "xml" => array(
            "map" => array(
                "entities" => include __DIR__ . "/xmlentities.map.php",
                "factories" => include __DIR__ . "/xmlfactories.map.php",
            ),
        ),
    ),
);