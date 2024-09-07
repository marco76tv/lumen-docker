<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\DB;

trait DatabaseAssertions
{
    /**
     * Assert that the database contains a record matching the given criteria.
     *
     * @param  string  $table
     * @param  array   $data
     * @return void
     */
    public function assertDatabaseHas($table, array $data)
    {
        $this->assertTrue(
            DB::table($table)->where($data)->exists(),
            "Failed asserting that a record exists in the [{$table}] table matching the given criteria."
        );
    }

    /**
     * Assert that the database does not contain a record matching the given criteria.
     *
     * @param  string  $table
     * @param  array   $data
     * @return void
     */
    public function assertDatabaseMissing($table, array $data)
    {
        dd([
            'record' => DB::table($table)->where($data)->first(),
            'data' => $data
        ]);

        $this->assertFalse(
            DB::table($table)->where($data)->exists(),
            "Failed asserting that a record does not exist in the [{$table}] table matching the given criteria.[".print_r($data, true)."]"
        );
    }
}
