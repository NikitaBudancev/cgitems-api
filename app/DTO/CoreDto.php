<?php

namespace App\DTO;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionProperty;

abstract class CoreDto
{
    /**
     * @param  bool  $strict  false отключает строгую проверку на наличия полей в массиве.
     *                        Нужно в том случае, где поля заранее не известны, например Model::update()
     *
     * @throws Exception
     */
    public static function fromRequest(Request $request, bool $strict = true): static
    {
        $data = $request instanceof FormRequest
            ? $request->validated()
            : $request->all();

        return self::fromArray($data, $strict);
    }

    /**
     * @param  bool  $strict  false отключает строгую проверку на наличия полей в массиве.
     *                        Нужно в том случае, где поля заранее не известны, например Model::update()
     *
     * @throws Exception
     */
    public static function fromArray(array $data, bool $strict = true): static
    {

        $dto = new static;

        $reflectionClass = new ReflectionClass($dto);

        foreach ($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $propertyName = $property->getName();

            if ($strict && ! array_key_exists($propertyName, $data)) {
                throw new Exception("Отсутствует поле $propertyName");
            }

            if (isset($data[$propertyName])) {
                $dto->{$propertyName} = $data[$propertyName];
            }
        }

        return $dto;
    }

    public function toArray(bool $isKeySnakeCase = true): array
    {
        $data = [];

        foreach ($this as $property => $value) {
            $key = $isKeySnakeCase ? $this->toSnakeCase($property) : $property;
            $data[$key] = $value;
        }

        return $data;
    }

    /**
     * @throws Exception
     */
    public function __set($name, $value)
    {
        throw new Exception('Нельзя добавлять новые свойства к объекту класса ' . get_class($this));
    }

    private function toSnakeCase(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
}
