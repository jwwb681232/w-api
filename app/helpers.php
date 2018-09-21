<?php
if ( ! function_exists('ApiSuccess')) {
    /**
     * Api 返回成功
     *
     * @param array $data
     * @param       $message
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function ApiSuccess($data = [], $message = 'OK')
    {
        $response['data']        = $data;
        $response['message']     = $message;
        $response['status_code'] = 200;

        return response($response);
    }
}

if ( ! function_exists('ApiValidatorFail')) {
    /**
     * Api 请求参数验证失败
     *
     * @param array $message
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function ApiValidatorFail($message = [])
    {
        $code                    = 400;
        $response['message']     = $message;
        $response['status_code'] = $code;

        return response($response, $code);
    }
}


