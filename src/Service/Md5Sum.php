<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use Assert\Assertion;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\Variables;

class Md5Sum
{
    public function findMd5Sum(Config $config): Variables
    {
        $variables = new Variables();
        $md5config = $config->getMd5SumConfig();

        if (!$md5config) {
            return $variables;
        }

        foreach ($md5config->getValues() as $file => $envName) {
            $variables->set($envName, $this->sumFileInMd5($file));
        }

        return $variables;
    }

    private function sumFileInMd5(string $file): string
    {
        Assertion::file($file);

        $md5 = md5_file($file);
        Assertion::notSame($md5, false, sprintf('Md5 sum of file "%s" could not be done.', $file));

        return $md5;
    }
}
