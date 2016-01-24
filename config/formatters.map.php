<?php

return array(
    "NFSe\Formatter\Date" => function () {
        $datetimeFormatter = new \NFSe\Formatter\DateTimeFormatter();
        $datetimeFormatter->setPattern("Y-m-d");
        return $datetimeFormatter;
    },
    "NFSe\Formatter\DateTime" => function () {
        $datetimeFormatter = new \NFSe\Formatter\DateTimeFormatter();
        $datetimeFormatter->setPattern("Y-m-d\TH:i:s");
        return $datetimeFormatter;
    },
    "NFSe\Formatter\Decimal" => "NFSe\Formatter\DecimalFormatter",
    "NFSe\Formatter\Percentual" => "NFSe\Formatter\PercentualFormatter",
    "NFSe\Formatter\Number" => "NFSe\Formatter\NumberFormatter",
    "NFSe\Formatter\NFSeNumber" => "NFSe\Formatter\SimpleType\NfseNumberFormatter",
    "NFSe\Formatter\VerificationCode" => "NFSe\Formatter\SimpleType\VerificationCodeFormatter",
    "NFSe\Formatter\Status" => "NFSe\Formatter\StatusFormatter",
);