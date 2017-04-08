<?php
namespace Vault\Vault;

final class TimeDifference implements DifferenceInterface
{
    /**
     * @var string
     */
    private $left;

    /**
     * @var string
     */
    private $right;

    /**
     * TimeDifference constructor.
     * @param string $left
     * @param string $right
     */
    public function __construct(string $left, string $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @return string
     */
    public function diff()
    {
        $left = new \DateTimeImmutable($this->left);
        $right = new \DateTimeImmutable($this->right);
        $diff = $right->diff($left);

        $dates = [];
        if ($diff->y > 0) {
            $dates[] = sprintf('%d years', $diff->y);
        }
        if ($diff->m > 0) {
            $dates[] = sprintf('%d months', $diff->m);
        }
        if ($diff->d > 0) {
            $dates[] = sprintf('%d days', $diff->d);
        }
        if ($diff->h > 0) {
            $dates[] = sprintf('%d hours', $diff->h);
        }
        if ($diff->i > 0) {
            $dates[] = sprintf('%d minutes', $diff->i);
        }
        if ($diff->s > 0) {
            $dates[] = sprintf('%d seconds', $diff->s);
        }

        $display = implode(', ', $dates);
        if ($diff->invert) {
            $display .= ' ago';
        }
        return $display;
    }
}