<?php

namespace app\Traits;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\File;

trait FileUpload
{
    // function to upload video
    public function videoUpload($file,$video)
    {
      // if(file_exists('user/' . auth()->id() . '/media/' . $video->id)){
      //   unlink('user/' . auth()->id() . '/media/' . $video->id);
      // }
      if (File::exists('user/' . auth()->id() . '/media/' . $video->id)) {
        // Delete the folder and its contents
        File::deleteDirectory('user/' . auth()->id() . '/media/' . $video->id);
      }
      $name      = $file->getClientOriginalName();
      $filename  = pathinfo($name, PATHINFO_FILENAME);
      $extension = pathinfo($name, PATHINFO_EXTENSION);
      $date      = date('dmYhisa', time());
      $filename  = ($date . '_' . $video->name . '.' . $extension);

      // Move the original file to the user's directory
      $file->move('user/' . auth()->id() . '/media/' . $video->id . '/', $filename);

      $thumbnailDirectory = 'user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/';
      if (!file_exists($thumbnailDirectory)) {
        mkdir($thumbnailDirectory, 0777, true);
      }
      $ffmpeg = FFMpeg::create();
      $thumbnail = $ffmpeg->open('user/' . auth()->id() . '/media/' . $video->id . '/'. $filename);

      $frame = $thumbnail->frame(TimeCode::fromSeconds(2));
      $thumbnailName  = ($date . '_' . $video->name . '.jpg');
      $frame->save('user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/'. $thumbnailName);
      $response['url'] = 'user/' . auth()->id() . '/media/' . $video->id . '/' . $filename;
      $response['name']=$date . '_' . $video->name;
      return $response;
    }
}
