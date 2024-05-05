<?php

use Hawara\StandardCodes\Validators\NifNieValidator;

it('can tell if a nif is valid', function ($value) {
    $result = (new NifNieValidator)->validate($value);
    expect($result->isValid())->toBeTrue();
})->with([
    '21207946Z',
    '92363649L',
    '80721247X',
    '05561856L',
    '65163235A',
]);

it('can tell if a nif is invalid', function ($value) {
    $result = (new NifNieValidator)->validate($value);
    expect($result->isValid())->toBeFalse();
})->with([
    '21207946D',
    '92363649M',
    '80721247W',
    '05561856A',
    '65163235P',
    21207946,
]);

it('can tell if a nie is valid', function ($value) {
    $result = (new NifNieValidator)->validate($value);
    expect($result->isValid())->toBeTrue();
})->with([
    'X3281179E',
    'Z5324013R',
    'X9978415A',
    'Z0570221X',
    'X2275691W',
]);

it('can tell if a nie is invalid', function ($value) {
    $result = (new NifNieValidator)->validate($value);
    expect($result->isValid())->toBeFalse();
})->with([
    'X3281179X',
    'Z5324013A',
    'X9978415R',
    'Z0570221M',
    'X2275691K',
    3281179,
]);
