<?php

declare(strict_types=1);

/*
 * This file is part of TimeTags.
 *
 * (c) Darko Selesi 2024 <hallo@w3scouts.com>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/w3scout/contao-timetags-bundle
 */

namespace W3Scout\ContaoTimetagsBundle;

use W3Scout\ContaoTimetagsBundle\DependencyInjection\W3ScoutContaoTimetagsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class W3ScoutContaoTimetagsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): W3ScoutContaoTimetagsExtension
    {
        return new W3ScoutContaoTimetagsExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
