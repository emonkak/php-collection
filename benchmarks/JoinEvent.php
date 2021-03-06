<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;
use Emonkak\Collection\Collection;

class JoinEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = Collection::from([
            ['id' => 1, 'name' => 'Sumire Uesaka'],
            ['id' => 2, 'name' => 'Mikako Komatsu'],
            ['id' => 3, 'name' => 'Rumi okubo'],
            ['id' => 4, 'name' => 'Natsumi Takamori'],
            ['id' => 5, 'name' => 'Shiori Mikami'],
        ])->cycle(10);
        $this->users = Collection::from([
            ['talent_id' => 1, 'user_id' => 139557376],
            ['talent_id' => 2, 'user_id' => 255386927],
            ['talent_id' => 2, 'user_id' => 53669663],
            ['talent_id' => 4, 'user_id' => 2445518118],
            ['talent_id' => 5, 'user_id' => 199932799]
        ])->cycle(10);
    }

    protected function execute($xs)
    {
        $xs->join(
            $this->users,
            function($talent) { return $talent['id']; },
            function($user) { return $user['talent_id']; },
            function($talent, $user) {
                $talent['user'] = $user;
                return $talent;
            }
        )->toList();
    }
}
