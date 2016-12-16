<?php
/*
 * 순차적으로 호출 처리 할 객체 체인을 작성, 선행 객체가 처리하지 못할 경우 다음 객체에 위임(호출)
 *  - 체인을 처리하는 핸들러는 객체(인터페이스) 유형마다 정의 되어야 하는가?
 *  - RequestInterface 을 공용화 시키거나 세분화 하면 될듯
 */
interface RequestInterface
{
    public function getUri();

    public function getMethod();
}

abstract class Handler
{
    private $successor = null;

    public function __construct(Handler $handler = null)
    {
        $this->successor = $handler;
    }

    final public function handle(RequestInterface $request)
    {
        $processed = $this->processing($request);

        if ($processed === null) {
            // the request has not been processed by this handler => see the next
            if ($this->successor !== null) {
                $processed = $this->successor->handle($request);
            }
        }

        return $processed;
    }

    abstract protected function processing(RequestInterface $request);
}

class HttpInMemoryCacheHandler extends Handler
{
    private $data;

    public function __construct(array $data, Handler $successor = null)
    {
        parent::__construct($successor);
        $this->data = $data;
    }

    protected function processing(RequestInterface $request)
    {
        $key = sprintf('%s', $request->getUri());

        if ($request->getMethod() == 'GET' && isset($this->data[$key])) {
            return $this->data[$key];
        }

        return null;
    }
}

class SlowDatabaseHandler extends Handler
{
    protected function processing(RequestInterface $request)
    {
        /*
         * inquery data from base data provider. ex) db, restAPI
         */

        // this is a mockup, in production code you would ask a slow (compared to in-memory) DB for the results
        return rand(1,2) == 1 ? 'Hello World!' : null;
        //return 'Hello World!';
    }
}

class FinalHandler extends Handler
{
    protected function processing(RequestInterface $request)
    {
        return 'can not found any data';
    }
}

class Request implements RequestInterface
{
    public function getUri()
    {
        return '/foo/bar?index=1';
    }

    public function getMethod()
    {
        return 'GET';
    }
}

class Request2 implements RequestInterface
{
    public function getUri()
    {
        return '/foo/bar?index=2';
    }

    public function getMethod()
    {
        return 'GET';
    }
}

$chain = new HttpInMemoryCacheHandler(
    ['/foo/bar?index=1' => 'Hello In Memory!'],
    new SlowDatabaseHandler(
        new FinalHandler
    )
);

// create request
$request = new Request;
$request2 = new Request2;

echo 'Request : ' , $chain->handle($request) , PHP_EOL;

echo 'Request2 : ' , $chain->handle($request2) , PHP_EOL;
