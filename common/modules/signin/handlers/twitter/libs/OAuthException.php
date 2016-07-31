<?php
namespace common\modules\signin\handlers\twitter\libs;

use yii\base\Exception;

/* Generic exception class
 */
if (!class_exists('OAuthException')) {
	class OAuthException extends Exception {
		// pass
	}
}