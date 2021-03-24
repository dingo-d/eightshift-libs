<?php

namespace Tests\Unit\CustomPostType;

use EightshiftLibs\Rest\Routes\RouteCli;

use function Tests\deleteCliOutput;

/**
 * Mock before tests.
 */
beforeEach(function () {
	$wpCliMock = \Mockery::mock('alias:WP_CLI');

	$wpCliMock
		->shouldReceive('success')
		->andReturnArg(0);

	$wpCliMock
		->shouldReceive('error')
		->andReturnUsing(
			function ($errorMessage) {
					throw new \InvalidArgumentException($errorMessage);
			}
	);

	$this->route = new RouteCli('boilerplate');
});

/**
 * Cleanup after tests.
 */
afterEach(function () {
	$output = dirname(__FILE__, 4) . '/cliOutput';

	deleteCliOutput($output);
});


test('REST route CLI command will correctly copy the field class with defaults', function () {
	$route = $this->route;
	$route([], $route->getDevelopArgs([]));

	// Check the output dir if the generated method is correctly generated.
	$generatedField = file_get_contents(dirname(__FILE__, 4) . '/cliOutput/src/Rest/Routes/TestRoute.php');

	$this->assertStringContainsString('class TestRoute extends AbstractRoute implements CallableRouteInterface', $generatedField);
	$this->assertStringContainsString('\'methods\' => ', $generatedField);
	$this->assertStringContainsString('\'callback\' => ', $generatedField);
	$this->assertStringContainsString('\'permission_callback\' => ', $generatedField);
	$this->assertStringContainsString('function getCallbackArguments', $generatedField);
	$this->assertStringContainsString('function routeCallback', $generatedField);
});


test('REST route CLI command will correctly copy the field class with arguments', function ($routeArguments) {
	$route = $this->route;
	$route([], $routeArguments);

	$full_route_name = "{$this->route->getFileName($routeArguments['endpoint_slug'])}Route";
	$method_to_const = RouteCli::VERB_ENUM[strtolower($routeArguments['method'])] ?? '';

	// Check the output dir if the generated method is correctly generated.
	$generatedField = file_get_contents(dirname(__FILE__, 4) . "/cliOutput/src/Rest/Routes/{$full_route_name}.php");

	$this->assertStringContainsString("class {$full_route_name} extends AbstractRoute implements CallableRouteInterface", $generatedField);
	$this->assertStringContainsString("'methods' => {$method_to_const}", $generatedField);
})->with('correctRouteArguments');


test('REST route CLI command will throw error on missing / invalid arguments', function ($routeArguments) {
	$route = $this->route;
	$route([], $routeArguments);
})->with('errorRouteArguments')->throws(\Exception::class);


test('REST CLI command will throw WP_Error when arguments fail validation', function ($routeArguments) {
	$route = $this->route;
	$route([], $routeArguments);
})->with('invalidRouteArguments')->throws(\InvalidArgumentException::class);
