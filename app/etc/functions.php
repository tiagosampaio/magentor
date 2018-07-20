<?php

/**
 * Escape html entities
 *
 * @param   mixed $data
 * @param   array $allowedTags
 * @return  mixed
 */
function escapeHtml($data, $allowedTags = null)
{
    $charset = ini_get('default_charset') ?: 'UTF-8';
    $result  = null;

    if (is_array($data)) {
        $result = [];

        foreach ($data as $item) {
            $result[] = $this->escapeHtml($item);
        }
    } else {
        // process single item
        if (strlen($data)) {
            if (is_array($allowedTags) and !empty($allowedTags)) {
                $allowed = implode('|', $allowedTags);

                $result = preg_replace('/<([\/\s\r\n]*)(' . $allowed . ')([\/\s\r\n]*)>/si', '##$1$2$3##', $data);
                $result = htmlspecialchars($result, ENT_COMPAT, $charset, false);
                $result = preg_replace('/##([\/\s\r\n]*)(' . $allowed . ')([\/\s\r\n]*)##/si', '<$1$2$3>', $result);
            } else {
                $result = htmlspecialchars($data, ENT_COMPAT, $charset, false);
            }
        } else {
            $result = $data;
        }
    }

    return $result;
}
