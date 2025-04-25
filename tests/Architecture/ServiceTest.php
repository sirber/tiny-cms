<?php

arch()
    ->expect('TinyCms\Service')
    ->toBeClass()
    ->toUseStrictTypes()
    ->toBeFinal()
    ->toBeReadonly();
