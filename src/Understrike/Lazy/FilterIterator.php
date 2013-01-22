<?php

namespace Understrike\Lazy;

class FilterIterator extends \FilterIterator
{
  public function __construct(\Traversable $list, $iterator)
  {
    parent::__construct($list);
    $this->iterator = $iterator;
  }

  public function accept()
  {
    return call_user_func($this->iterator,
      $this->current(),
      $this->key(),
      $this);
  }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
