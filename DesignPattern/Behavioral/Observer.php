<?php

interface ISubject
{
    function attach(IObserver $observer);

    function detach(IObserver $observer);

    function notify(string $notiStr);
}

interface IObserver
{
    public function update($noti);

    public function getIdentityString(): string;
}

class News implements ISubject
{
    private $observer;

    function __construct()
    {
        $this->observer = [];
    }

    function attach(IObserver $observer)
    {
        $k = spl_object_hash($observer);

        echo 'attach : ' , $observer->getIdentityString() , ' : ' , $k , PHP_EOL;

        if (!array_key_exists($k, $this->observer))
            $this->observer[$k] = $observer;
    }

    function detach(IObserver $observer)
    {
        $k = spl_object_hash($observer);

        echo 'detach : ' , $observer->getIdentityString() , ' : ' , $k , PHP_EOL;

        if (array_key_exists($k, $this->observer))
            unSet($this->observer[$k]);
    }

    function notify(string $noticeStr)
    {
        array_walk($this->observer, function ($observer) use ($noticeStr) {
            $observer->update($noticeStr);
        });
    }

    function announce(string $news)
    {
        $this->notify($news);
    }
}

class Sticker implements IObserver
{
    private $boardName;

    public function __construct(string $boardName)
    {
        $this->boardName = $boardName;
    }

    public function update($noti)
    {
        echo __METHOD__, ' [', $this->boardName, '] > ', $noti, PHP_EOL;
    }

    public function getIdentityString(): string
    {
        return $this->boardName;
    }
}

$news = new News();
$sticker1 = new Sticker('JTBC');
$sticker2 = new Sticker('EBS');
$sticker3 = new Sticker('TVN');

$news->attach($sticker1);
$news->attach($sticker2);

$news->announce('헌재 박근혜 탄핵 인용!');

$news->attach($sticker3);

$news->announce('박근혜 구속 수사 결정!');

$news->detach($sticker2);

$news->announce('김기춘, 우병우, 정호성, 안봉근, 이재만, 안종범 무기징역 확정판결!');
