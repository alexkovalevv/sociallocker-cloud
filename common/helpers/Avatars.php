<?php
	/**
	 * Создание и редактирование аватаров
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 */

	namespace common\helpers;

	use GuzzleHttp\Client;
	use Yii;
	use yii\base\Exception;
	use yii\imagine\Image;

	class Avatars {

		const UPLOAD_DIR = '@backend/web/upload/avatars/';
		const UPLOAD_DIR_URL = '@backendUrl/upload/avatars/';
		const THUMBNAIL_PREFIX = '_x40.jpeg';
		const ORIGIN_PREFIX = '_orig.jpeg';
		const DEFAULT_THUMBNAIL = 'default_x40.png';

		public static function get($unique_id, $image_source = null)
		{
			$path_avatar = Yii::getAlias(self::UPLOAD_DIR) . $unique_id . self::THUMBNAIL_PREFIX;

			if( !file_exists($path_avatar) ) {
				if( !empty($image_source) ) {
					try {
						return self::save($unique_id, $image_source);
					} catch( Exception $e ) {
						throw new Exception($e->getMessage());

						return $image_source;
					}
				} else {
					$default_avatar_path = Yii::getAlias(self::UPLOAD_DIR . self::DEFAULT_THUMBNAIL);
					$default_avatar_url = Yii::getAlias(self::UPLOAD_DIR_URL . self::DEFAULT_THUMBNAIL);

					if( !file_exists($default_avatar_path) ) {
						throw new Exception('Изображения аватара по умолчанию не существует!');
					}

					return $default_avatar_url;
				}
			}

			$thumb_avatar_url = Yii::getAlias(self::UPLOAD_DIR_URL . $unique_id . self::THUMBNAIL_PREFIX);

			return $thumb_avatar_url;
		}

		public static function save($unique_id, $image_source)
		{

			if( !is_dir(Yii::getAlias(self::UPLOAD_DIR)) ) {
				throw new Exception('Директория для загрузки аватаров пользователей не найдена');
			}

			$path_avatar = Yii::getAlias(self::UPLOAD_DIR) . $unique_id . self::THUMBNAIL_PREFIX;
			$path_original = Yii::getAlias(self::UPLOAD_DIR) . $unique_id . self::ORIGIN_PREFIX;

			$client = new Client();
			$result = $client->request('GET', $image_source);
			$result_body = $result->getBody();
			$contents = $result_body->getContents();
			$cType = $result->getHeader('content-type')[0];

			if( empty($cType) || empty($contents) || !preg_match("/image/i", $cType) ) {
				throw new Exception('Неизвестный тип загружаемоего изображения или изображения не существует.');
			}

			file_put_contents($path_original, $contents);

			Image::thumbnail($path_original, 40, 40)->save(Yii::getAlias($path_avatar), ['quality' => 90]);

			unlink($path_original);

			if( !file_exists($path_avatar) ) {
				throw new Exception('Изображения не были сохранены из-за неизвестной ошибки.');
			}

			$thumb_avatar_url = Yii::getAlias(self::UPLOAD_DIR_URL . $unique_id . self::THUMBNAIL_PREFIX);

			return $thumb_avatar_url;
		}

		public static function remove()
		{
		}
	}