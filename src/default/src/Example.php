<?php echo "<?php \n" ?>

declare(strict_types=1);

/**
 * Copyright (c) 2017-2021 Inquid
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/<?= $generator->githubUserAccount ?>/<?= $generator->packageName  . PHP_EOL; ?>
 */

namespace <?= preg_replace('<(\\\\)$>' , '',  $generator->namespace) ?>;

final class Example
{
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromName(string $name): self
    {
        return new self($name);
    }

    public function name(): string
    {
        return $this->name;
    }
}
