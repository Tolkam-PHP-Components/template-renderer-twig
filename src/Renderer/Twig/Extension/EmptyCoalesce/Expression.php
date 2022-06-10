<?php declare(strict_types=1);

namespace Tolkam\Template\Renderer\Twig\Extension\EmptyCoalesce;

use Countable;
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Node;

class Expression extends AbstractExpression
{
    /**
     * @param Node $left
     * @param Node $right
     * @param      $lineno
     */
    public function __construct(Node $left, Node $right, $lineno)
    {
        $left->setAttribute('ignore_strict_check', true);
        $left->setAttribute('is_defined_test', false);
        $right->setAttribute('ignore_strict_check', true);
        $right->setAttribute('is_defined_test', false);

        parent::__construct(
            ['left' => $left, 'right' => $right],
            ['ignore_strict_check' => true, 'is_defined_test' => false],
            $lineno
        );
    }

    /**
     * Checks if values is empty
     *
     * @param $value
     *
     * @return bool
     */
    public static function empty($value): bool
    {
        if ($value instanceof Countable) {
            return 0 == count($value);
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return '' === (string) $value;
        }

        return $value === '' || $value === false || $value === null || $value === [];
    }

    /**
     * @@inheritDoc
     */
    public function compile(Compiler $compiler)
    {
        $compiler
            ->raw('((' . self::class . '::empty(')
            ->subcompile($this->getNode('left'))
            ->raw(') ? null : ')
            ->subcompile($this->getNode('left'))
            ->raw(') ?? (' . self::class . '::empty(')
            ->subcompile($this->getNode('right'))
            ->raw(') ? null : ')
            ->subcompile($this->getNode('right'))
            ->raw('))');
    }
}
