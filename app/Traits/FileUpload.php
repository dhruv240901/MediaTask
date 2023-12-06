<?php

namespace app\Traits;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait FileUpload
{
  // function to upload video
  public function videoUpload($file, $video)
  {
    $this->deleteFile('user/' . auth()->id() . '/media/' . $video->id);
    $nameDate = $this->generateFileName($file, $video);
    $response = $this->uploadVideo($file, $video, $nameDate['filename'], $nameDate['date']);
    return $response;
  }

  public function profileImageUpload($file, $user)
  {
    $this->deleteFile('user/' . $user->id . '/profile');
    $nameDate = $this->generateFileName($file, $user);
    $this->uploadProfileImage($file, $user, $nameDate['filename']);
    $filepath = 'user/' . $user->id . '/profile/' . $nameDate['filename'];
    return $filepath;
  }

  public function videoThumbnail($video, $filename)
  {
    $ffmpeg = FFMpeg::create();
    $thumbnail = $ffmpeg->open('user/' . auth()->id() . '/media/' . $video->id . '/' . $filename);

    $frame = $thumbnail->frame(TimeCode::fromSeconds(2));
    return $frame;
  }

  public function imageThumbnail($file)
  {
    $thumbnail = Image::make($file)->resize(200, 200, function ($constraint) {
      $constraint->aspectRatio();
    });

    return $thumbnail;
  }

  public function deleteFile($filepath)
  {
    if (File::exists($filepath)) {
      // Delete the folder and its contents
      File::deleteDirectory($filepath);
    }
  }

  public function uploadVideo($file, $video, $filename, $date)
  {
    // Move the original file to the user's directory
    $file->move('user/' . auth()->id() . '/media/' . $video->id . '/', $filename);

    $thumbnailDirectory = 'user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/';
    if (!file_exists($thumbnailDirectory)) {
      mkdir($thumbnailDirectory, 0777, true);
    }

    $frame = $this->videoThumbnail($video, $filename);
    $thumbnailName  = ($date . '_' . $video->name . '.jpg');
    $frame->save('user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/' . $thumbnailName);
    $response['url'] = 'user/' . auth()->id() . '/media/' . $video->id . '/' . $filename;
    $response['name'] = $date . '_' . $video->name;
    return $response;
  }

  public function uploadProfileImage($file, $user, $filename)
  {

    $thumbnail = $this->imageThumbnail($file);

    // Move the original file to the user's directory
    $file->move('user/' . $user->id . '/profile/', $filename);

    // Create the thumbnail directory if it doesn't exist
    $thumbnailDirectory = 'user/' . $user->id . '/profile/thumbnail/';
    if (!file_exists($thumbnailDirectory)) {
      mkdir($thumbnailDirectory, 0777, true);
    }

    // Save the thumbnail to the specified path
    $thumbnail->save('user/' . $user->id . '/profile/thumbnail/' . $filename);
  }

  public function generateFileName($file, $module)
  {
    $name      = $file->getClientOriginalName();
    $filename  = pathinfo($name, PATHINFO_FILENAME);
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $nameDate['date'] = date('dmYhisa', time());
    $nameDate['filename']  = ($nameDate['date'] . '_' . $module->name . '.' . $extension);
    return $nameDate;
  }
}
