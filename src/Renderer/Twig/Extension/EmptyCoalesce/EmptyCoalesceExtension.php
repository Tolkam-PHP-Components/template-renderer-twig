<?php declare(strict_types=1);

namespace Tolkam\Template\Renderer\Twig\Extension\EmptyCoalesce;

use Twig\ExpressionParser;
use Twig\Extension\ExtensionInterface;

class EmptyCoalesceExtension implements ExtensionInterface
{
    /**
     * @@inheritDoc
     */
    public function getOperators(): array
    {
        return [
            // Unary operators
            [],
            // Binary operators
            [
                '??:' => [
                    'precedence' => 300,
                    'class' => Expression::class,
                    'associativity' => ExpressionParser::OPERATOR_RIGHT,
                ],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getTokenParsers(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getNodeVisitors(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getFilters(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getTests(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getFunctions(): array
    {
        return [];
    }
}
