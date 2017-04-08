<?php
namespace Vault\Vault;


interface DifferenceInterface
{
    /**
     * @return mixed
     *   This is different between classes.
     */
    public function diff();
}