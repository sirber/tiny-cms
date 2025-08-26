<?php

arch()
    ->expect('TinyCms\Interface')
    ->toUseStrictTypes()
    ->toBeInterfaces()
    ->toHaveSuffix('Interface');
