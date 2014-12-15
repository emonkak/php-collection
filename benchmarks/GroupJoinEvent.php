<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;
use Emonkak\Collection\Collection;

class GroupJoinEvent extends AthleticEvent
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
        $this->tweets = Collection::from([
            ['user_id' => 1, 'body' => 'foo'],
            ['user_id' => 1, 'body' => 'bar'],
            ['user_id' => 1, 'body' => 'baz'],
            ['user_id' => 3, 'body' => 'hoge'],
            ['user_id' => 3, 'body' => 'fuga'],
            ['user_id' => 5, 'body' => 'piyo']
        ])->cycle(10);
    }

    protected function execute($xs)
    {
        $xs->join(
            $this->tweets,
            function($user) { return $user['id']; },
            function($user) { return $user['user_id']; },
            function($user, $tweets) {
                $user['tweets'] = $tweets;
                return $user;
            }
        )->toList();
    }
}
