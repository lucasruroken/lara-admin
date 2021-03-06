<?php

namespace LucasRuroken\LaraAdmin\Tests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use LucasRuroken\LaraAdmin\Builders\ActionBuilder;
use LucasRuroken\LaraAdmin\Builders\ColumnBulker;
use LucasRuroken\LaraAdmin\Builders\ListBuilder;
use PHPUnit\Framework\TestCase;

class ListBuilderTest extends TestCase
{
    /** @type ActionBuilder */
    private $actionBuilder;

    /** @type ListBuilder */
    private $listBuilder;

    public function setUp()
    {
        $this->actionBuilder = new ActionBuilder();
        $this->listBuilder = new ListBuilder();
    }

    public function test_ifActionBuilderIsSetted()
    {
        $this->listBuilder->setActionBuilder($this->actionBuilder);

        $this->assertEquals($this->actionBuilder, $this->listBuilder->getActionBuilder());
    }

    public function test_visibleColumns()
    {
        $this->listBuilder->buildColumns(['name', 'title', 'created_at', 'updated_at']);
        $this->listBuilder->hideColumns(['title', 'created_at', 'body']);

        $this->assertEquals(
            (new Collection(['name', 'updated_at']))->toArray(),
            (array_values($this->listBuilder->visibleColumns()->toArray())) /** Use array_values to re order the array key */
        );
    }

    public function test_fillInformation()
    {
        $dataX = new Collection(['name' => 'Dummy Name X', 'title' => 'Dummy Title X']);
        $dataY = new Collection(['name' => 'Dummy Name Y', 'title' => 'Dummy Title Y']);

        $info = new Collection([$dataX, $dataY]);

        $this->listBuilder->fillInformation($info);

        $this->assertEquals('Dummy Name X', $this->listBuilder->getInformation()->first()['name']);
        $this->assertEquals('Dummy Title X', $this->listBuilder->getInformation()->first()['title']);
        $this->assertEquals('Dummy Name Y', $this->listBuilder->getInformation()->last()['name']);
        $this->assertEquals('Dummy Title Y', $this->listBuilder->getInformation()->last()['title']);
    }

    public function test_filledColumnTitles()
    {
        $this->listBuilder->buildColumns(['name', 'title', 'created_at', 'updated_at']);
        $this->listBuilder->hideColumns(['title', 'created_at', 'body']);

        $this->listBuilder->buildColumnTitles(['name' => 'A name', 'title' => 'A title']);

        $this->assertEquals('A name', $this->listBuilder->getColumnTitles()->get('name'));
        $this->assertEquals('A title', $this->listBuilder->getColumnTitles()->get('title'));
    }

    public function test_nameIsReturned()
    {
        $this->listBuilder->setName('Articles');
        $this->assertEquals('Articles', $this->listBuilder->render()['name']);
    }

    public function test_bulkedColumns()
    {
        $this->listBuilder->buildColumns(['name', 'title', 'created_at', 'updated_at']);
        $this->listBuilder->hideColumns(['title', 'created_at', 'body']);

        $bulker = new ColumnBulker();
        $bulker->set('name', function(Collection $row){

            return '<span style="color: red;">Test name - ' . $row['name'] . '</span>';
        });

        $this->listBuilder->fillBulkers($bulker);

        $this->assertEquals('<span style="color: red;">Test name - Lucas</span>', $this->listBuilder->render()['bulker']->bulk('name', new Collection(['name' => 'Lucas']), 'Lucas'));
    }
}