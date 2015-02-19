<?php

include_once('BaseTest.php');
/**
 * Class FinderTest
 */
class VideoTest extends BaseTest
{
    /**
     * @return array
     */
    public function videoUploadSuccessProvider()
    {
        $credentials = $this->defaultProvider();

        return [
            array_merge($credentials[0], [[
                'url'         => RUTUBE_VIDEO,
                'description' => 'Description',
                'title'       => 'Title',
                'isHidden'    => 1,
                'categoryId'  => 13
            ]]),
        ];
    }

    public function uploadVideo($username, $password, $secure, $host, $videoParams)
    {
        $video = $this->getRutubeVideo($username, $password, $secure, $host);
        $data = $this->getUploadVideo($video, $videoParams);

        //usleep(500000);

        return [$video, $data];
    }

    public function getVideo($video, $id)
    {
        //usleep(500000);

        return $video->getVideo($id);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testUpload($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $this->assertObjectHasAttribute('video_id', $data);
        $this->assertObjectHasAttribute('track_id', $data);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testDeleteByTrackId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $status = $video->deleteVideo($data->track_id);

        $this->assertTrue($status);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testDeleteByVideoId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $result = $video->deleteVideo($data->video_id);

        $this->assertTrue($result);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testGetVideoByTrackId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $vo = $video->getVideo($data->track_id);

        $this->assertEquals($videoParams['description'], $vo->description);
        $this->assertEquals($videoParams['title'], $vo->title);
        $this->assertEquals($videoParams['isHidden'], $vo->is_hidden);
        $this->assertEquals($videoParams['categoryId'], $vo->category->id);
        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testGetVideoByVideoId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $vo = $video->getVideo($data->video_id);

        $this->assertEquals($videoParams['description'], $vo->description);
        $this->assertEquals($videoParams['title'], $vo->title);
        $this->assertEquals($videoParams['isHidden'], $vo->is_hidden);
        $this->assertEquals($videoParams['categoryId'], $vo->category->id);
        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testPatchVideoByTrackId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $videoParams2 = [
            'description' => 'New Description',
            'title'       => 'New title',
            'isHidden'    => 0,
            'categoryId'  => 11
        ];

        extract($videoParams2);

        $video->patchVideo($data->track_id, $description, $title, $isHidden, $categoryId);

        $vo = $this->getVideo($video, $data->track_id);

        $this->assertEquals($videoParams2['description'], $vo->description);
        $this->assertEquals($videoParams2['title'], $vo->title);
        $this->assertEquals($videoParams2['isHidden'], $vo->is_hidden);
        $this->assertEquals($videoParams2['categoryId'], $vo->category->id);
        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testPatchVideoByVideoId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $videoParams2 = [
            'description' => 'New Description',
            'title'       => 'New title',
            'isHidden'    => 0,
            'categoryId'  => 11
        ];

        extract($videoParams2);

        $video->patchVideo($data->video_id, $description, $title, $isHidden, $categoryId);

        $vo = $this->getVideo($video, $data->video_id);

        $this->assertEquals($videoParams2['description'], $vo->description);
        $this->assertEquals($videoParams2['title'], $vo->title);
        $this->assertEquals($videoParams2['isHidden'], $vo->is_hidden);
        $this->assertEquals($videoParams2['categoryId'], $vo->category->id);
        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
    }


    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testPutVideoByTrackId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $videoParams2 = [
            'description' => 'New Description',
            'title'       => 'New title',
            'isHidden'    => 0,
            'categoryId'  => 11
        ];

        extract($videoParams2);

        $video->putVideo($data->track_id, $description, $title, $isHidden, $categoryId);

        $vo = $this->getVideo($video, $data->track_id);

        $this->assertEquals($videoParams2['description'], $vo->description);
        $this->assertEquals($videoParams2['title'], $vo->title);
        $this->assertEquals($videoParams2['isHidden'], $vo->is_hidden);
        $this->assertEquals($videoParams2['categoryId'], $vo->category->id);
        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testPutVideoByVideoId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $videoParams2 = [
            'description' => 'New Description',
            'title'       => 'New title',
            'isHidden'    => 0,
            'categoryId'  => 11
        ];

        extract($videoParams2);

        $video->putVideo($data->video_id, $description, $title, $isHidden, $categoryId);

        $vo = $this->getVideo($video, $data->video_id);

        $this->assertEquals($videoParams2['description'], $vo->description);
        $this->assertEquals($videoParams2['title'], $vo->title);
        $this->assertEquals($videoParams2['isHidden'], $vo->is_hidden);
        $this->assertEquals($videoParams2['categoryId'], $vo->category->id);
        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testAddThumbByTrackId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $res = $video->addThumb($data->track_id, __DIR__.'/../../logo.png');

        $this->assertObjectHasAttribute('thumbnail_url', $res);

        $vo = $this->getVideo($video, $data->video_id);

        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
        $this->assertEquals($res->thumbnail_url, $vo->thumbnail_url);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testAddThumbByVideoId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $res = $video->addThumb($data->video_id, __DIR__.'/../../logo.png');

        $this->assertObjectHasAttribute('thumbnail_url', $res);

        $vo = $this->getVideo($video, $data->video_id);

        $this->assertEquals($data->track_id, $vo->track_id);
        $this->assertEquals($data->video_id, $vo->id);
        $this->assertEquals($res->thumbnail_url, $vo->thumbnail_url);
    }

    /**
     * @dataProvider videoUploadSuccessProvider
     */
    public function testPublicationByVideoId($username, $password, $secure, $host, $videoParams)
    {
        list($video, $data) = $this->uploadVideo($username, $password, $secure, $host, $videoParams);

        $time = date('Y-m-d H:i:s', time() + 60*60);

        $vo = $video->publication($data->video_id, $time);

        $this->assertEquals($data->video_id, $vo->video);
        $this->assertEquals($time, date('Y-m-d H:i:s', strtotime($vo->timestamp)));
    }
}