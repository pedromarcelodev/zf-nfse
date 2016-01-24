<?php

namespace NFSe;

/**
 * 
 * @package NFSe
 */
return array(
    "nfse" => array(
        "xml" => array(
            "map" => array(
                "entities" => include __DIR__ . "/entities.map.php",
                "factories" => include __DIR__ . "/factories.map.php",
                "formatters" => include __DIR__ . "/formatters.map.php",
            ),
        ),
    ),
);