<?php

arch()
  ->expect('TinyCms\DTO')
  ->toBeClass()
  ->toUseStrictTypes()
  ->toBeFinal()
  ->toUseNothing()
  ->toBeReadonly();
