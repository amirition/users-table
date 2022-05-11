<?php
namespace Amirition\Inpsyde\Tests\Unit;

use Amirition\Inpsyde\Admin\UsersInfo;
use Amirition\Inpsyde\Front\UsersTemplate;

class UsersTemplateTest extends AbstractUnitTestCase {


  public function test_user_row_print() {
    $user_array = json_decode( '{ "id": 1, "name": "Leanne Graham", "username": "Bret", "email": "Sincere@april.biz", "address": { "street": "Kulas Light", "suite": "Apt. 556", "city": "Gwenborough", "zipcode": "92998-3874", "geo": { "lat": "-37.3159", "lng": "81.1496" } }}' );
    $user_info = new UsersInfo();
    $testee = new UsersTemplate( $user_info );

    $correct_needle = '<tr><td><a data-id="1">1</a></td><td><a data-id="1">Leanne Graham</a></td><td><a data-id="1">Bret</a></td></tr>';

    static::assertStringContainsString( $correct_needle, $testee->getUserRow( $user_array ) );

  }

}