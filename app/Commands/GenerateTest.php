<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateTest extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'generate:test';
    protected $description = 'Generate static test.html from test view';

    public function run(array $params)
    {
        helper('filesystem');

        $outputDir = WRITEPATH . 'static-site/';
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0775, true);
        }

        $items = [
            ['id' => 1, 'name' => 'Mr Saikat'],
            ['id' => 2, 'name' => 'Monir']
        ];

        $html = view('test', compact('items'));

        write_file($outputDir . 'test.html', $html);

        CLI::write('✓ test.html generated successfully in writable/static-site/', 'green');
    }
}
