<?php

namespace App\Helper;

class Helper
{

    /**
     * Retorna um response padronizado.
     *
     * @param mixed $content
     * @param string $message
     * @param int $status
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public static function responseJson($content, string $message = '', int $status = 200)
    {
        $data = [
            'data' => $content,
            'message' => $message
        ];

        return response()->json($data, $status);
    }
}
