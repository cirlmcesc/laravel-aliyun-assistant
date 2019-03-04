<?php

if (! function_exists("getAliyunClient")) {
    /**
     * get_aliyun_client function
     *
     * @return void
     */
    function get_aliyun_client() {
        return new Cirlmcesc\LaravelAliyunAssistant\LaravelAliyunAssistant();
    }
}