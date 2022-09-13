<?php

/**
* Functie de validare a Codului Numeric Personal (CNP).
* @author Aurelian Toma
* 
* @param string $value CNP-ul
* @return bool
*/
function isCnpValid(string $value): bool 
{
    // Trebuie sa fie format din exact 13 cifre.
    if (!preg_match('/^[0-9]{13}$/', $value)) {
        return false;
    }

    // Sexul.
    $S = $value[0];

    // Anul.
    $AA = $value[1] . $value[2];

    // Luna.
    $LL = $value[3] . $value[4];

    // Ziua.
    $ZZ = $value[5] . $value[6];

    // Judetul.
    $JJ = $value[7] . $value[8];

    // Birou evidenta.
    $NNN = $value[9] . $value[10] . $value[11];

    // Cifra control.
    $C = $value[12];

    // Validare sex.
    if (!in_array($S, range(1, 9))) {
        return false;
    }

    // Validare luna.
    if (intval($LL) > 12) {
        return false;
    }

    // Validare ziua.
    if (intval($ZZ) > 31) {
        return false;
    }

    // Validare judetul.
    if (intval($JJ) > 52) {
        return false;
    }

    // Begin: Validare numar de control.
    $numarControl = str_split('279146358279');

    $sum = 0;
    for ($k = 0; $k < 12; $k++) {
        $sum += ($value[$k] * $numarControl[$k]);
    }

    if ($sum % 11 == 10) {
        if ($C != 1) {
            return false;
        }
    } else {
        if ($sum % 11 != $C) {
            return false;
        }
    }
    // End: Validare numar de control.

    return true;
}
