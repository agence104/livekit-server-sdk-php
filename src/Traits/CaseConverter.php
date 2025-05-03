<?php

namespace Agence104\LiveKit\Traits;

/**
 * Provides case conversion utilities between snake_case and camelCase.
 */
trait CaseConverter {

  /**
   * Convert snake_case to camelCase.
   *
   * @param string $string
   *   The snake_case string to convert.
   *
   * @return string
   *   The camelCase converted string.
   */
  protected function snakeToCamel(string $string): string {
    return lcfirst(str_replace('_', '', ucwords($string, '_')));
  }

  /**
   * Convert camelCase to snake_case.
   *
   * @param string $string
   *   The camelCase string to convert.
   *
   * @return string
   *   The snake_case converted string.
   */
  protected function camelToSnake(string $string): string {
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
  }

  /**
   * Convert array keys from snake_case to camelCase.
   *
   * @param array $array
   *   The array with snake_case keys.
   *
   * @return array
   *   The array with camelCase keys.
   */
  protected function convertArrayKeysToSnake(array $array): array {
    $result = [];
    foreach ($array as $key => $value) {
      $newKey = $this->camelToSnake($key);
      $result[$newKey] = is_array($value) ? $this->convertArrayKeysToSnake($value) : $value;
    }
    return $result;
  }

  /**
   * Convert array keys from camelCase to snake_case.
   *
   * @param array $array
   *   The array with camelCase keys.
   *
   * @return array
   *   The array with snake_case keys.
   */
  protected function convertArrayKeysToCamel(array $array): array {
    $result = [];
    foreach ($array as $key => $value) {
      $newKey = $this->snakeToCamel($key);
      $result[$newKey] = is_array($value) ? $this->convertArrayKeysToCamel($value) : $value;
    }
    return $result;
  }

}
