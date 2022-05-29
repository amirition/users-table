<?php

namespace Amirition\UTable\Tests\Unit;

use Amirition\UTable\Admin\UsersInfo;
use Brain\Monkey\Functions;

class UsersInfoTest extends AbstractUnitTestCase
{

  public function test_retrieve_user_detail()
  {
    Functions\expect('wp_remote_retrieve_response_code')
      ->once()
      ->withAnyArgs()
      ->andReturnValues(array(200, 404));


    $testee = new UsersInfo();

    $response = '[ { "userId": 1, "id": 1, "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit", "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto" }]' ;
    Functions\expect('wp_remote_retrieve_body')
      ->once()
      ->withAnyArgs()
      ->andReturn($response);
    $user_detail = $testee->retrieveUserDetails( '' );

    $needle = 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit';

    static::assertIsArray( $user_detail );

    static::assertObjectHasAttribute( 'title', $user_detail[0] );
  }


}