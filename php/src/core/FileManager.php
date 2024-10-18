<?php
namespace app\core;

use Exception;

class FileManager {
  private static $instance = null;
  public static $ALLOWED_IMAGES = ['image/jpeg' => '.jpg', 'image/png' => '.png'];
  public static $ALLOWED_PDF = ['application/pdf' => '.pdf'];

  public static $ALLOWED_VIDEO = ['video/mp4' => '.mp4'];

  private function __construct() {}
  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new FileManager();
    } 
    return self::$instance;
  }
  public function saveImage($img) {
    if (empty($img)) {
      throw new Exception('Image file is not present', 400);
    }

    $path = __DIR__ . '/../storage/image/';
    $type = mime_content_type($img);
    if (!in_array($type, array_keys(self::$ALLOWED_IMAGES))) {
      throw new Exception('Unsupported Image Media Type', 415);
    }

    $ext = self::$ALLOWED_IMAGES[$type];
    $name = uniqid();
    $file_path = $path . $name . $ext;
    $avail =  !file_exists($file_path);
    
    while (!$avail) {
      $name = uniqid();
      $file_path = $path . $name . $ext;
      $avail =  !file_exists($file_path);
    }

    $success = move_uploaded_file($img, $file_path);
    if (!$success) {
      throw new Exception('Failed to Upload Image', 500);
    }
    return $file_path;
  }

  public function savePdf($pdf) {
    if (empty($pdf)) {
      throw new Exception('Pdf file is not present', 400);
    }

    $path = __DIR__ . '/../storage/resume/';
    $type = mime_content_type($pdf);
    if (!in_array($type, array_keys(self::$ALLOWED_PDF))) {
      throw new Exception('Unsupported PDF Media Type', 415);
    }

    $ext = self::$ALLOWED_PDF[$type];
    $name = uniqid();
    $file_path = $path . $name . $ext;
    $avail =  !file_exists($file_path);
    
    while (!$avail) {
      $name = uniqid();
      $file_path = $path . $name . $ext;
      $avail =  !file_exists($file_path);
    }

    $success = move_uploaded_file($pdf, $file_path);
    if (!$success) {
      throw new Exception('Failed to Upload Image', 500);
    }
    return $file_path;
  }

  public function saveVideo($video) {
    if (empty($video)) {
      throw new Exception('Pdf file is not present', 400);
    }

    $path = __DIR__ . '/../storage/video/';
    $type = mime_content_type($video);
    if (!in_array($type, array_keys(self::$ALLOWED_VIDEO))) {
      throw new Exception('Unsupported Video Media Type', 415);
    }

    $ext = self::$ALLOWED_VIDEO[$type];
    $name = uniqid();
    $file_path = $path . $name . $ext;
    $avail =  !file_exists($file_path);
    
    while (!$avail) {
      $name = uniqid();
      $file_path = $path . $name . $ext;
      $avail =  !file_exists($file_path);
    }

    $success = move_uploaded_file($video, $file_path);
    if (!$success) {
      throw new Exception('Failed to Upload Image');
    }
    return $file_path;
  }

  public function delete($file_path) {
    if (!file_exists($file_path)) return;
    $success = unlink($file_path);
    if (!$success) {
      throw new Exception('Failed to Delete ' . $file_path, 500);
    }
  }
}