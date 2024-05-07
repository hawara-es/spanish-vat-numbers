<?php

use Hawara\VatNumbers\Results\Cif\InvalidControlDigitResult;
use Hawara\VatNumbers\Results\Cif\MustBeAStringResult;
use Hawara\VatNumbers\Results\Cif\MustFollowThePatternResult;
use Hawara\VatNumbers\Validators\CifValidator;

it('can tell if a cif is valid', function ($value) {
    $result = (new CifValidator)->validate($value);
    expect($result->isValid())->toBeTrue();
})->with([
    'A2134871I',
    'A21348719',
    'V12815924',
    'W2616642A',
    'R1005928E',
]);

it('can tell if the control digit of a cif is invalid', function ($value) {
    $result = (new CifValidator)->validate($value);
    expect($result->isValid())->toBeFalse();
    expect($result)->toBeInstanceOf(InvalidControlDigitResult::class);
})->with([
    'A2134871A',
    'A21348710',
    'V12815925',
    'W26166421',
    'R1005928B',
]);

it('provides specific error answers for non string values', function ($value) {
    $result = (new CifValidator)->validate($value);
    expect($result->isValid())->toBeFalse();
    expect($result)->toBeInstanceOf(MustBeAStringResult::class);
})->with([
    false,
    null,
    fn () => [],
]);

it('provides specific error answers for strings that do not match the cif pattern', function ($value) {
    $result = (new CifValidator)->validate($value);
    expect($result->isValid())->toBeFalse();
    expect($result)->toBeInstanceOf(MustFollowThePatternResult::class);
})->with([
    '',
    '1A',
    'AAAABBBBC',
]);
