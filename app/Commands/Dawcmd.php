<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Dawcmd extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'DemoClasse';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'daw:demo';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Demostració de com funciona una classe comanda.';	

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'command:name [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        echo "hola, soc una comanda";
    }
}
