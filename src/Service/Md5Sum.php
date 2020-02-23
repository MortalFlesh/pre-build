<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use Assert\Assertion;
use MF\Collection\Immutable\Generic\IList;
use MF\Collection\Immutable\Generic\ListCollection;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\Replacements;
use MF\PreBuild\Entity\ReplacePlaceholder;
use MF\PreBuild\Entity\Variables;

class Md5Sum
{
    public function findMd5SumToVariables(Config $config): Variables
    {
        $variables = new Variables();
        $md5config = $config->getMd5SumConfig();

        if (!$md5config) {
            return $variables;
        }

        $this->findMd5Sum($md5config->getValues())
            ->each(function (array $value) use ($variables): void {
                $variables->set(...$value);
            });

        return $variables;
    }

    private function findMd5Sum(array $values): IList
    {
        return ListCollection::createT('array', $values, function ($value, string $fileToMd5) {
            if (is_array($value)) {
                [$fileToReplacePlaceholder, $placeholder] = $value;

                return [$fileToReplacePlaceholder, $placeholder, $this->sumFileInMd5($fileToMd5)];
            } elseif (is_string($value)) {
                $envName = $value;

                return [$envName, $this->sumFileInMd5($fileToMd5)];
            }

            throw new \InvalidArgumentException(
                sprintf('Find MD5 sum by value "%s" is not implemented.', var_export($value, true))
            );
        });
    }

    private function sumFileInMd5(string $file): string
    {
        Assertion::file($file);

        $md5 = md5_file($file);
        Assertion::notSame($md5, false, sprintf('Md5 sum of file "%s" could not be done.', $file));

        return $md5;
    }

    public function findMd5SumForReplace(Config $config): Replacements
    {
        $replacements = new Replacements();
        $md5ReplaceConfig = $config->getMd5SumReplaceConfig();

        if (!$md5ReplaceConfig) {
            return $replacements;
        }

        $this->findMd5Sum($md5ReplaceConfig->getValues())
            ->each(function (array $value) use ($replacements): void {
                $replacements->add(new ReplacePlaceholder(...$value));
            });

        return $replacements;
    }
}
