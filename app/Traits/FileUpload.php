<?php

namespace app\Traits;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait FileUpload
{
  /* function to upload video */
  public function videoUpload($file, $video)
  {
    $this->deleteFile('user/' . auth()->id() . '/media/' . $video->id);
    $nameDate = $this->generateFileName($file, $video);
    $response = $this->uploadVideo($file, $video, $nameDate['filename'], $nameDate['date']);
    return $response;
  }

  /* function to create video thumbnail */
  public function videoThumbnail($video, $filename)
  {
    $ffmpeg = FFMpeg::create();
    $thumbnail = $ffmpeg->open('user/' . auth()->id() . '/media/' . $video->id . '/' . $filename);

    $frame = $thumbnail->frame(TimeCode::fromSeconds(2));
    return $frame;
  }

  /* function to store video and its thumbnail */
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

  /* function to upload profile image */
  public function profileImageUpload($file, $user)
  {
    $this->deleteFile('user/' . $user->id . '/profile');
    $nameDate = $this->generateFileName($file, $user);
    $this->uploadProfileImage($file, $user, $nameDate['filename']);
    $filepath = 'user/' . $user->id . '/profile/' . $nameDate['filename'];
    return $filepath;
  }

  /* function to create image thumbnail */
  public function imageThumbnail($file)
  {
    $thumbnail = Image::make($file)->resize(200, 200, function ($constraint) {
      $constraint->aspectRatio();
    });

    return $thumbnail;
  }

  /* function to delete file from directory */
  public function deleteFile($filepath)
  {
    if (File::exists($filepath)) {
      // Delete the folder and its contents
      File::deleteDirectory($filepath);
    }
  }

  /* function to generate file name */
  public function generateFileName($file, $module)
  {
    $name      = $file->getClientOriginalName();
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $nameDate['date'] = date('dmYhisa', time());
    $nameDate['filename']  = ($nameDate['date'] . '_' . $module->name . '.' . $extension);
    return $nameDate;
  }
}
