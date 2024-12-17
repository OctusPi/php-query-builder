<?php
namespace Octuspi\Querybuilder\Security;

class Sanitize
{
    /**
     * Sanitize input to remove potentially malicious content.
     *
     * @param mixed $input Input to be sanitized.
     * @param bool $encodeHtml Whether to encode HTML entities (for XSS prevention).
     * @return mixed Sanitized input.
     */
    public static function clear(mixed $input, bool $encodeHtml = false): mixed
    {
        if ($input === null) {
            return null;
        }

        if (is_array($input)) {
            // Recursively sanitize each element of the array
            return array_map(fn($item) => self::clear($item, $encodeHtml), $input);
        }

        if (!is_string($input)) {
            // Return non-string values as-is
            return $input;
        }

        // Define dangerous keywords to be removed
        $dangerousKeywords = [
            'from',
            'script',
            'select',
            'insert',
            'delete',
            'truncate',
            'where',
            'drop',
            'show tables',
            'drop table',
            '--',
            '#',
            '\\*',
            '\\\\'
        ];

        // Generate regex dynamically
        $pattern = '/\b(' . implode('|', array_map('preg_quote', $dangerousKeywords)) . ')\b/i';
        $input = preg_replace($pattern, '', $input);

        // Remove HTML tags
        $input = strip_tags($input);

        // Optionally encode HTML entities
        if ($encodeHtml) {
            $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }

        // Trim extra spaces
        return trim($input);
    }

}