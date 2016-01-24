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
);