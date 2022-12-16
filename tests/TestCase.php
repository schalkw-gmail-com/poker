<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     *  Function to inspect a variable.
     *
     *  Provides
     *  -  line number
     *  -  variable name (as is written in the code)
     *  -  value
     *  -  type
     *
     * @param $variable
     */
    public function inspect_variable($variable): void
    {
        // read backtrace
        $bt = debug_backtrace();
        // read file
        $file = file($bt[0]['file']);
        // select exact print_var_name($varname) line
        $src = $file[$bt[0]['line'] - 1];
        // search pattern
        $pat = '#(.*)' . __FUNCTION__ . ' *?\( *?(.*) *?\)(.*)#i';
        // extract $varname from match no 2
        $var = preg_replace($pat, '$2', $src);
        // print to browser
        //return trim($var);
        $caller = array_shift($bt);

        dump($caller['line'] . ' = ' . trim($var) . " ====> " . print_r($variable, true) . " ( " . gettype($variable) . " )");
    }
}
