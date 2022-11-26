<?php
use App\UserRepo;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        $this->user = new UserRepo();
    }

    protected function tearDown(): void
    {
        unset($this->user);
    }

    // test pass if all data is returned correctly for mockUsers
    public function test_MockUsers_Are_Returned()
    {
        $mockUsers = $this->createMock(UserRepo::class);
        $mockUsersArray=[
                ['id' => 1, 'name' => 'user1', 'email' => 'user1@example.com', 'password' => 'p455w0rd',
                 'user_type' => 'user'],
                ['id' => 2, 'name' => 'user2', 'email' => 'user2@example.com', 'password' => 'p455w0rd',
                 'user_type' => 'user'],
                ['id' => 3, 'name' => 'user3', 'email' => 'user3@example.com', 'password' => 'p455w0rd',
                 'user_type' => 'user'],
                ['id' => 4, 'name' => 'admin', 'email' => 'admin@example.com', 'password' => 'p455w0rd',
                 'user_type' => 'user'],
        ];
        $mockUsers ->method('fetchUsers')->willReturn($mockUsersArray);
        $users = $mockUsers->fetchUsers();
        $this->assertEquals('user1', $users[0]['name']);
        $this->assertEquals('user2', $users[1]['name']);
        $this->assertEquals('user3', $users[2]['name']);
        $this->assertEquals('admin', $users[3]['name']);
    }

    //test pass if user is an array
    public function test_Validate_User_Is_Array()
    {
        $result = $this->user->validateUserIsArray();
        $this->assertTrue($result);
    }
}
