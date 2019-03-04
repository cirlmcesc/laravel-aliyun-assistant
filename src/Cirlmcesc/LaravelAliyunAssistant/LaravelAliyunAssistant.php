<?php

namespace Cirlmcesc\LaravelAliyunAssistant;

use vod\Request\V20170321 as vod;
use DefaultProfile;
use DefaultAcsClient;
use Exception;

class LaravelAliyunAssistant
{
    /**
     * accessKeyId variable
     *
     * @var [String]
     */
    private $accessKeyId;

    /**
     * accessKeySecret variable
     *
     * @var [String]
     */
    private $accessKeySecret;

    /**
     * aliyunclient variable
     *
     * @var [Aliyun client Object]
     */
    private $aliyunclient;

    /**
     * region variable
     *
     * @var [String]
     */
    private $region;

    /**
     * accept_format variable
     *
     * @var [string]
     */
    private $accept_format = "JSON";

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->accessKeyId = config("aliyun.access_key_id");
        $this->accessKeySecret = config("aliyun.access_key_secret");
        $this->region = config("aliyun.region");

        if (empty($this->accessKeyId) || empty($this->accessKeySecret)) {
            throw new Exception("aliyun assistant error: no accessKeyId or no accessKeySecret.");
        }

        $this->aliyunclient = $this->initVodClient(
            $this->accessKeyId, $this->accessKeySecret);
    }

    /**
     * initVodClient function
     *
     * @param String $accessKeyId
     * @param String $accessKeySecret
     * @return void
     */
    private function initVodClient(String $accessKeyId, String $accessKeySecret)
    {
        $profile = DefaultProfile::getProfile(
            $this->region, $accessKeyId, $accessKeySecret);
    
        return new DefaultAcsClient($profile);
    }
    
    /**
     * get video list function
     *
     * @param Int $page
     * @param Int $page_size
     * @return void
     */
    public function getVideoList(Int $page, Int $page_size)
    {        
        $request = new vod\GetVideoListRequest();
    
        $request->setPageNo($page);
        $request->setPageSize($page_size);
        $request->setAcceptFormat($this->accept_format);
        $request->setSortBy("CreationTime:Desc");
        
        return $this->aliyunclient
                    ->getAcsResponse($request)
                    ->VideoList
                    ->Video;
    }

    /**
     * get video info function
     *
     * @param String $video_id
     * @return void
     */
    public function getVideoInfo(String $video_id)
    {
        $request = new vod\GetVideoInfoRequest();
        $request->setVideoId($video_id);
        $request->setAcceptFormat($this->accept_format);
    
        return $this->aliyunclient
                    ->getAcsResponse($request)
                    ->Video;
    }

    /**
     * get mezzanine info function
     *
     * @param String $video_id
     * @return void
     */
    public function getMezzanineInfo(String $video_id)
    {
        $request = new vod\GetMezzanineInfoRequest();

        $request->setVideoId($video_id);
        $request->setAuthTimeout(3600*5);
        $request->setAcceptFormat($this->accept_format);
    
        return $this->aliyunclient
                    ->getAcsResponse($request)
                    ->Mezzanine;
    }

    /**
     * get play info function
     *
     * @param String $video_id
     * @return void
     */
    public function getPlayInfo(String $video_id)
    {
        $request = new vod\GetPlayInfoRequest();

        $request->setVideoId($video_id);
        $request->setAuthTimeout(3600*24);
        $request->setAcceptFormat($this->accept_format);
    
        return $this->aliyunclient
                    ->getAcsResponse($request)
                    ->PlayInfoList
                    ->PlayInfo;
    }
}