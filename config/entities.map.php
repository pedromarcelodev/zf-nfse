<?php

namespace NFSe;

return array(
    "TsNumeroNfse" => array(
        "class" => "NFSe\XML\Entity\SimpleType\NfseNumber",
        "formatter" => "NFSe\Formatter\NFSeNumber",
    ),
    "tsCodigoVerificacao" => array(
        "class" => "NFSe\XML\Entity\SimpleType\VerificationCode",
        "formatter" => "NFSe\Formatter\VerificationCode",
    ),
    "TsStatusRps" => array(
        "class" => "NFSe\XML\Entity\SimpleType\RpsStatus",
        "formatter" => "NFSe\Formatter\Status",
    ),
    "TsStatusNfse" => array(
        "class" => "NFSe\XML\Entity\SimpleType\NfseStatus",
        "formatter" => "NFSe\Formatter\Status",
    ),
);