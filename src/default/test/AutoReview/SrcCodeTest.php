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

namespace <?= $generator->namespace ?>Test\AutoReview;

use Ergebnis\Test\Util;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @coversNothing
 */
final class SrcCodeTest extends Framework\TestCase
{
    use Util\Helper;

    public function testSrcClassesHaveUnitTests(): void
    {
        self::assertClassesHaveTests(
            __DIR__ . '/../../src/',
            '<?= str_replace('\\','\\\\',$generator->namespace) ?>',
            '<?= str_replace('\\','\\\\',$generator->namespace) ?>Test\\Unit\\'
        );
    }
}
