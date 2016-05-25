<?php


class ImagesController extends BaseController {
	private static $prefix = '/image/gallery/';
	private static $thumbnail = '/image/gallery/thumbnail/';

	public function postUpload() {
		$success = false;
		$message = 'Upload complete';
		$id = '';
		$path = '';
		$thumbnail_path = '';

		foreach (Input::file('image') as $picture) {
			if(isset($picture)) {
					$destination = public_path().static::$prefix;
					$thumbnailpath = public_path().static::$thumbnail;
					$filename = $picture->getClientOriginalName();
					$thumbnailpic = Img::make($picture)->resize(80, 80)->save($thumbnailpath.'thumbnail_'.$filename);
					$uploadSuccess = $picture->move($destination,$filename);
					if($uploadSuccess) {
						$image = new Gallery();
						$image->name = $filename;
						$image->path = static::$prefix.$filename;
						$image->thumbnail_path = static::$thumbnail.'thumbnail_'.$filename;
						if($image->save()) {
							$id = $image->id;
							$path = $image->path;
							$thumbnail_path = $image->thumbnail_path;
							$success = true;
						}else {
							$message = 'Cannot Save !!';
						}					
					}else {
						$message = 'Upload Failed !!';
					}

			}else $message = 'No picture';
		}
		return json_encode(['success' => $success, 'message' => $message, 
							'id' => $id, 'thumbnail_path' => $thumbnail_path,
							'path' => $path], JSON_UNESCAPED_UNICODE);
	}

	public function getThumbnail() {
		$id = $_GET['id'];
		$thumbnails = [];
		if($id != 0) {
			$thumbnails = DB::table('images')->where('product_id','=',$id)
							->join('galleries','galleries.id','=','images.image_id')
							->get(['galleries.id as id','images.name as name','galleries.path as path','galleries.thumbnail_path as thumbnail_path']);
		}
		return json_encode($thumbnails, JSON_UNESCAPED_UNICODE);
	}

	public function postDelete() {
		$id = $_GET['id'];
		$thumbnail = Image::where('id','=',$id)->first();
		unlink(public_path().$thumbnail->path);
		unlink(public_path().$thumbnail->thumbnail_path);
		$thumbnail->delete();
		return;
	}
}