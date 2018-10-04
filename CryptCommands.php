<?php

namespace Drush\Commands\drush_utility;

use Drupal\Component\Utility\Crypt;
use Drush\Commands\DrushCommands;
use Robo\ResultData;

/**
 * Class CryptCommands
 *
 * @package Drush\Commands\drush_utility
 *
 * @see \Drupal\Component\Utility\Crypt
 */
class CryptCommands extends DrushCommands {

  /**
   * Calculates a base-64 encoded, URL-safe sha-256 hmac.
   *
   * @param $data
   *   Scalar value to be validated with the hmac.
   * @param $key
   *   A secret key, this can be any scalar value.
   *
   * @return string
   *   A base-64 encoded sha-256 hmac, with + replaced with -, / with _ and
   *   any = padding characters removed.
   *
   * @command crypt:hmac
   */
  public function hmacBase64($data, $key): string {
    return Crypt::hmacBase64($data, $key);
  }

  /**
   * Calculates a base-64 encoded, URL-safe sha-256 hash.
   *
   * @param $data
   *   String to be hashed.
   *
   * @return string
   *   A base-64 encoded sha-256 hash, with + replaced with -, / with _ and
   *   any = padding characters removed.
   *
   * @command crypt:hash
   */
  public function hashBase64($data): string {
    return Crypt::hashBase64($data);
  }

  /**
   * Compares strings in constant time.
   *
   * @param string $known_string
   *   The expected string.
   * @param string $user_string
   *   The user supplied string to check.
   *
   * @return \Robo\ResultData
   *
   * @command crypt:hash-equals
   */
  public function hashEquals($known_string, $user_string): ResultData {
    if (Crypt::hashEquals($known_string, $user_string)) {
      $this->io()->success(NULL);
      return new ResultData(ResultData::EXITCODE_OK);
    }

    return new ResultData(ResultData::EXITCODE_ERROR);
  }

  /**
   * Returns a URL-safe, base64 encoded string of highly randomized bytes.
   *
   * @param int $count
   *   The number of random bytes to fetch and base64 encode.
   *
   * @return string
   *   The base64 encoded result will have a length of up to 4 * $count.
   *
   * @command crypt:random-bytes
   */
  public function randomBytesBase64(int $count = 32): string {
    return Crypt::randomBytesBase64($count);
  }

}
