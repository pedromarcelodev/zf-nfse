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
        "pattern" => array(
            "date" => "Y-m-d",
            "datetime" => "Y-m-d\TH:i:s",
            "decimal" => "+9.99",
            "percent" => "+9.9999",
        ),
    ),
);