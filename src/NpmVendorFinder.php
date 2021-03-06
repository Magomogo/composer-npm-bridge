<?php

/*
 * This file is part of the Composer NPM bridge package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\NpmBridge;

use Composer\Composer;
use Composer\Package\PackageInterface;

/**
 * Finds NPM bridge enabled vendor packages.
 */
class NpmVendorFinder implements NpmVendorFinderInterface
{
    /**
     * Find all NPM bridge enabled vendor packages.
     *
     * @param Composer           $composer The Composer object for the root project.
     * @param NpmBridgeInterface $bridge   The bridge to use.
     *
     * @return array<integer,PackageInterface> The list of NPM bridge enabled vendor packages.
     */
    public function find(Composer $composer, NpmBridgeInterface $bridge)
    {
        $packages = $composer->getRepositoryManager()->getLocalRepository()
            ->getPackages();

        $dependantPackages = array();
        foreach ($packages as $package) {
            if ($bridge->isDependantPackage($package)) {
                $dependantPackages[] = $package;
            }
        }

        return $dependantPackages;
    }
}
