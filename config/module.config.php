<?php

namespace NFSe;

/**
 * 
 * @package NFSe
 */
return array(
    "controllers" => array(
        "invokables" => array(),
    ),

    // The following section is new and should be added to your file
    "router" => array(
        "routes" => array(),
    ),

    "view_manager" => array(
        "template_path_stack" => array(
            "nfse" => __DIR__ . "/../view",
        ),
    ),

    "nfse" => array(
        "xml" => array(
            "map" => array(
                "entities" => include __DIR__ . "/xmlentities.map.php",
                "factories" => include __DIR__ . "/xmlfactories.map.php",
            ),
        ),
        "pattern_manager" => array(
            "date" => array(
                "type" => "datetime",
                "pattern" => "Y-m-d",
            ),
            "datetime" => array(
                "type" => "datetime",
                "pattern" => "Y-m-d\TH:i:s",
            ),
            "decimal" => array(
                "type" => "float",
                "pattern" => "+9.99",
            ),
            "percent" => array(
                "type" => "float",
                "pattern" => "+9.9999",
            ),
        ),
    ),
);