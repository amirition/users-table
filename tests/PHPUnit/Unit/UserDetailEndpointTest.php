<?php
namespace Amirition\UTable\Tests\Unit;


use Amirition\UTable\Admin\UserDetailEndpoint;
use Amirition\UTable\Admin\UsersInfo;
use Brain\Monkey\Functions;


class UserDetailEndpointTest extends AbstractUnitTestCase {

  public function test_print_user_detail() {
    $users_info = new UsersInfo();
    $obj = new UserDetailEndpoint( $users_info );

    $first_input = json_decode( '[ { "userId": 2, "id": 11, "title": "et ea vero quia laudantium autem", "body": "delectus reiciendis molestiae occaecati non minima eveniet qui voluptatibus\naccusamus in eum beatae sit\nvel qui neque voluptates ut commodi qui incidunt\nut animi commodi" }, { "userId": 2, "id": 12, "title": "in quibusdam tempore odit est dolorem", "body": "itaque id aut magnam\npraesentium quia et ea odit et ea voluptas et\nsapiente quia nihil amet occaecati quia id voluptatem\nincidunt ea est distinctio odio" }]' );

    $second_input = array();

    static::assertStringContainsString('<p>et ea vero quia laudantium autem</p>', $obj->printUserDetail( $first_input ) );

    static::assertEquals( '', $obj->printUserDetail( $second_input ) );
  }
}