<?php

namespace Entity;


use App\DB\QueryBuilder;

class QueryBuilderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-invoice
     */
    public function testInsertInvoice()
    {
        $data = [
            'reference' => 'foo',
            'total' => 1,
            'vat' => 1,
            'status_id' => 4,
            'id' => 5
        ];
        $table = 'invoice';
        $sql = QueryBuilder::insert($data, $table);
        $expected = "INSERT INTO `invoice` (`reference`, `total`, `vat`, `status_id`, `id`) VALUE (?,?,?,?,?);";

        $this->assertSame($expected, $sql);
    }

    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-customer
     */
    public function testInsertCustomer()
    {
        $data = [
            'first_name' => 'Peter',
            'last_name' => 'Fisher',
            'company_name' => 'How To Code Well',
        ];
        $table = 'customer';
        $sql = QueryBuilder::insert($data, $table);
        $expected = "INSERT INTO `customer` (`first_name`, `last_name`, `company_name`) VALUE (?,?,?);";

        $this->assertSame($expected, $sql);
    }
    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-update
     */
    public function testUpdate()
    {
        $data = [
            'reference' => 'foo',
            'total' => 1,
            'vat' => 1,
        ];

        $where = [
            'id' => 5
        ];

        $table = 'invoice';

        $sql = QueryBuilder::update($data, $table, $where);
        $expected = "UPDATE `invoice` SET `reference` =?, `total` =?, `vat` =? WHERE `id` =?;";

        $this->assertSame($expected, $sql);
    }
    /**
     * @group entity
     * @group db
     * @group db-query-builder
     * @group db-query-builder-insert-or-update
     */
    public function testInsertOrUpdate()
    {
        $sql = QueryBuilder::insertOrUpdate();
        $expected = '';

        $this->assertSame($expected, $sql);
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

}