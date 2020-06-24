<?php

namespace Drupal\custom_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for the models.
 *
 * @MigrateSource(
 *   id = "models"
 * )
 */
class Models extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('models', 'g')
      ->fields('g', ['id', 'vehicle_id', 'name']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Model ID'),
      'vehicle_id' => $this->t('Vehicle ID'),
      'name' => $this->t('Model name'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'g',
      ],
    ];
  }
}