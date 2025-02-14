<?php

namespace Tests\Unit\Helpers;

use EightshiftLibs\Helpers\ErrorLoggerTrait;

use function Tests\mock;

class MockErrorLogger {
	use ErrorLoggerTrait;
}

beforeEach(function () {
	$this->mockLogger = new MockErrorLogger();
});

afterEach(function () {
	unset($this->mockLogger);
});

test('Test restResponseHandler will return expected result in case of success', function () {
	$response = $this->mockLogger->restResponseHandler(200, 'Some status', 'Some message', ['fake data']);

	$this->assertJson($response, 'Response is not a JSON string.');
	$this->assertSame('{"success":true,"data":{"code":200,"status":"Some status","message":"Some message","data":["fake data"]}}', $response);
});


test('Test restResponseHandler will return expected result in case of error', function () {
	mock('WP_Error');

	$response = $this->mockLogger->restResponseHandler(404, 'Some error', 'Some error message', ['fake data']);

	$this->assertJson($response, 'Response is not a JSON string.');
	$this->assertSame('{"success":false,"data":{}}', $response);
});
