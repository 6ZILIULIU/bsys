<?php

namespace Index\Controller;

use Think\Controller;
use Admin\Model\UsersModel;
use Admin\Model\SeriesModel;
use Admin\Model\VideosModel;


class SeriesController extends Controller {



    public function list()
    {
        $this->display();
    }

    public function getSeriesList(){
        $db_series = new SeriesModel();
        $condition['series_status'] = 1;
        $condition['is_on_shelves'] = 1;
        $condition['series_partition'] = 'series';
        $serieslist = $db_series->where($condition)->select();
        for($i = 0; $i<count($serieslist); $i++){
            $data[$i]['cover'] = $serieslist[$i]['series_coverpath'];
            $data[$i]['title'] = $serieslist[$i]['series_title'];
        }
        
        // var_dump($data);
        $this->ajaxReturn($data);
    }

    // public function getHotspotList(){
    //     $db_series = new SeriesModel();
    //     $condition['series_status'] = 1;
    //     $condition['is_on_shelves'] = 1;
    //     $condition['series_created_timestamp'];
    //     $serieslist = $db_series->where($condition)->order('series_created_timestamp desc')->limit(20)->select();
    //     for($i = 0; $i<count($serieslist); $i++){
    //         $data[$i]['series_id'] = $serieslist[$i]['series_id'];
    //         $data[$i]['series_coverpath'] = $serieslist[$i]['series_coverpath'];
    //         $data[$i]['series_title'] = $serieslist[$i]['series_title'];
    //     }
        
    //     // var_dump($data);
    //     $this->ajaxReturn($data);
    // }

    public function play(){
        try{
            $this->display();
        }catch(Exception $e){

        }
    }

    public function getEpisode(){
        // unset($data);
        $series_id = $_GET['series_id'];
        $db_videos = new VideosModel();
        $db_series = new SeriesModel();
        $condition['series_id'] = $series_id;
        $condition['series_partition'] = 'series';
        $condition['video_status'] = 1;
        // var_dump($condition);
        $videoslist = $db_videos->where($condition)->order('video_episode')->select();
        for($i = 0; $i<count($videoslist); $i++){
            $data[$i]['video_id'] = $videoslist[$i]['video_id'];
            $data[$i]['video_filepath'] = $videoslist[$i]['video_filepath'];
            $data[$i]['video_title'] = $videoslist[$i]['video_title'];
        }
        // var_dump($data);
        unset($condition);
        $condition['series_id'] = $series_id;
        // $condition['series_']
        $data[count($videoslist)] = $db_series->where($condition)->getField('series_coverpath');
        $data[count($videoslist)+1] = $db_videos->where($condition)->order('video_episode desc')->limit(1)->getField('video_upload_timestamp');
        $data[count($videoslist)+2] = $db_series->where($condition)->getField('series_title');
        $data[count($videoslist)+3] = $db_series->where($condition)->getField('series_profile');
        $this->ajaxReturn($data);
        
    }
}