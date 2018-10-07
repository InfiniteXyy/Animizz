<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/17
 * Time: 10:18
 */

namespace app\common\validate;

use think\Validate;

class MomentValidate extends Validate
{
    protected $rule = [
        'content' => 'require|length:1,140'
    ];

    protected $message = [
        'content.require' => 'content can not be empty',
        'content.length' => 'content\'s length can only be 1 to 140',
    ];

    protected $scene = [
        'create' => ['content']
    ];
}