<?php

function sendSuccess($message, $data = NULL, $code = 200)
{
    return response()->json([
        'status'    => $code,
        'message'   => $message,
        'data'      => $data,
    ]);
}
function sendError($error_message, $data = NULL, $code = 400)
{
    return response()->json([
        'status'    => $code,
        'message'   => $error_message,
        'data'      => $data,
    ]);
}