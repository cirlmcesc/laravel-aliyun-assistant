<?php

return [
    /**
     *  Set accessKeyId.
     */
    "access_key_id" => env("ALIYUN_ACCESS_KEY_ID" ,""),

    /**
     *  Set accessKeySecret.
     */
    "access_key_secret" => env("ALIYUN_ACCESS_KEY_SECRET", ""),

    /**
     *  Set region
     */
    "region" => env("ALIYUN_REGION", "cn-shanghai")
];