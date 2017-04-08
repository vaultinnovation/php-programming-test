<?php
namespace Vault\Vault;


class ArrayDifference implements DifferenceInterface
{
    /**
     * @var array
     */
    private $left = [];

    /**
     * @var array
     */
    private $right = [];

    /**
     * ArrayDifference constructor.
     * @param array $left
     * @param array $right
     */
    public function __construct(array $left, array $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @return array
     */
    public function diff()
    {
        return array_values(array_diff($this->left, $this->right));
    }
}