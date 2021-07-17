<?php

namespace App;

final class QuizStatus
{
    public const DRAFT = 0;
    public const PASSIVE = 1;
    public const ACTIVE = 2;

    private static function getData()
    {
        return $data = [
            'Select Status' => -1,
            'Draft' => self::DRAFT,
            'Passive' => self::PASSIVE,
            'Active' => self::ACTIVE
        ];
    }

    public static function getLabels(): array
    {
        return self::getData();
    }

    /**
     * @param int $value
     *
     * @return string
     */
    public static function getLabel(int $value): string
    {
        return array_search($value, self::getData());
    }

    /**
     * @param int $value
     *
     * @return string
     */
    public static function getClass(int $value): string
    {
        $data = [
            'secondary' => self::DRAFT,
            'danger'    => self::PASSIVE,
            'success'   => self::ACTIVE
        ];

        return array_search($value, $data);
    }
}
