<?php
function analyzeStringContentWithBasicPunctuation($string) {
    // Initialize an array to hold the results
    $results = [
        'printable' => '',
        'nonPrintable' => false,
        'uppercase' => '',
        'lowercase' => '',
        'digits' => '',
        'specialChars' => '',
        'punctuation' => '',
        'basicPunctuation' => '', // New category for basic punctuation
        'whitespace' => '',
        'symbols' => ''
    ];

    // Define basic punctuation characters
    $basicPunctuationChars = '.!?,:;';

    // Iterate through each character in the string
    for ($i = 0; $i < strlen($string); $i++) {
        $char = $string[$i];

        // Check if character is non-printable
        if (!ctype_print($char) && !ctype_space($char)) {
            $results['nonPrintable'] = true;
            continue;
        }

        // Check if character is printable
        if (ctype_print($char)) {
            $results['printable'] .= $char;
        }

        // Check if character is uppercase A-Z
        if (ctype_upper($char)) {
            $results['uppercase'] .= $char;
        }

        // Check if character is lowercase a-z
        if (ctype_lower($char)) {
            $results['lowercase'] .= $char;
        }

        // Check if character is a digit 0-9
        if (ctype_digit($char)) {
            $results['digits'] .= $char;
        }

        // Check if character is a special character (not alphanumeric, not space, not punctuation)
        if (!ctype_alnum($char) && !ctype_space($char) && !ctype_punct($char)) {
            $results['specialChars'] .= $char;
        }

        // Check if character is a punctuation character
        if (ctype_punct($char)) {
            $results['punctuation'] .= $char;
            // If the character is also one of the basic punctuation characters, add it to basicPunctuation
            if (strpos($basicPunctuationChars, $char) !== false) {
                $results['basicPunctuation'] .= $char;
            }
        }

        // Check if character is whitespace
        if (ctype_space($char)) {
            $results['whitespace'] .= $char;
        }

        // Check if character is a symbol (in the context of passwords)
        // Symbols here are defined as any non-alphanumeric character that is not whitespace
        // This includes punctuation and special characters
        if (!ctype_alnum($char) && !ctype_space($char)) {
            $results['symbols'] .= $char;
        }
    }

    // If nonPrintable is true, it indicates the presence of non-printable characters
    if ($results['nonPrintable']) {
        return false;
    }

    return $results;
}
?>