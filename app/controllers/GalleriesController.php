<?php
	class GalleriesController extends BaseController {

		private static $prefix = '/image/gallery/';
		private static $thumbnail = '/image/gallery/thumbnail/';

		public function getIndex() {
			return View::make('dashboard/gallery.index');
		}

		public function getShow() {
			$query = $_GET['query'];
			$images;
			if($query == 'all') {
				$images = Gallery::all();
			}else {
				$images = Gallery::where('name','LIKE', '%'.$query.'%')->get();
			}

			return json_encode($images, JSON_UNESCAPED_UNICODE);
		}

		public function getCreate() {
			return View::make('dashboard/gallery.create');
		}

		public function postCreate() {
			$success = false;
			$message = 'Upload complete';
			if ( !empty( $_FILES ) ) {
					$picture = $_FILES[ 'file' ][ 'tmp_name' ];
					$destination = public_path().static::$prefix.$_FILES[ 'file' ][ 'name' ];
					$thumbnailpath = public_path().static::$thumbnail;
					$filename = $_FILES[ 'file' ][ 'name' ];
					$thumbnailpic = Img::make($picture)->resize(80, 80)->save($thumbnailpath.'thumbnail_'.$filename);
					$uploadSuccess = move_uploaded_file( $picture, $destination );
					$image = new Gallery();
					$image->name = $filename;
					$image->path = static::$prefix.$filename;
					$image->thumbnail_path = static::$thumbnail.'thumbnail_'.$filename;
					$image->save();

			} else {
				$message = 'No file';
			}
			return json_encode(['success' => $success, 'message' => $message], JSON_UNESCAPED_UNICODE);
		}

		public function postDelete() {
			$id = $_GET['id'];
			$image = Gallery::where('id','=',$id)->first();
			unlink(public_path().$image->path);
			unlink(public_path().$image->thumbnail_path);
			$image->delete();
			return;
		}
	}
?>