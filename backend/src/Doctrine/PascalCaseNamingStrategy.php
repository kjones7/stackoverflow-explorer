<?php

namespace App\Doctrine;

use Doctrine\ORM\Mapping\NamingStrategy;

class PascalCaseNamingStrategy implements NamingStrategy
{
    public function classToTableName($className): string
    {
        return $this->convertToPascalCase($className);
    }

    public function propertyToColumnName($propertyName, $className = null): string
    {
        return $this->convertToPascalCase($propertyName);
    }

    public function referenceColumnName(): string
    {
        return 'Id';
    }

    public function joinColumnName($propertyName, $className = null): string
    {
        return $this->convertToPascalCase($propertyName) . 'Id';
    }

    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null): string
    {
        return $this->convertToPascalCase($sourceEntity) . $this->convertToPascalCase($targetEntity);
    }

    public function joinKeyColumnName($entityName, $referencedColumnName = null): string
    {
        return $this->convertToPascalCase($entityName) . ($referencedColumnName ?: 'Id');
    }

    public function embeddedFieldToColumnName($propertyName, $embeddedColumnName, $className = null, $embeddedClassName = null): string
    {
        return $this->convertToPascalCase($propertyName) . $this->convertToPascalCase($embeddedColumnName);
    }

    private function convertToPascalCase($string): string
    {
        $string = str_replace('_', '', ucwords($string, '_'));
        return lcfirst($string);
    }
}
