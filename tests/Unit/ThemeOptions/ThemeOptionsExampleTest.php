<?php

namespace Tests\Unit\ThemeOptions;

use EightshiftBoilerplate\ThemeOptions\ThemeOptionsExample;

beforeEach(function() {
	$this->example = new ThemeOptionsExample();
});

afterEach(function () {
	unset($this->example);
});

test('Register method will bail out if ACF is not registered/activated', function () {
	expect($this->example->register())->toBeNull();
});

test('if theme options actions are registered', function () {
	$this->example->register();

	expect(\method_exists($this->example, 'register'))->toBeTrue();
	expect(has_action('acf/init', [$this->example, 'createThemeOptionsPage']))->toBe(10);
	expect(has_action('acf/init', [$this->example, 'registerThemeOptions']))->toBe(10);
});

test('Method for adding ACF Theme Options page exists', function () {
	$this->example->createThemeOptionsPage();

	expect(\method_exists($this->example, 'createThemeOptionsPage'))->toBeTrue();
});

test('Method for adding ACF fields to Theme Options page exists', function () {
	$this->example->registerThemeOptions();

	expect(\method_exists($this->example, 'registerThemeOptions'))->toBeTrue();
});
