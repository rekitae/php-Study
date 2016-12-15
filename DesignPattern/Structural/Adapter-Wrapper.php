<?php

interface IBook
{
    public function open();

    public function nextPage();

    public function getCurrentPage(): int;
}

class Book implements IBook
{
    protected $page;

    public function open()
    {
        $this->page = 1;
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function getCurrentPage(): int
    {
        return $this->page;
    }
}

interface IEBook
{
    public function open();

    public function pressNext();

    public function getPage(): array;
}

class EBookAdapter implements IBook
{
    protected $eBook;

    public function __construct(IEBook $ebook)
    {
        $this->eBook = $ebook;
    }

    public function open()
    {
        $this->eBook->open();
    }

    public function nextPage()
    {
        $this->eBook->pressNext();
    }

    public function getCurrentPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}

class Kindle implements IEBook
{
    public $page;
    public $totalPage;

    public function open()
    {
        $this->page = 1;
        $this->totalPage = 100;
    }

    public function pressNext()
    {
        $this->page++;
    }

    public function getPage(): array
    {
        return [$this->page, $this->totalPage];
    }
}

$book = new Book;
$book->open();
$book->nextPage();

echo '[' , $book->getCurrentPage() , ']' , PHP_EOL;
assert($book->getCurrentPage() == 2);

//////////////////////////////////////////////////

$book = new EBookAdapter(new Kindle());
$book->open();
$book->nextPage();

echo '[' , $book->getCurrentPage() , ']' , PHP_EOL;
assert($book->getCurrentPage() == 2);
